<?php

namespace Controllers;

use Controller;

class ProductController extends Controller {

    
    public function show($prodId, $categoryId)
    {
        return $this->view("products/show", ["This is the product $prodId in the category $categoryId"]);
    }
}