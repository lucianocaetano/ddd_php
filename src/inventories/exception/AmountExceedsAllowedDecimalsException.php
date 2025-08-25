<?php

namespace Src\inventories\exception;

class AmountExceedsAllowedDecimalsException extends \InvalidArgumentException {

    public function __construct() {
        parent::__construct("Amount exceeds allowed decimals");
    }
}
