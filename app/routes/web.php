<?php

use Framework\Routing\Route;
use Controllers\SiteController;

Route::get('main', '/', [SiteController::class, 'index']);