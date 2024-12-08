<?php

namespace App\Controllers;

use Framework\Response\Send;
use Framework\Response\Types\View;
use Framework\Response\Types\Json;
use App\Models\User;

class UserController extends Controller
{

    function login(): View
    {
        return Send::view('user.login');
    }

    function signup(): View
    {
        return Send::view('user.signup');
    }

    function auth($username, $password): void
    {
        $user = User::where('username')
    }

    function cart(): View
    {
        return Send::view('user.cart');
    }

    function show(
        $id
    ): Json {
        // $users = [];
        // foreach (User::all() as $user) {
        //     $users[] = $user->toArray();
        // }
        // return Send::json(['data' => $users]);
        return Send::json(['data' => User::where('role', 'editor')->set('surnames', 'sf')->update()]);
    }
}
