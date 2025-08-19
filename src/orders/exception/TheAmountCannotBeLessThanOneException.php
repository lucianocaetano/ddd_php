<?php

namespace Src\orders\exception;

class TheAmountCannotBeLessThanOneException extends \InvalidArgumentException {

    public function __construct() {
        parent::__construct("The amount cannot be less than 1");
    }
}
