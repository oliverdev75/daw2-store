<?php

namespace App\Controllers;

use Framework\Response\Send;
use Framework\Response\Types\View;
use Framework\Database\Database;
use App\Models\Product;

class ProductController extends Controller
{

    function index(
        $product_name = null,
        $order = null,
        $order_type = null,
        $principles = null,
        $snacks = null,
        $desserts = null
    ): View
    {
        $viewTitle = 'Menu: SymfonyRestaurant';
        $productsQuery = Product::all();
        
        if ($product_name) {
            $productsQuery = Product::where('name', 'like', "%$product_name%");
            return Send::view('product.index', $viewTitle, ['products' => $productsQuery]);
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
            $productsQuery = Product::in('category', $productsCategoryFilter);
        }

        if ($order) {
            if ($order == 'name') {
                $productsQuery = $productsQuery->orderBy($order, $order_type);
            } else {
                $price = array_reduce(Database::queryObjects());
            }
        }

        return Send::view('product.index', $viewTitle, ['products' => $productsQuery->get()]);
    }
}
