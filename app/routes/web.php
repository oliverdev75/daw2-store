<?php

use Framework\Routing\Route;
use Framework\Response\Send;
use App\Controllers\GeneralController;
use App\Controllers\UserController;
use App\Controllers\ProductController;
use App\Controllers\CartController;

Route::controller(GeneralController::class, function () {
    Route::get('main', '/', 'index');
});

Route::controller(UserController::class, function () {
    Route::get('user.login', '/login', 'login');
    Route::post('user.auth', '/login', 'auth');
    Route::get('user.signup', '/signup', 'signup');
    Route::post('user.store', '/signup', 'store');
    Route::get('user.logout', '/logout', 'logout');
    Route::get('user.cart', '/cart', 'cart');
    Route::get('user.orders', '/orders', 'orders');
});

Route::controller(ProductController::class, function () {
    Route::get('product.index', '/menu', 'index');
    Route::get('product.show', '/product/{id}', 'show');
});

Route::controller(CartController::class, function () {
    Route::post('cart.addproduct', '/cart/product/add', 'add');
    Route::post('cart.updateproduct', '/cart/product/update', 'update', 'api');
    Route::post('cart.deleteproduct', '/cart/product/delete', 'delete');
    Route::post('cart.order', '/cart/order', 'order');
});

Route::get('text.cart', '/cartlist', function () {
    session_start();
    return Send::json([$_SESSION['cart']['products'][2]->getQuantity()]);
});