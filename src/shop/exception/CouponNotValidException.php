<?php

namespace Src\shop\exception;

use InvalidArgumentException;

class CouponNotValidException extends InvalidArgumentException {

    public function __construct()
    {

        parent::__construct("Coupon not valid");
    }
}
