<?php

namespace App\Controllers;

use Framework\View\View;
use Framework\Response\Json;

class SiteController extends Controller {

    function index(): View
    {
        return $this->view('site.index');
    }

    function testApi(): Json
    {
        return $this->json(['status' => 'OK', 'data' => 'The API Works!!']);
    }
}