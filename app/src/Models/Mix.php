<?php

namespace App\Models;

class Mix extends Model
{

    protected static $table = 'mixes';

    function __construct() {}

    function getQuantity()
    {
        $query = "SELECT * FROM orders_mixes WHERE mix_id = {$this->id}";
        return $this->queryRows($query)[0]['quantity'];
    }
    
    function getPrice($formated = true): string | float
    {
        $orderMixQuery = "SELECT * FROM mix_line WHERE mix_id = {$this->id}";
        $total = array_reduce($this->queryRows($orderMixQuery), function ($total, $prodIngredient) {
            return $total += $prodIngredient['price'];
        }, 0);

        return $formated ? number_format($total, 2, ',') : $total;
    }

    function getProduct(): Model
    {
        $mixLineProducts = $this->queryRows("SELECT distinct product_id FROM mix_line WHERE mix_id = {$this->id}");
        
        return Product::find($mixLineProducts[0]['product_id'])
            ->setMixIngredients($this->getProductIngredients($mixLineProducts[0]['product_id']));
    }

    private function getProductIngredients($id): array
    {
        $mixLineIngredients = $this->queryRows("SELECT ingredient_id, quantity FROM mix_line WHERE mix_id = {$this->id} AND product_id = $id");
        $ingredients = array_map(function ($mixIngredient) {
            return Ingredient::find($mixIngredient['ingredient_id'])->setQuantity($mixIngredient['quantity']);
        }, $mixLineIngredients);

        return $ingredients;
    }
}
