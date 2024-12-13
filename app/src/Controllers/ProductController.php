<?php

namespace App\Controllers;

use Framework\Response\Send;
use Framework\Response\Types\View;
use Framework\Database\Database;
use App\Models\Product;
use App\Models\Ingredient;

class ProductController extends Controller
{

    function index(
        $product_name = null,
        $order = null,
        $order_type = null,
        $principles = null,
        $snacks = null,
        $desserts = null
    ) {
        $viewTitle = 'Menu: SymfonyRestaurant';
        $productsQuery = Product::all();
        $productsCategoryFilter = [];

        if ($product_name) {
            $products = [];
            $productsQuery = Product::where('name', 'like', "%$product_name%");

            return Send::view('product.index', $viewTitle, ['products' => $products]);
        } else {
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
        }

        if ($order || !($principles || $snacks || $desserts)) {
            if ($order == 'name') {
                $products = $productsQuery->orderBy($order, $order_type)->get();
            } else {
                $products = $this->orderPrices($productsQuery->get(), $order_type);
                return Send::view('product.index', $viewTitle, ['products' => $products]);
            }
        } else {
            $products = $productsQuery->get();
        }

        return Send::view('product.index', $viewTitle, ['products' => $productsQuery->get()]);
    }

    private function orderPrices($products, $orderType): array
    {
        $ordered = [];
        $orderedModels = [];
        foreach ($products as $product) {
            $ordered["$product->id"] = $product->getPrice(false);
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
