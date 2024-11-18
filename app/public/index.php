<?php



require __DIR__.'/../vendor/autoload.php';

(new \Framework\Routing\Router)->solve()->send();
