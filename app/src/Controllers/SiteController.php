<?php

namespace App\Controllers;

use Framework\Response\Send;
use Framework\Response\Types\View;
use Framework\Response\Types\Json;

class SiteController extends Controller {

    function index(): View
    {
        return Send::view('site.index');
    }

    function menu(): View
    {
        return Send::view('site.menu');
    }
}