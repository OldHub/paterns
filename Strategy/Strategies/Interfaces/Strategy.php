<?php

namespace Interfaces;

interface Strategy
{
    public function calcSale(User $user, float $price): float;
}