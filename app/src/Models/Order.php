<?php

namespace App\Models;

class Order extends Model
{

    protected $formattedCreationTime;

    function __construct() {}

    public function getMixes(): array
    {
        $orderMixes = $this->queryRows("SELECT DISTINCT mix_id FROM orders_mixes WHERE order_id = {$this->id}");
        $mixes = array_map(function ($orderMix) {
            return Mix::find($orderMix['mix_id']);
        }, $orderMixes);

        return $mixes;
    }

    public function getPrice($format = true): string | float
    {
        return $format ? number_format($this->subtotal, 2, ',') : $this->subtotal;
    }

    public function getIVA($format = true): string | float
    {
        return $format ? number_format($this->iva, 2, ',') : $this->iva;
    }

    public function getTotalPrice($format = true): string | float
    {
        return $format ? number_format($this->total_price, 2, ',') : $this->total_price;
    }

    public function getFormattedCreationTime(): string
    {
        $date = $this->getCreationTime();
        $dateMinute = $date['minute'] < 10 ? "0{$date['minute']}" : $date['minute'];
        
        return "{$date['day']}/{$date['month']}/{$date['year']} at {$date['hour']}:{$dateMinute}";
    }
}