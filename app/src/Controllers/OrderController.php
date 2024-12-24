<?php

namespace App\Controllers;

use Framework\Response\Send;
use Framework\Response\Types\View;
use Framework\Routing\Router;
use App\Models\Order;

class OrderController extends Controller
{

    function index()
    {
        $user = UserController::current();

        if (!$user) {
            return Send::redirect()->route('user.login', [], ['src' => Router::getRoute('order.index')]);
        }

        return Send::view('order.index', 'Orders: SymfonyRestaurant', [
            'orders' => Order::where('user_id', $user->getId())->get(),
            'user' => UserController::current()
        ]);
    }

    function show($id)
    {
        $user = UserController::current();

        if (!$user) {
            return Send::redirect()->route('user.login', [], ['src' => Router::getRoute('order.index')]);
        }

        $order = Order::find((int) $id);
        $orderDate = $order->getCreationTime();
        $title = "Order: {$orderDate['day']}/{$orderDate['month']}/{$orderDate['year']} at {$orderDate['hour']}:{$orderDate['minute']}";

        return Send::view('order.show', $title, compact('order', 'user'));
    }

}
