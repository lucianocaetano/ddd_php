<?php

namespace Src\shop\exception;

class CurrencyNotFoundException extends \InvalidArgumentException {

    public function __construct() {
        parent::__construct("Currency not found");
    }
}
