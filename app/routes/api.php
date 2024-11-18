<?php

use Framework\Routing\Route;
use Controllers\SiteController;

Route::get('test.api', '/testing', [SiteController::class, 'testApi']);