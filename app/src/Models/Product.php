<?php

namespace App\Models;

use App\Models\Model;

class Product extends Model
{

    function __construct() {}

    public function getCategory(): string
    {
        return $this->category;
    }

    public function getPrice($formated = true): string | float
    {
        $ingredientsQuery = "select ingredient_id from products_ingredients where product_id = {$this->getId()}";
        $total = array_reduce($this->queryRows($ingredientsQuery), function ($total, $prodIngredient) {
            return $total += Ingredient::find($prodIngredient['ingredient_id'])->getPrice();
        }, 0);

        return $formated ? number_format($total, 2, ',') : $total;
    }

    public function getIngredients(): array
    {
        $ingredients = [];
        $productsIngredients = $this->queryRows("select * from products_ingredients where product_id = {$this->getId()}");
        $ingredientObjects = array_map(function ($prodIngredient) {
            $ingr = Ingredient::find(intval($prodIngredient['ingredient_id']));
            return $ingr;
        }, $productsIngredients);
        for ($i = 0; $i < count($ingredientObjects); $i++) {
            $ingredients[$i] = [
                ...$ingredientObjects[$i]->toArray(),
                'quantity' => $productsIngredients[$i]['quantity'],
                'image' => $ingredientObjects[$i]->getImage()
            ];
        }

        return $ingredients;
    }
}
