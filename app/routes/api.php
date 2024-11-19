<?php

use Framework\Routing\Route;
use Framework\Response\Send;
use App\Controllers\SiteController;

Route::get('test.api', '/', fn () => Send::json(['status' => 'In API!!']));
Route::get('test.api', '/testing', [SiteController::class, 'testApi']);

Route::get('test.api', '/testing/params/{value}', [SiteController::class, 'testApiParams']);