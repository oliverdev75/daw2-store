<?php

namespace App\Controllers;

use Framework\Response\Send;
use Framework\Response\Types\View;
use Framework\Routing\Router;
use Framework\Database\Database;
use App\Models\Order;
use App\Models\Mix;
use App\Models\Log;

class OrderController extends Controller
{

    function index($date = null)
    {
        $user = UserController::current();

        if (!$user) {
            return Send::redirect()->route('user.login', [], ['src' => Router::getRoute('order.index')]);
        }

        $orders = Order::where('user_id', $user->getId())->orderBy('create_time', 'desc');
        $orders = $date ? $orders->where('date(create_time)', $date) : $orders;

        return Send::view('order.index', 'Orders: SymfonyRestaurant', [
            'orders' => $orders->get(),
            'user' => UserController::current()
        ]);
    }

    function show($id)
    {
        $user = UserController::current();

        if (!$user) {
            return Send::redirect()->route('user.login', [], ['src' => Router::getRoute('order.index')]);
        }

        $message = false;
        if (isset($_SESSION['order']['created'])) {
            $message = true;
            unset($_SESSION['order']['created']);
        }

        $order = Order::find((int) $id);
        $mixes = $order ? $order->getMixes() : [];
        $principles = array_filter($mixes, function ($mix) {
            return $mix->getProduct()->getCategory() == 'Principles';
        });
        $snacks = array_filter($mixes, function ($mix) {
            return $mix->getProduct()->getCategory() == 'Snacks';
        });
        $drinks = array_filter($mixes, function ($mix) {
            return $mix->getProduct()->getCategory() == 'Drinks';
        });
        $desserts = array_filter($mixes, function ($mix) {
            return $mix->getProduct()->getCategory() == 'Desserts';
        });
        
        $title = $order
            ? "Order: {$order->getFormattedCreationTime()}"
            : "Order: does not exist";

        return Send::view('order.show', $title, compact(
            'message',
            'order',
            'principles',
            'snacks',
            'drinks',
            'desserts',
            'user'
        ));
    }

    public static function store($postData)
    {
        $user = UserController::current();
        if (!$user) {
            return Send::redirect()->route('user.login', [], ['src' => Router::getRoute('product.index')]);
        }

        if (!$_SESSION['cart']['products'] && $postData['type'] == 'client') {
            $_SESSION['cart']['error'] = 'There are not products in cart, please add at least one to make de order.';
            return Send::redirect()->route('cart.index');
        } else if (!$_SESSION['cart']['products'] && $postData['type'] == 'admin') {
            return Send::json([
                'status' => 'error',
                'message' => 'There are not products in cart, please add at least one to make de order.'
            ]);
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

        $_SESSION['cart']['products'] = [];
        $_SESSION['cart']['ingredients'] = [];
        
        if ($postData['type'] == 'client') {
            $_SESSION['order']['created'] = true;
            return Send::redirect()->route('order.show', ['id' => $orderId]);
        } else {
            return Send::json([
                'status' => 'ok',
                'message' => 'Order created successfuly!'
            ]);
        }
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

    public static function getLast()
    {
        $orders = Order::where('user_id', UserController::current()->getId())->get();

        if ($orders) {
            return $orders[count($orders) - 1]->getId();
        }

        return null;
    } 
}
