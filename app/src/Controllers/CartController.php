<?php

namespace App\Controllers;

use Framework\Response\Send;
use Framework\Response\Types\View;

class CartController extends Controller
{

    function index(): View
    {
        return Send::view('site.index');
    }
}
