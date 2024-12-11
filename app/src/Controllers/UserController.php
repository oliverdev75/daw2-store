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

    static function store($postData)
    {
        var_dump($postData);
        if ($postData['password'] != $postData['password_confirm']) {
            return Send::view('user.signup', self::LOGIN_TITLE, ['message' => 'Passwords don\'t match.']);
        }

        $data = [
            'name' => $postData['name'],
            'email' => $postData['email'],
            'password' => password_hash($postData['password'], PASSWORD_BCRYPT)
        ];
        if ($postData['surnames']) {
            $data['surnames'] = $postData['surnames'];
        }

        User::create($data);

        return Send::redirect()->route('user.login');
    }

    static function auth($postData)
    {
        $user = User::where('email', $postData['username'])->get();
        if (!$user) {
            return Send::view('user.login', self::LOGIN_TITLE, ['message' => 'Username or password wrong']);
        }

        if (password_verify($postData['password'], $user[0]->password)) {
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
        session_start();
        session_unset();
        session_destroy();

        return Send::redirect()->route('user.login');
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
