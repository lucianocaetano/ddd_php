<?php

namespace Src\orders\exception;

class ThePriceCannotBeLessThan1Exception extends \InvalidArgumentException {

    public function __construct() {
        parent::__construct("The price cannot be less than 1");
    }
}
