<?php

/*  require_once('framework/response/Response.php');
require_once('framework/response/Json.php');
require_once('framework/response/Text.php');
require_once(__DIR__.'/../framework/routing/Router.php');
require_once(__DIR__.'/../framework/routing/Route.php');
require_once('framework/view/Printable.php');
require_once('framework/view/View.php');
require_once('framework/view/Component.php');
require_once('controllers/Controller.php');
require_once('controllers/SiteController.php'); */

require __DIR__.'/../vendor/autoload.php';

(new \Framework\Routing\Router)->solve()->send();
