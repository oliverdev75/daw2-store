<?php

namespace Controllers;

use Controllers\Controller;
use Framework\View\View;

class SiteController extends Controller {

    function index(): View
    {
        return $this->view('site.index');
    }
}