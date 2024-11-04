<?php

use Framework\Routing\Router;
use Controllers\ProductController;

Router::get('main', '/', function () {
    return new Framework\View\View("index");
});

Router::get('product.show', '/product/{id}', [ProductController::class, 'show']);