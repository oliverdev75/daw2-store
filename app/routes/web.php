<?php

use Framework\Routing\Route;
use Framework\Response\Send;
use App\Controllers\GeneralController;
use App\Controllers\UserController;
use App\Controllers\ProductController;
use App\Controllers\CartController;
use App\Controllers\OrderController;
use App\Controllers\AdminController;

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
});

Route::controller(OrderController::class, function () {
    Route::get('order.index', '/orders', 'index');
    Route::get('order.show', '/order/{id}', 'show');
    Route::post('order.store', '/order/store', 'store');
});

Route::get('admin.main', '/admin', function () {
    return Send::redirect()->route('admin.users');
});

Route::controller(AdminController::class, function () {
    Route::get('admin.users', '/admin/users', 'users');
    Route::get('admin.products', '/admin/products', 'products');
    Route::get('admin.ingredients', '/admin/ingredients', 'ingredients');
    Route::get('admin.orders', '/admin/orders', 'orders');
});