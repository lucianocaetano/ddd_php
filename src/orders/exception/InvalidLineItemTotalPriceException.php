<?php

namespace Src\orders\exception;

class InvalidLineItemTotalPriceException extends \InvalidArgumentException {

    public function __construct() {
        parent::__construct("The total price must be greater than 0");
    }
}
