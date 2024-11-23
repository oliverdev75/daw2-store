<?php

use Framework\Routing\Route;
use Framework\Routing\Router;
use Framework\Response\Send;
use App\Controllers\SiteController;
use App\Controllers\UserController;

Route::controller(SiteController::class, function () {
    Route::get('main', '/', 'index');
    Route::get('menu', '/menu', 'menu');
    Route::get('cart', '/cart', 'cart');
});

Route::controller(UserController::class, function () {
    Route::get('account.login', '/login', 'login');
    Route::get('account.signup', '/signup', 'signup');
});