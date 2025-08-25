<?php

namespace Src\orders\exception;

class TheQuantityCannotBeLessThan1Exception extends \InvalidArgumentException {

    public function __construct() {
        parent::__construct("The quantity cannot be less than 1");
    }
}
