<?php

namespace Src\shop\value_objects;

class CartTotalPrice {

    private readonly float $total_price;

    public function __construct(
        float $total_price
    )
    {
        if($total_price < 0) {
            throw new \InvalidArgumentException("The total price cannot be negative");
        }

        $this->total_price = $total_price;
    }

    public function value() {
        return $this->total_price;
    }

    public function increment_price(float $price) {
        return new self($this->total_price + $price);
    }

    public function decrement_price(float $price) {
        return new self($this->total_price - $price);
    }
}
