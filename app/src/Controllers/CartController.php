<?php

namespace App\Controllers;

use Framework\Response\Send;
use Framework\Response\Types\View;
use Framework\Database\Database;
use App\Models\Order;
use App\Models\Product;
use Framework\Routing\Router;

class CartController extends Controller
{

    private static function setup()
    {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = ['products' => [], 'ingredients' => []];
        }
    }

    static function add($postData)
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

    static function delete($postData)
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

    static function order($postData)
    {
        Order::create([
            'user_id' => (int) $_SESSION['user']->getId()
        ]);
        $orderId = Order::getLastId();

        for ($i = 0; $i < $_SESSION['cart']['products']; $i++) {
            $product = $_SESSION['cart']['products'][$i];
            foreach ($_SESSION['cart']['ingredients'] as $prodIngredient => $ingredientData) {
                $productId = explode('-', $prodIngredient)[0];

                if ($productId == $product->getId()) {
                    $result = self::createOrderData(compact(
                        'orderId',
                        'product',
                        'ingredientData',
                        'postData',
                    ));

                    if (!$result == 'ok') {
                        return $result;
                    }
                }
            }
        }

        return Send::json(['status' => 'ok']);
    }

    static function createOrderData($data)
    {
        $ingredientQuant = $data['postData']["{$data['product']->getId()}-{$data['ingredientData']['id']}_quantity"];
        if (!is_numeric($ingredientQuant)) {
            return Send::json(['status' => 'error', 'message' => 'Quantities must be numeric.']);
        }

        foreach ($data['postData'] as $postInput => $value) {
            if (!str_contains($postInput, '-')) {
                Database::execPrepared("insert into ")
            }
        }

        $query = "insert into mixes (product_id, ingredient_id, quantity, total_price) ";
        $query .= "values (:product_id, :ingredient_id, :quantity, :total_price)";

        Database::execPrepared($query, params: [
            $data['product']->getId(),
            $data['ingredientData']['id'],
            $ingredientQuant,
            floatval($ingredientQuant * floatval($data['ingredientData']['price']))
        ], typeIndicators: 'iiiif');

        return 'ok';
    }
}
