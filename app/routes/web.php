<?php

use Framework\Routing\Route;
use Framework\Response\Send;
use App\Controllers\SiteController;

Route::controller(SiteController::class, function () {
    Route::get('main', '/', 'index');
    Route::get('menu', '/cart', 'cart');
    Route::get('menu', '/menu', 'menu');
});
