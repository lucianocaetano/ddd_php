<?php

namespace Src\shop\exception;

class CouponNotFoundException extends \InvalidArgumentException {

    public function __construct() {
        parent::__construct("Coupon not found");
    }
}
