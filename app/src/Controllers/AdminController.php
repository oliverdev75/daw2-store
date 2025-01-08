<?php

namespace App\Controllers;

use Framework\Response\Send;

class AdminController
{
    public static function users()
    {
        return Send::view('admin.user.index', 'Users: SymfonyRestaurant', [
            'active' => 'users',
            'user' => UserController::current()
        ], 'admin');
    }

    public static function products()
    {
        return Send::view('admin.product.index', 'Products: SymfonyRestaurant', [
            'active' => 'products',
            'user' => UserController::current()
        ], 'admin');
    }

    public static function ingredients()
    {
        return Send::view('admin.ingredient.index', 'Ingredients: SymfonyRestaurant', [
            'active' => 'ingredients',
            'user' => UserController::current()
        ], 'admin');
    }

    public static function orders()
    {
        return Send::view('admin.order.index', 'Orders: SymfonyRestaurant', [
            'active' => 'orders',
            'user' => UserController::current()
        ], 'admin');
    }

    public static function logs()
    {
        return Send::view('admin.logs', 'Logs: SymfonyRestaurant', [
            'active' => 'logs',
            'user' => UserController::current()
        ], 'admin');
    }
}