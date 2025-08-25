<?php

namespace Src\inventories\value_objects;

use Src\inventories\exception\TheQuantityCannotBeLessThan1Exception;

class ProductQuantity {
    
    private readonly int $quantity;
       
    public function __construct(
        int $quantity
    )
    {
        if($quantity < 1) {
            throw new TheQuantityCannotBeLessThan1Exception();
        }

        $this->quantity = $quantity;
    }


    public function value() {
        return $this->quantity;
    }
}
