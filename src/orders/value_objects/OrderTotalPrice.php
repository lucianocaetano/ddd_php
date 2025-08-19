<?php

namespace Src\orders\value_objects;

/**
 * @package Src\orders\value_objects
 *
 * The objective of this class is to provide a value object for the order total price
 */
class OrderTotalPrice
{

    /**
     * @param float $total_price
     * @throws \InvalidArgumentException The total price must be greater than 0
     */ 
    public function __construct(
        private readonly float $total_price
    ) {

        if($this->total_price < 1)
            throw new \InvalidArgumentException("The total price must be greater than 0");
    }

    /**
     * @return float returns the order line total price
     */
    public function value(): float {
        return $this->total_price;
    }
}
