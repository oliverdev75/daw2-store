<?php

namespace Controllers;

use Controllers\Controller;

class ProductController extends Controller {

    public function index($fill)
    {
        return "This is an argument and example is -> $fill";
    }
    
    public function show($id)
    {
        return $this->view("product.show", compact('id'));
    }
}