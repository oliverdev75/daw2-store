<?php

require_once('framework/Router.php');
require_once('routes/web.php');
require_once('controllers/Controller.php');
require_once('controllers/ProductController.php');

// spl_autoload_register(function ($class) {
//     require_once(dirname($class));
// });

echo Framework\Router::enable();
