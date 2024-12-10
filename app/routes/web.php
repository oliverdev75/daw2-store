<?php

use Framework\Routing\Route;
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
    Route::get('user.cart', '/cart', 'cart');
});

Route::controller(ProductController::class, function () {
    Route::get('product.index', '/menu', 'index');
    Route::get('product.show', '/product/{id}', 'show');
});

Route::controller(CartController::class, function () {
    Route::post('cart.addproduct', '/cart/product/add', 'add');
    Route::post('cart.deleteproduct', '/cart/product/delete', 'delete');
});
