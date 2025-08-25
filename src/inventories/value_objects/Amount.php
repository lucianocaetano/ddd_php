<?php

namespace Src\inventories\value_objects;

use Src\inventories\exception\TheAmountCannotBeLessThanOneException;

class Amount {

    public function __construct(
        public float $amount,
        public Currency $currency
    ) {

        if($this->amount < 1) {
            throw new TheAmountCannotBeLessThanOneException();
        }
        
        $this->currency->assertValidAmount($this->amount);
    }

    public function amount() {

        return $this->amount;
    }

    public function currency() {

        return $this->currency; 
    }

    public function editCurrency(Currency $currency) {

        $currency->assertValidAmount($this->amount);

        return new self(
            $this->amount,
            $currency
        );
    }

    public function editAmount(float $amount) {

        $this->currency->assertValidAmount($amount);
        
        return new self(
            $amount,
            $this->currency
        );
    }

    public function edit(float $amount, Currency $currency) {

        $currency->assertValidAmount($amount);

        return new self(
            $amount,
            $currency
        );
    }

    public function toString() {
        return $this->amount . ' ' . $this->currency->code();
    }
}
