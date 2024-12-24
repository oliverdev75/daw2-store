<?php

namespace App\Controllers;

use Framework\Response\Send;
use Framework\Database\Database;
use App\Models\Order;
use App\Models\Product;
use App\Models\Mix;
use Framework\Routing\Router;

class CartController extends Controller
{

    static function index(): mixed
    {
        $user = UserController::current();
        if (!$user) {
            return Send::redirect()->route('user.login', [], ['src' => urlencode(Router::getRoute('cart.index'))]);
        }

        $products = CartController::getProducts();
        $ingredients = CartController::getIngredients();
        [ $subtotal, $IVA, $total ] = CartController::getPrice();
        $principles = array_filter($products ?? [], function ($product) {
            return $product->getCategory() == 'Principles';
        });
        $snacks = array_filter($products ?? [], function ($product) {
            return $product->getCategory() == 'Snacks';
        });
        $drinks = array_filter($products ?? [], function ($product) {
            return $product->getCategory() == 'Drinks';
        });
        $desserts = array_filter($products ?? [], function ($product) {
            return $product->getCategory() == 'Desserts';
        });

        return Send::view('user.cart', 'Cart: SymfonyRestaurant', compact(
            'user',
            'principles',
            'snacks',
            'drinks',
            'desserts',
            'ingredients',
            'subtotal',
            'IVA',
            'total'
        ));
    }

    public static function getProducts()
    {
        self::setup();

        if ($_SESSION['cart']['products']) {
            return $_SESSION['cart']['products'];
        }

        return null;
    }

    public static function getIngredients()
    {
        self::setup();

        if ($_SESSION['cart']['ingredients']) {
            return $_SESSION['cart']['ingredients'];
        }

        return null;
    }

    public static function getPrice(bool $format = true)
    {
        self::setup();
        $subtotal = self::calcProductsPrice();
        $IVA = ($subtotal * 0.21);
        $total = $format ? number_format($subtotal + $IVA, 2, ',') : $subtotal + $IVA;

        return [
            $format ? number_format($subtotal, 2, ',') : $subtotal,
            $format ? number_format($IVA, 2, ',') : $IVA,
            $total
        ];
    }

    private static function calcProductsPrice()
    {
        $total = 0;
        foreach (array_values($_SESSION['cart']['products']) as $product) {
            $total += array_reduce(array_values(self::findProductIngredients($product->getId())),
                function ($result, $ingredient) {
                    $result += $ingredient->getTotalPrice();
                    return $result;
                }
            , 0) * $product->getQuantity();
        }

        return $total;
    }

    private static function findProductIngredients($productId)
    {
        return array_filter($_SESSION['cart']['ingredients'], function ($id) use ($productId) {
            return intval(explode('-', $id)[0]) == $productId;
        }, ARRAY_FILTER_USE_KEY);
    }

    private static function setup()
    {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = ['products' => [], 'ingredients' => []];
        }
    }

    public static function add($postData)
    {
        if (!UserController::current()) {
            return Send::redirect()->route('user.login', [], ['src' => Router::getRoute('product.index')]);
        }

        self::setup();
        $product = Product::find(intval($postData['id']));
        if ($_SESSION['cart']['products']['p-'.$product->getId()] instanceof Product) {
            $_SESSION['cart']['error'] = true;
        } else {
            $_SESSION['cart']['products']['p-'.$product->getId()] = $product->setQuantity(1);
            foreach ($product->getIngredients() as $ingredient) {
                $_SESSION['cart']['ingredients']["{$product->getId()}-{$ingredient->getId()}"] = $ingredient;
            }
        }
        
        return Send::redirect()->route('product.index');
    }

    public static function update($postData)
    {
        if (!UserController::current()) {
            return Send::json(['status' => 'error', 'message' => 'No session']);
        }
        
        $data = ['product' => null, 'ingredients' => []];
        foreach ($postData as $id => $quantity) {
            if (preg_match('/:/', $id)) {
                $_SESSION['cart']['products']['p-'.ltrim($id, ':')]->setQuantity(intval($quantity));
                $data['product'] = $quantity;
            } else {
                $_SESSION['cart']['ingredients'][$id]->setQuantity(intval($quantity));
                $data['ingredients'][] = $quantity;
            }
        }

        $prices = CartController::getPrice();

        $data['prices'] = [
            'subtotal' => $prices[0],
            'iva' => $prices[1],
            'total' => $prices[2]
        ];

        return Send::json([
            'status' => 'ok',
            'message' => 'Updated successfuly.',
            'data' => $data
        ]);
    }

    public static function delete($postData)
    {
        if (!UserController::current()) {
            return Send::redirect()->route('user.login', [], ['src' => Router::getRoute('product.index')]);
        }
        
        for ($i = 0; $i < $_SESSION['cart']['products']; $i++) {
            if (isset($_SESSION['cart']['products']['p-'.$postData['id']])) {
                unset($_SESSION['cart']['products']['p-'.$postData['id']]);
                break;
            }
        }

        return Send::redirect()->route('cart.index');
    }

    public static function order()
    {
        $user = UserController::current();
        if (!$user) {
            return Send::redirect()->route('user.login', [], ['src' => Router::getRoute('product.index')]);
        }

        Order::create([
            'user_id' => $user->getId()
        ]);
        $orderId = Order::getLastId();
        $totalPrice = 0;

        foreach ($_SESSION['cart']['products'] as $product) {
            Mix::create();
            $mixId = Mix::getLastId();
            foreach ($_SESSION['cart']['ingredients'] as $prodIngredient => $ingredientData) {
                $productId = explode('-', $prodIngredient)[0];

                if ($productId == $product->getId() && $ingredientData->getQuantity() != 0) {
                    self::createMix($mixId, $product, $ingredientData);
                }
            }
            
            $totalPrice += self::fillOrder($orderId, Mix::find($mixId), $product->getQuantity());
        }

        Order::where('id', $orderId)
            ->set('subtotal', $totalPrice)
            ->set('iva', $totalPrice * 0.21)
            ->set('total_price', $totalPrice * 1.21)
            ->update();

        //return Send::redirect()->route('product.index');
    }

    private static function createMix($id, $product, $ingredient)
    {
        $query = "insert into mix_line (mix_id, product_id, ingredient_id, quantity, price) ";
        $query .= "values (?, ?, ?, ?, ?)";

        Database::execPrepared($query, params: [
            $id,
            $product->getId(),
            $ingredient->getId(),
            $ingredient->getQuantity(),
            $ingredient->getTotalPrice()
        ], typeIndicators: 'iiiid');
    }

    private static function fillOrder($orderId, $mix, $quantity)
    {
        var_dump($mix->getPrice(false), $quantity);
        $orderMixPrice = $mix->getPrice(false) * $quantity;
        $query = "insert into orders_mixes (order_id, mix_id, quantity, price) ";
        $query .= "values (?, ?, ?, ?)";

        Database::execPrepared($query, params: [
            $orderId,
            $mix->getId(),
            $quantity,
            $orderMixPrice
        ], typeIndicators: 'iiid');

        return $orderMixPrice;
    }
}
