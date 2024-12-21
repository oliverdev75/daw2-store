<?php

namespace App\Models;

use App\Models\Model;

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
        return $this->quantity = $quantity;
    }

    function getTotalPrice(bool $format = false): float | string
    {
        $total = $this->price * $this->quantity;
        return $format ? number_format($total, 2, ',') : $total;
    }

}
