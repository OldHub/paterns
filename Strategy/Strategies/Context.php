<?php

use Interfaces\Strategy;

class Context
{
    public function __construct(private Strategy $strategy)
    {
    }

    public function setStrategy(Strategy $strategy)
    {
        $this->strategy = $strategy;
    }

    public function calcPrice(float $price): float
    {
        return $this->strategy->calcSale($price);
    }
}