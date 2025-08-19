<?php

namespace Src\shop\value_objects;

final class PaymentMethod
{
    private string $method;

    private static array $allowedMethods = [
        'credit_card',
        'paypal',
        'bank_transfer',
        'cash',
        'crypto',
    ];

    public function __construct(string $method)
    {
        $method = strtolower($method);

        if (!in_array($method, self::$allowedMethods, true)) {
            throw new \InvalidArgumentException("Invalid payment method: {$method}");
        }

        $this->method = $method;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function equals(PaymentMethod $other): bool
    {
        return $this->method === $other->method;
    }

    public function __toString(): string
    {
        return $this->method;
    }
}
