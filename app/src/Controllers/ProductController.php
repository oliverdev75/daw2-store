<?php

namespace App\Controllers;

use Framework\Response\Send;
use Framework\Response\Types\View;
use App\Models\Product;

class ProductController extends Controller
{

    function index(): View
    {
        return Send::view('product.index', 'Menu', ['products' => Product::all()]);
    }

    function menu(): View
    {
        return Send::view('site.menu');
    }
}
