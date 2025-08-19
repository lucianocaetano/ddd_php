<?php

namespace Src\shop\exception;

class InvalidCouponPercentageException extends \InvalidArgumentException {
    
    public function __construct(){
        parent::__construct("Coupon percent can't be greater than 100%");
    } 
}


