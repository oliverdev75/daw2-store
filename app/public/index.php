<?php



require __DIR__.'/../vendor/autoload.php';

error_reporting(E_ERROR | E_PARSE);

(new \Framework\Routing\Router)->solve()->send();
