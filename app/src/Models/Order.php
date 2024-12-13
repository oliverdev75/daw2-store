<?php

namespace App\Models;

use App\Models\Model;

class Order extends Model
{

    function __construct(){}
    
    function getPrice($formated = true): string | float
    {
        $ingredientsQuery = "select ingredient_id from products_ingredients where product_id = {$this->id}";
        $total = array_reduce($this->queryRows($ingredientsQuery), function ($total, $prodIngredient) {
            return $total += Ingredient::find($prodIngredient['ingredient_id'])->price;
        }, 0);
        
        return $formated ? number_format($total, 2, ',') : $total;
    }

    function getIngredients(): array
    {
        $ingredients = [];
        $orderLine = $this->queryRows("select * from order_line where order_id = {$this->id}");
        $ingredientObjects = array_map($productsIngredients, function ($prodIngredient) {
            return Ingredient::find($prodIngredient['ingredient_id']);
        });
        for ($i = 0; $i < $ingredientObjects; $i++) {
            $ingredients[$i] = [...get_object_vars($ingredientObjects[$i]), "quantity" => intval($productsIngredients['quantity'])];
        }
        
        return $ingredients;
    }
}
