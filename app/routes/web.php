<?php

use Framework\Routing\Route;
use Framework\Response\Text;
use App\Controllers\SiteController;

Route::get('main', '/', [SiteController::class, 'index']);

Route::get('users', '/users', fn() => new Text("Users PAGE!"));