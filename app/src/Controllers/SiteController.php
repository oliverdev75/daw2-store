<?php

namespace App\Controllers;

use Framework\Response\Send;
use Framework\Response\Types\View;
use App\Models\User;

class SiteController extends Controller
{

    function index(): View
    {
        User::create([]);
        return Send::view('site.index');
    }

    function menu(): View
    {
        return Send::view('site.menu');
    }
}
