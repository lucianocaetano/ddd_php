<?php

namespace Src\shop\entities;

use DateTime;
use Exception;
use Shop\value_objects\CouponCode;
use Src\shop\exception\InvalidCouponPercentageException;
use Src\shop\value_objects\CartTotalPrice;

/**
 * @package Src\shop\entities
 *
 * Represents a coupon in the domain
 */
class Coupon {

    /**
     * @param CouponCode $code
     * @param string $type
     * @param float $amount
     * param DateTime $expiresAt
     * @param bool $isActive
     * @throws InvalidCouponPercentageException
     */
    public function __construct(
        public readonly CouponCode $code,
        public readonly string $type,
        public readonly float $amount,
        public readonly DateTime $expiresAt,
        public readonly bool $isActive
    ) {
        
        if($type === 'percent' && $amount > 100) throw new InvalidCouponPercentageException();
    }

    public function code() {
        return $this->code;
    }

    public function isValidNow(): bool
    {
        return $this->isActive && new DateTime() < $this->expiresAt;
    }

    public function applyTo(CartTotalPrice $subtotal): float
    {
        $subtotal = $subtotal->value();

        if (!$this->isValidNow()) throw new Exception("Coupon not valid");

        return match ($this->type) {
            'fixed' => max($subtotal - $this->amount, 0),
            'percent' => max($subtotal * (1 - $this->amount / 100), 0),
            default => $subtotal,
        };
    }
}
