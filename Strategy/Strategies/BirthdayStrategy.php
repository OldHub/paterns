<?php

class BirthdayStrategy extends AbstractStrategy
{
    public function __construct(private SaleRepository $saleRepository) { }

    public function calcPrice(User $user, float $price): float
    {
        $interest = $this->saleRepository()->getByType('bithday')->first()->interest;

        return $price - $price / 100 * $interest;
    }
}