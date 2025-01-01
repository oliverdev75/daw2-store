<?php

use Framework\Routing\Route;
use App\Controllers\ApiController;
use App\Controllers\OrderController;

Route::controller(ApiController::class, function () {
    
    // User endpoints
    Route::get('api.user.all', '/users', 'allUser');
    Route::get('api.user.info', '/user/{id}', 'infoUser');
    Route::post('api.user.store', '/user/store', 'storeUser');
    Route::post('api.user.update', '/user/update', 'updateUser');
    Route::post('api.user.delete', '/user/delete', 'deleteUser');

    // Product endpoints
    Route::get('api.product.all', '/products', 'allProduct');
    Route::get('api.product.info', '/product/{id}', 'infoProduct');
    Route::post('api.product.store', '/product/store', 'storeProduct');
    Route::post('api.product.update', '/product/update', 'updateProduct');
    Route::post('api.product.delete', '/product/delete', 'deleteProduct');

    // Ingredient endpoints
    Route::get('api.ingredient.all', '/ingredients', 'allIngredient');
    Route::get('api.ingredient.info', '/ingredient/{id}', 'infoIngredient');
    Route::post('api.ingredient.store', '/ingredient/store', 'storeIngredient');
    Route::post('api.ingredient.update', '/ingredient/update', 'updateIngredient');
    Route::post('api.ingredient.delete', '/ingredient/delete', 'deleteIngredient');

    // Order endpoints
    Route::get('api.order.all', '/orders', 'allOrder');
    Route::get('api.order.info', '/order/{id}', 'infoOrder');

});

Route::post('api.order.store', '/order/store', [OrderController::class, 'store']);
