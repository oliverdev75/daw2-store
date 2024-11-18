<?php

use Framework\Routing\Route;
use App\Controllers\SiteController;

Route::get('test.api', '/testing', [SiteController::class, 'testApi']);