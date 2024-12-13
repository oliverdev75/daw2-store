<?php

namespace App\Models;

use App\Models\Model;

class Product extends Model
{

    function __construct() {}

    function getPrice($formated = true): string | float
    {
        $ingredientsQuery = "select ingredient_id from products_ingredients where product_id = {$this->getId()}";
        $total = array_reduce($this->queryRows($ingredientsQuery), function ($total, $prodIngredient) {
            return $total += Ingredient::find($prodIngredient['ingredient_id'])->getPrice();
        }, 0);

        return $formated ? number_format($total, 2, ',') : $total;
    }

    function getIngredients(): array
    {
        $ingredients = [];
        $productsIngredients = $this->queryRows("select * from products_ingredients where product_id = {$this->getId()}");
        $ingredientObjects = array_map(function ($prodIngredient) {
            return Ingredient::find($prodIngredient['ingredient_id']);
        }, $productsIngredients);
        for ($i = 0; $i < $ingredientObjects; $i++) {
            $ingredients[$i] = [...get_object_vars($ingredientObjects[$i]), "quantity" => intval($productsIngredients['quantity'])];
        }

        return $ingredients;
    }
}
