<?php

namespace App\Models;

use App\Models\Model;

class Product extends Model
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
}
