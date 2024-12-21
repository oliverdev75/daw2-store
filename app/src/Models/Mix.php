<?php

namespace App\Models;

use App\Models\Model;

class Mix extends Model
{

    protected static $table = 'mixes';

    function __construct() {}

    function getPrice($formated = true): string | float
    {
        $orderMixQuery = "select * from mix_line where mix_id = {$this->id}";
        $total = array_reduce($this->queryRows($orderMixQuery), function ($total, $prodIngredient) {
            return floatval($total += floatval($prodIngredient['total_price']));
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
            $ingredients[$i] = $ingredientObjects[$i]->toArray();
        }

        return $ingredients;
    }
}
