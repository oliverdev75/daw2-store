<?php

use Framework\Routing\Route;
use Framework\Response\Send;
use App\Controllers\GeneralController;
use App\Controllers\UserController;
use App\Controllers\ProductController;
use App\Controllers\CartController;
use App\Controllers\OrderController;

Route::controller(GeneralController::class, function () {
    Route::get('main', '/', 'index');
});

Route::controller(UserController::class, function () {
    Route::get('user.login', '/login', 'login');
    Route::post('user.auth', '/login', 'auth');
    Route::get('user.signup', '/signup', 'signup');
    Route::post('user.store', '/signup', 'store');
    Route::get('user.logout', '/logout', 'logout');
});

Route::controller(ProductController::class, function () {
    Route::get('product.index', '/menu', 'index');
    Route::get('product.show', '/product/{id}', 'show');
});

Route::controller(CartController::class, function () {
    Route::get('cart.index', '/cart', 'index');
    Route::post('cart.addproduct', '/cart/product/add', 'add');
    Route::post('cart.updateproduct', '/cart/product/update', 'update', 'api');
    Route::post('cart.deleteproduct', '/cart/product/delete', 'delete');
    Route::post('cart.order', '/cart/order', 'order');
});

Route::controller(OrderController::class, function () {
    Route::get('order.index', '/orders', 'index');
    Route::get('order.show', '/order/{id}', 'show');
});

Route::get('text.cart', '/cartlist', function () {
    session_start();
    var_dump($_SESSION['cart']['products']);
});