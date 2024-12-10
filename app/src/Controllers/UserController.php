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

    function auth($username, $password)
    {
        $user = User::where('username', $username)->where('password', password_hash($password, PASSWORD_BCRYPT))->get();

        if ($user) {
            session_start();
            $_SESSION['user'] = $user;
            return Send::redirect();
        }

        return Send::view('user.login');
    }

    function current()
    {
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }

        return null;
    }

    function logout()
    {
        session_destroy();
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
