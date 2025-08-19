<?php

namespace Shop\value_objects;

final class CouponCode {
    private readonly string $code;

    public function __construct(string $code)
    {
        if (!preg_match('/^[A-Z0-9]{5,10}$/', $code)) {
            throw new \InvalidArgumentException("Invalid coupon code format.");
        }
        $this->code = strtoupper($code);
    }

    public function value(): string
    {
        return $this->code;
    }
}

