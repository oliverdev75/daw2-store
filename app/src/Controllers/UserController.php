<?php

namespace App\Controllers;

use Framework\Response\Send;
use Framework\Response\Types\View;
use Framework\Response\Types\Json;
use App\Models\User;

class UserController extends Controller
{

    const LOGIN_TITLE = 'Log in: SymfonyRestaurant';

    static function login(): View
    {
        return Send::view('user.login');
    }

    static function signup(): View
    {
        return Send::view('user.signup');
    }

    static function store(
        $name,
        $surnames,
        $email,
        $password,
        $password_confirm
    ) {
        if ($password != $password_confirm) {
            return Send::view('user.signup', self::LOGIN_TITLE, ['message' => 'Passwords don\'t match.']);
        }

        $data = [
            'name' => $name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_BCRYPT)
        ];
        if ($surnames) {
            $data['surnames'] = $surnames;
        }

        User::create($data);

        return Send::redirect()->route('user.login');
    }

    static function auth($username, $password)
    {
        $user = User::where('email', $username)->where('password', password_hash($password, PASSWORD_BCRYPT))->get();

        if ($user) {
            session_start();
            $_SESSION['user'] = $user;
            return Send::redirect();
        }

        return Send::view('user.login', self::LOGIN_TITLE, ['message' => 'Username or password wrong']);
    }

    static function current()
    {
        session_start();
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }

        return null;
    }

    static function logout()
    {
        session_destroy();
    }

    static function cart(): View
    {
        return Send::view('user.cart');
    }

    static function show(
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
