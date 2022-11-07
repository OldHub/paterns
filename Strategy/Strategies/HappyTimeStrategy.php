<?php

class HappyTimeStrategy extends AbstractStrategy
{
    public function __construct(private SaleRepository $saleRepository) { }

    public function calcPrice(User $user, float $price): float
    {
        $interest = $this->saleRepository()->getByType('happy_type')->first()->interest;

        if ($user->personal) {
            $interest += $user->personal;
        }

        return $price - $price / 100 * $interest;
    }
}