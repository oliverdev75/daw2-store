<?php

namespace Controllers;

use Controller;

class ProductController extends Controller {

    public static function index($fill)
    {
        return "This is an argument and example is -> $fill";
    }
    
    public static function show($prodId, $categoryId)
    {
        return $this->view("products/show", ["This is the product $prodId in the category $categoryId"]);
    }
}