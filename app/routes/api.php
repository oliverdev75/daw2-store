<?php

use Framework\Routing\Route;
use Framework\Response\Send;
use App\Controllers\SiteController;
use App\Controllers\UserController;
use App\Models\Product;

Route::get('test.api', '/', fn () => Send::json(['status' => 'In API!!']));
Route::get('test.users', '/user/{id}', [UserController::class, 'show']);

Route::get('test.models', '/products', function () {
    return Send::json([
        'data' => [
            Product::all()
        ]
    ]);
});

Route::get('test.models1', '/product/update', function () {
    Product::where('id', 1)->set('offer_id', 2)->update();
});