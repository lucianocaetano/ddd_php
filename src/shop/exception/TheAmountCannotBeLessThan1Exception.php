<?php

namespace Src\shop\exception;

class TheAmountCannotBeLessThan1Exception extends \InvalidArgumentException {

    public function __construct() {
        parent::__construct("The amount cannot be less than 1");
    }
}
