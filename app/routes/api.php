<?php

use Framework\Routing\Route;
use App\Controllers\ApiController;
use App\Controllers\OrderController;

Route::controller(ApiController::class, function () {
    
    // User endpoints
    Route::get('api.user.all', '/users', 'allUser');
    Route::get('api.user.info', '/user/{id}', 'infoUser');
    Route::post('api.user.store', '/user/store', 'storeUpdateUser');
    Route::post('api.user.update', '/user/update', 'storeUpdateUser');
    Route::post('api.user.destroy', '/user/destroy', 'destroyUser');

    // Product endpoints
    Route::get('api.product.all', '/products', 'allProduct');
    Route::get('api.product.info', '/product/{id}', 'infoProduct');
    Route::post('api.product.store', '/product/store', 'storeUpdateProduct');
    Route::post('api.product.update', '/product/update', 'storeUpdateProduct');
    Route::post('api.product.destroy', '/product/destroy', 'destroyProduct');

    // Ingredient endpoints
    Route::get('api.ingredient.all', '/ingredients', 'allIngredient');
    Route::get('api.ingredient.info', '/ingredient/{id}', 'infoIngredient');
    Route::post('api.ingredient.store', '/ingredient/store', 'storeUpdateIngredient');
    Route::post('api.ingredient.update', '/ingredient/update', 'storeUpdateIngredient');
    Route::post('api.ingredient.destroy', '/ingredient/destroy', 'destroyIngredient');

    // Order endpoints
    Route::get('api.order.all', '/orders', 'allOrder');
    Route::get('api.order.info', '/order/{id}', 'infoOrder');

    Route::get('api.logs', '/logs', 'allLog');
});

Route::post('api.order.store', '/order/store', [OrderController::class, 'store']);
