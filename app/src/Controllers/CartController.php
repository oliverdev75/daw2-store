<?php

namespace App\Controllers;

use Framework\Response\Send;
use Framework\Response\Types\View;

class CartController extends Controller
{

    static function add($postData)
    {
        if (!UserController::current()) {
            return Send::redirect()->route('user.login')
        }
    }
}
