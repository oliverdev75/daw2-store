<?php

namespace App\Models;

use App\Models\Model;

class Order extends Model
{

    function __construct() {}

    function getProducts(): array
    {
        $orderProducts = $this->queryRows("select mix_id from orders_mixes where order_id = {$this->id}");
        $products = array_map(function ($orderIngredient) {
            return Ingredient::find($orderIngredient['ingredient_id']);
        }, $orderLine);

        return $products;
    }

    function getIngredients(): array
    {
        $ingredients = [];
        $orderLine = $this->queryRows("select distinct ingredient_id from mix_line where order_id = {$this->id}");
        $ingredients = array_map(function ($orderIngredient) {
            return Ingredient::find($orderIngredient['ingredient_id']);
        }, $orderLine);

        return $ingredients;
    }

    function getPrice($format = true): string | float
    {
        return $format ? number_format($this->subtotal, 2, ',') : $this->subtotal;
    }

    function getIVA($format = true): string | float
    {
        return $format ? number_format($this->iva, 2, ',') : $this->iva;
    }

    function getTotalPrice($format = true): string | float
    {
        return $format ? number_format($this->total_price, 2, ',') : $this->total_price;
    }
}
