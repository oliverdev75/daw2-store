<?php

namespace App\Controllers;

use Framework\Response\Send;
use Framework\Response\Types\View;

class UserController extends Controller {

    function login(): View
    {
        return Send::view('user.login');
    }

    function signup(): View
    {
        return Send::view('user.signup');
    }
}