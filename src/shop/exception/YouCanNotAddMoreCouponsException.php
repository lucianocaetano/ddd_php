<?php

namespace Src\shop\exception;

class YouCanNotAddMoreCouponsException extends \InvalidArgumentException {

    public function __construct() {
        parent::__construct("You can't add more coupons");
    }
}
