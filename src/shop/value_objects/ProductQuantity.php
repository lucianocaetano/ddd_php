<?php

namespace Src\shop\quantity_objects;

class ProductQuantity {
    
    private readonly int $quantity;
       
    public function __construct(
        int $quantity
    )
    {
        if($quantity < 1) {
            throw new \InvalidArgumentException("The quantity cannot be less than 1");
        }

        $this->quantity = $quantity;
    }


    public function value() {
        return $this->quantity;
    }
}
