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

Router::get('/user/{id}/settings/page/{page}', function ($id, $page) {
    echo "This is $id user and the page $page";
});