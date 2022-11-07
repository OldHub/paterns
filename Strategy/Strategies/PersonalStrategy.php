<?php

class PersonalStrategy extends AbstractStrategy
{
    public function calcPrice(User $user, float $price): float
    {
        if ($user->personal) {
            return $price - $price / 100 * $user->personal;
        }

        return $price;
    }
}