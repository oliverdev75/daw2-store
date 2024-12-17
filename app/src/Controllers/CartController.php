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

    public static function getPrice()
    {
        self::setup();
        $subtotal = number_format(
            array_reduce($_SESSION['cart']['products'], function ($total, $product) {
                $total += $product->getPrice();
            }, 0)
        , 2, ',');

        $IVA = number_format(($subtotal * 21) / 100, 2, ',');
        $total = number_format($subtotal + $IVA, 2, ',');

        return [
            $subtotal,
            $IVA,
            $total
        ];
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
        $_SESSION['cart']['products'][] = $product;
        foreach ($product->getIngredients() as $ingredient) {
            $_SESSION['cart']['ingredients']["{$product->getId()}-{$ingredient['id']}"] = [
                'quantity' => $ingredient['quantity'],
                'price' => $ingredient['price']
            ];
        }
        
        return Send::redirect()->route('product.index');
    }

    public static function delete($postData)
    {
        if (!UserController::current()) {
            return Send::redirect()->route('user.login', [], ['src' => Router::getRoute('product.index')]);
        }
        
        for ($i = 0; $i < $_SESSION['cart']['products']; $i++) {
            if ($_SESSION['cart']['products'][$i]->getId() == intval($postData['id'])) {
                unset($_SESSION['cart']['products'][$i]);
                break;
            }
        }

        return Send::json([$_SESSION['cart']]);
    }

    public static function order($postData)
    {
        $user = UserController::current();
        if (!$user) {
            return Send::json(['status' => 'error' , 'message' => 'No session']);
        }
        
        if (!$_SESSION['cart']['products']) {
            return Send::json(['status' => 'error', 'message' => 'No products in cart.']);
        }

        Order::create([
            'user_id' => $user->getId()
        ]);
        $orderId = Order::getLastId();

        for ($i = 0; $i < $_SESSION['cart']['products']; $i++) {
            $product = $_SESSION['cart']['products'][$i];
            foreach ($_SESSION['cart']['ingredients'] as $prodIngredient => $ingredientData) {
                $productId = explode('-', $prodIngredient)[0];
                $ingredientId = explode('-', $prodIngredient)[0];

                if ($productId == $product->getId() && $postData['quantities']["{$productId}-{$ingredientId}_quantity"] != '0') {
                    $result = self::createOrderData([...compact(
                        'orderId',
                        'product',
                        'ingredientData'
                    ), 'quantities' => $postData]);

                    if (!$result == 'ok') {
                        return $result;
                    }
                }
            }
        }

        return Send::json(['status' => 'ok']);
    }

    private static function createOrderData($data)
    {
        $productId = $data['product']->getId();
        $ingredientId = $data['ingredientData']['id'];

        $ingredientQuant = $data['quantities']["{$productId}-{$ingredientId}_quantity"];
        $totalPrice = floatval($ingredientQuant * floatval($data['ingredientData']['price']));
        if (!is_numeric($ingredientQuant)) {
            return Send::json(['status' => 'error', 'message' => 'Quantities must be numeric.']);
        }

        Mix::create([
            'product_id' => $data['product']->getId(),
            'ingredient_id' => $data['ingredientData']['id'],
            'quantity' => $ingredientQuant,
            'tota_price' => $totalPrice
        ]);

        self::fillOrder($data['quantities'], $data['orderId'], Mix::find(Mix::getLastId()));

        return 'ok';
    }

    private static function fillOrder($quantities, $orderId, $mix)
    {
        foreach ($quantities as $quantId => $value) {
            if (!str_contains($quantId, '-')) {
                if (!is_numeric($value)) {
                    return Send::json(['status' => 'error', 'message' => 'Quantities must be numeric.']);
                }

                $orderMixPrice = $mix->getPrice() * intval($value);
                $query = "insert into orders_mixes (order_id, mix_id, quantity, total_price) ";
                $query .= "values (?, ?, ?, ?)";

                Database::execPrepared($query, params: [
                    $orderId,
                    $mix->getId(),
                    $value,
                    $orderMixPrice
                ], typeIndicators: 'iiif');
            }
        }
    }
}
