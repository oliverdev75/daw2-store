<?php

use Framework\Routing\Router;
use Controllers\SiteController;

Router::get('main', '/', [SiteController::class, 'index']);