<?php

namespace App\Models;

use App\Models\Model;

class Order extends Model
{

    function __construct() {}

    function getPrice($formated = true): string | float
    {
        $orderLineQuery = "select * from order_line where order_id = {$this->id}";
        $total = array_reduce($this->queryRows($orderLineQuery), function ($total, $prodIngredient) {
            return $total += floatval($prodIngredient['total_price']);
        }, 0);

        return $formated ? number_format($total, 2, ',') : $total;
    }

    function getIngredients(): array
    {
        $ingredients = [];
        $orderLine = $this->queryRows("select distinct ingredient_id from order_line where order_id = {$this->id}");
        $ingredientObjects = array_map(function ($orderIngredient) {
            return Ingredient::find($orderIngredient['ingredient_id']);
        }, $orderLine);
        for ($i = 0; $i < $ingredientObjects; $i++) {
            $ingredients[$i] = get_object_vars($ingredientObjects[$i]);
        }

        return $ingredients;
    }
}
