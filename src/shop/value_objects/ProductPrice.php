<?php

namespace Src\shop\value_objects;

use Src\orders\exception\TheAmountCannotBeLessThanOneException;

class ProductPrice 
{
    private readonly float $price;

    public function __construct(
        $price
    ) {
        if($price < 1) {
            throw new TheAmountCannotBeLessThanOneException();
        }

        $this->price = $price;
    }

    public function value() {
        return $this->price;
    }
}
