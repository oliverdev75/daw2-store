<?php

namespace App\Models;

class Ingredient extends Model
{

    protected $quantity;

    function __construct(){}

    function getPrice(bool $format = false): float | string
    {
        return $format ? number_format($this->price, 2, ',') : $this->price;
    }

    function getQuantity(): int
    {
        return $this->quantity;
    }

    function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    function getTotalPrice(bool $format = false): float | string
    {
        $total = $this->price * $this->quantity;
        return $format ? number_format($total, 2, ',') : $total;
    }
}
