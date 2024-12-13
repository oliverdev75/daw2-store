<?php

namespace App\Models;

use App\Models\Model;

class Ingredient extends Model
{

    function __construct(){}

    function getPrice()
    {
        return (float) $this->price;
    }
    
}
