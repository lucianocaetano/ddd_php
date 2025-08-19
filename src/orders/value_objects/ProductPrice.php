<?php

namespace Src\orders\value_objects;

class ProductPrice 
{
    private readonly float $price;

    public function __construct(
        $price
    ) {
        if($price < 1) {
            throw new \InvalidArgumentException("The price cannot be less than 1");
        }

        $this->price = $price;
    }

    public function value() {
        return $this->price;
    }
}
