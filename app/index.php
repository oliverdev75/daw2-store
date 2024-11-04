<?php

require_once('framework/Response.php');
require_once('framework/routing/Router.php');
require_once('routes/web.php');
require_once('framework/view/Printable.php');
require_once('framework/view/View.php');
require_once('framework/view/Component.php');
require_once('controllers/Controller.php');
require_once('controllers/ProductController.php');

Framework\Routing\Router::enable()->getView()->show();
