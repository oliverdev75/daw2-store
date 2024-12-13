<?php

namespace App\Controllers;

use Framework\Response\Send;
use Framework\Response\Types\View;
use Framework\Database\Database;
use App\Models\Order;
use App\Models\Product;

class CartController extends Controller
{

    static function setup()
    {
        if (!isset($_SERVER['cart'])) {
            $_SERVER['cart'] = ['products' => [], 'ingredi ents' => []];
        }
    }

    static function add($postData)
    {
        if (!UserController::current()) {
            return Send::redirect()->route('user.login');
        }

        self::setup();
        $product = Product::find(intval($postData['id']));
        $_SERVER['cart']['products'][] = $product;
        foreach ($product->getIngredients() as $ingredient) {
            $_SERVER['cart']['ingredients'] = [
                "{$product->getId()}:{$ingredient['id']}" => [
                    'quantity' => $ingredient['quantity'],
                    'price' => $ingredient['price']
                ]
            ];
        }

        return Send::redirect()->route('product.index');
    }

    static function delete($postData)
    {
        for ($i = 0; $i < $_SERVER['cart']['products']; $i++) {
            if (intval($_SERVER['cart']['products'][$i]->getId()) == intval($postData['id'])) {
                unset($_SERVER['cart']['products'][$i]);
                break;
            }
        }

        return Send::redirect()->route('product.index');
    }

    static function order($postData)
    {
        Order::create([
            'user_id' => (int) $_SESSION['user']->getId()
        ]);
        $orderId = Order::getLastId();

        for ($i = 0; $i < $_SERVER['cart']['products']; $i++) {
            $product = $_SERVER['cart']['products'][$i];
            foreach ($_SERVER['cart']['ingredients'] as $prodIngredient => $ingredientData) {
                $productId = explode(':', $prodIngredient)[0];

                if ($productId == $product->getId()) {
                    self::createOrderData(compact(
                        'orderId',
                        'product',
                        'ingredientData',
                        'postData',
                    ));
                }
            }
        }
    }

    static function createOrderData($data)
    {
        $ingredientQuant = $data['postData']["{$data['product']->getId()}_{$data['ingredientData']['id']}_quantity"];
        $query = "insert into order_line (order_id, product_id, ingredient_id, quantity, total_price) ";
        $query .= "values (:order_id, :product_id, :ingredient_id, :quantity, :total_price)";

        Database::execPrepared($query, params: [
            $data['orderId'],
            $data['product']->getId(),
            $data['ingredientData']['id'],
            $ingredientQuant,
            floatval($ingredientQuant * floatval($data['ingredientData']['price']))
        ], typeIndicators: 'iiiif');
    }
}
