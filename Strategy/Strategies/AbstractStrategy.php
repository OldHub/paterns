<?php

use Interfaces\Strategy;

abstract class AbstractStrategy implements Strategy
{
    public function calcSale(User $user, float $price): float
    {
        return $price;
    }
}