<?php

use Framework\Router;

Router::get('/', function () {
    echo "Main page";
});

Router::get('/users', function () {
    echo "Users page";
});

Router::get('/user/{id}', function ($id) {
    echo "This is $id user";
});
