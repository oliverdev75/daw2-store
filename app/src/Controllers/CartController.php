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

        $error = null;
        if (isset($_SESSION['cart']['error'])) {
            $error = $_SESSION['cart']['error'];
            unset($_SESSION['cart']['error']);
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
            'error',
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
}
