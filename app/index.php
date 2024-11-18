<?php

require_once('framework/response/Response.php');
require_once('framework/response/Json.php');
require_once('framework/routing/Router.php');
require_once('framework/view/Printable.php');
require_once('framework/view/View.php');
require_once('framework/view/Component.php');
require_once('controllers/Controller.php');
require_once('controllers/SiteController.php');

Framework\Routing\Router::instance()->solve()->send();
