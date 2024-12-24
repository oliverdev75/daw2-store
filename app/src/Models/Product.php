<?php

namespace App\Models;

use App\Models\Model;

class Product extends Model
{

    protected $quantity;
    protected $ingredients;

    function __construct() {}

    public function getCategory(): string
    {
        return $this->category;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getMixIngredients()
    {
        return $this->ingredients;
    }

    public function setMixIngredients($ingredients)
    {
        $this->ingredients = $ingredients;

        return $this;
    }

    public function getPrice($format = true): string | float
    {
        $ingredientsQuery = "select * from products_ingredients where product_id = {$this->getId()}";
        $total = array_reduce($this->queryRows($ingredientsQuery), function ($total, $prodIngredient) {
            $total += Ingredient::find($prodIngredient['ingredient_id'])->getPrice() * $prodIngredient['quantity'];
            return $total;
        }, 0);

        return $format ? number_format($total, 2, ',') : $total;
    }

    public function getIngredients(): array
    {
        $productsIngredients = $this->queryRows("select * from products_ingredients where product_id = {$this->getId()}");
        $ingredients = array_map(function ($prodIngredient) {
            return Ingredient::find(intval($prodIngredient['ingredient_id']));
        }, $productsIngredients);
        for ($i = 0; $i < count($ingredients); $i++) {
            $ingredients[$i]->setQuantity(intval($productsIngredients[$i]['quantity']));
        }

        return $ingredients;
    }
}
