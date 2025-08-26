<?php

namespace Src\inventories\events\entities;

use DateTime;
use Src\inventories\value_objects\CouponCode;
use Src\inventories\exception\InvalidCouponPercentageException;
use Src\shop\exception\CouponNotValidException;

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
}
