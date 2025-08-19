<?php

namespace Src\orders\value_objects;

class Quantity {
    
    public function __construct(
        private readonly int $quantity = 1
    ) {

        if($this->quantity < 1) {
            throw new \InvalidArgumentException("The quantity cannot be less than 1");
        }
    }

    public function value(): int {
        return $this->quantity;
    }

    public function increment_quantity(int $quantity = 1): self {
        return new self($this->quantity + $quantity);
    }

    public function decrement_quantity(int $quantity = 1): self {
        return new self($this->quantity - $quantity);
    }
}
