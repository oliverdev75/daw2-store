<?php

namespace App\Controllers;

use Framework\Response\Send;
use Framework\Response\Types\View;
use Framework\Response\Types\Json;
use App\Database\Models\User;

class UserController extends Controller {

    function login(): View
    {
        return Send::view('user.login');
    }

    function signup(): View
    {
        return Send::view('user.signup');
    }

    function show(
        $id
    ): Json
    {
        return Send::json([User::find($id)]);
    }
}