<?php

namespace Src\orders\exception;

class CurrencyCodeIsNotSupportedException extends \InvalidArgumentException {

    public function __construct($code) {
        parent::__construct("Currency code {$code} is not supported");
    }
}
