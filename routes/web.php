<?php

use Framework\Router;
use Controllers\ProductController;

Router::get('/', function () {
    return "Main page";
});

Router::get('/users', function () {
    return "Users page";
});

Router::get('/user/{id}', function ($id) {
    return "This is $id user";
});

Router::get('/user/{id}/settings', function ($page, $some, $id) {
    return "This is $id user and the page $page in $some";
});

Router::get('/product/{fill}', [ProductController::class, 'index']);