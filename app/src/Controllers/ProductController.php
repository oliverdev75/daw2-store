<?php

namespace App\Controllers;

use Framework\Response\Send;
use Framework\Response\Types\View;
use App\Models\Product;

class ProductController extends Controller
{

    function index(
        $product_name = null,
        $order = null,
        $order_type = null,
        $principles = null,
        $snacks = null,
        $drinks = null,
        $desserts = null
    ): View
    {
        $user = UserController::current();
        $viewTitle = 'Menu: SymfonyRestaurant';
        $productsQuery = Product::all();
        $productsCategoryFilter = [];
        $error = null;
        if (isset($_SESSION['cart']['error'])) {
            $error = $_SESSION['cart']['error'];
            unset($_SESSION['cart']['error']);
        }

        if ($product_name && !($principles || $snacks || $desserts)) {
            $products = [];
            $productsQuery = Product::where('name', 'like', "%$product_name%");

        } else {
            if ($principles) {
                $productsCategoryFilter[] = 'Principles';
            }

            if ($snacks) {
                $productsCategoryFilter[] = 'Snacks';
            }

            if ($drinks) {
                $productsCategoryFilter[] = 'Drinks';
            }

            if ($desserts) {
                $productsCategoryFilter[] = 'Desserts';
            }

            if (count($productsCategoryFilter)) {
                $productsQuery = Product::in('category', $productsCategoryFilter);
            }
        }

        if ($order && !($principles || $snacks || $desserts)) {
            if ($order == 'name') {
                $products = $productsQuery->orderBy($order, $order_type)->get();
            } else {
                $products = $this->orderPrices($productsQuery->get(), $order_type);
                return Send::view('product.index', $viewTitle, ['products' => $products, 'error' => $error, 'user' => $user]);
            }
        } else {
            $products = $productsQuery->get();
        }
        
        return Send::view('product.index', $viewTitle, ['products' => $productsQuery->get(), 'error' => $error, 'user' => $user]);
    }

    private function orderPrices($products, $orderType): array
    {
        $ordered = [];
        $orderedModels = [];
        foreach ($products as $product) {
            $ordered["{$product->getId()}"] = $product->getPrice(false);
        }
        $orderType == 'asc' ? asort($ordered, SORT_NUMERIC) : arsort($ordered, SORT_NUMERIC);
        foreach ($ordered as $id => $price) {
            $orderedModels[] = reset(array_filter($products, function ($product) use ($id) {
                return intval($id) == intval($product->id);
            }));
        }

        return $orderedModels;
    }
}
