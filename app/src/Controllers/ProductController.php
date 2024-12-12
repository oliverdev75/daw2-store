<?php

namespace App\Controllers;

use Framework\Response\Send;
use Framework\Response\Types\View;
use App\Models\Product;

class ProductController extends Controller
{

    function index(
        $product_name = null,
        $order,
        $principles = null,
        $snacks = null,
        $desserts = null
    ): View
    {
        $viewTitle = 'Menu: SymfonyRestaurant';
        $products = Product::all();
        
        if ($product_name) {
            $products = Product::where('name', 'like', "%$product_name%")->get();
            return Send::view('product.index', $viewTitle, ['products' => $products]);
        }

        $productsCategoryFilter = [];
        if ($principles) {
            $productsCategoryFilter[] = 'Principles';
        }

        if ($snacks) {
            $productsCategoryFilter[] = 'Snacks';
        }

        if ($desserts) {
            $productsCategoryFilter[] = 'Desserts';
        }
        
        if (count($productsCategoryFilter)) {
            $products = Product::in('category', $productsCategoryFilter)->get();
            return Send::view('product.index', $viewTitle, ['products' => $products]);
        }

        return Send::view('product.index', $viewTitle, ['products' => $products]);
    }
}
