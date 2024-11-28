<?php

use Framework\Routing\Route;
use Framework\Response\Send;
use App\Controllers\SiteController;
use App\Controllers\UserController;

Route::get('test.api', '/', fn () => Send::json(['status' => 'In API!!']));
Route::get('test.users', '/user/{id}', [UserController::class, 'show']);
