<?php

class SaleManager
{
    /**
     * @throws Exception
     */
    public function getPrice(PostController $order, User $user): float
    {
        $context = new Context(app(PersonalStrategy::class));

        if ($user->bithday) {
            $context->setStrategy(app(BirthdayStrategy::class));
        } elseif ($this->checkHappyTime()) {
            $context->setStrategy(app(HappyTimeStrategy::class));
        }

        return $context->calcPrice($order->price);
    }

    /**
     * @throws Exception
     */
    private function checkHappyTime(): bool
    {
        return random_int(0, 1);
    }
}