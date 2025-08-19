<?php

namespace Src\shop\exception;

class CouponAlreadyAddedException extends \InvalidArgumentException {

    public function __construct() {
        parent::__construct("Coupon already added");
    }
}
