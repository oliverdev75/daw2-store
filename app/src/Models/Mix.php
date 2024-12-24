<?php

namespace App\Models;

use App\Models\Model;

class Mix extends Model
{

    protected static $table = 'mixes';

    function __construct() {}

    function getPrice($formated = true): string | float
    {
        $orderMixQuery = "SELECT * from mix_line where mix_id = {$this->id}";
        $total = array_reduce($this->queryRows($orderMixQuery), function ($total, $prodIngredient) {
            return $total += $prodIngredient['price'];
        }, 0);

        return $formated ? number_format($total, 2, ',') : $total;
    }

    function getProducts(): array
    {
        $mixLineProducts = $this->queryRows("SELECT distinct product_id from mix_line where mix_id = {$this->id}");
        $products = array_map(function ($mixProduct) {
            $product = Product::find($mixProduct['product_id']);
            return $product->setMixIngredients($this->getProductIngredients($mixProduct['product_id']));
        }, $mixLineProducts);

        return $products;
    }

    private function getProductIngredients($id): array
    {
        $mixLineIngredients = $this->queryRows("SELECT ingredient_id, quantity from mix_line where mix_id = {$this->id} product_id = $id");
        $ingredients = array_map(function ($mixIngredient) {
            return Ingredient::find($mixIngredient['ingredient_id'])->setQuantity($mixIngredient['quantity']);
        }, $mixLineIngredients);

        return $ingredients;
    }
}
