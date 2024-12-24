<?php

namespace App\Controllers;

use Framework\Response\Send;
use Framework\Response\Types\View;
use Framework\Response\Types\Json;
use Framework\Routing\Router;
use App\Models\User;

class UserController extends Controller
{

    const LOGIN_TITLE = 'Log in: SymfonyRestaurant';
    const SIGNUP_TITLE = 'Sign up: SymfonyRestaurant';

    static function login($src = null): View
    {
        return Send::view('user.login', self::LOGIN_TITLE, compact('src'));
    }

    static function logout()
    {
        session_start();
        session_unset();
        session_destroy();

        return Send::redirect()->route('user.login');
    }

    static function auth($postData)
    {
        if (self::current()) {
            return Send::redirect();
        }
        
        $user = User::where('email', $postData['username'])->first();
        if (!$user) {
            return Send::view('user.login', self::LOGIN_TITLE, ['message' => 'Username or password wrong', 'src' => urlencode($postData['src'])]);
        }

        if (password_verify($postData['password'], $user->getPassword())) {
            $_SESSION['user'] = $user;
            if (urldecode($postData['src'])) {
                return Send::redirect(urldecode($postData['src']));
            }
            return Send::redirect()->route('main');
        }

        return Send::view('user.login', self::LOGIN_TITLE, ['message' => 'Username or password wrong', 'src' => $postData['src'], 'user' => null]);
    }

    static function signup(): View
    {
        return Send::view('user.signup', self::SIGNUP_TITLE, ['user' => null]);
    }

    static function store($postData)
    {
        $role = "";
        if ($postData['password'] != $postData['password_confirm']) {
            return Send::view('user.signup', self::LOGIN_TITLE, ['message' => 'Passwords don\'t match.']);
        }

        $data = [
            'name' => $postData['name'],
            'email' => $postData['email'],
            'role' => 'client',
            'password' => password_hash($postData['password'], PASSWORD_BCRYPT)
        ];

        if ($postData['surnames']) {
            $data['surnames'] = $postData['surnames'];
        }

        if (!User::where('role', 'admin')->first()) {
            $data['role'] = 'admin';
        }

        User::create($data);

        return Send::redirect()->route('user.login');
    }

    static function current()
    {
        session_start();
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }

        return null;
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
