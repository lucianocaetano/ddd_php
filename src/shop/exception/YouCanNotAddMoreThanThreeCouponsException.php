<?php

namespace Src\shop\exception;

class YouCanNotAddMoreThanThreeCouponsException extends \InvalidArgumentException {
    
    public function __construct() {
        parent::__construct("You can't add more than 3 coupons");
    }
}
