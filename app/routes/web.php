<?php

use Framework\Routing\Route;
use App\Controllers\SiteController;
use App\Controllers\UserController;
use App\Controllers\ProductController;

Route::controller(SiteController::class, function () {
    Route::get('main', '/', 'index');
});

Route::controller(UserController::class, function () {
    Route::get('account.login', '/login', 'login');
    Route::get('account.signup', '/signup', 'signup');
    Route::get('cart', '/cart', 'cart');
});

Route::controller(ProductController::class, function () {
    Route::get('product.index', '/menu', 'index');
    Route::get('product.show', '/product/{id}', 'show');
});
