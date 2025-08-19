<?php

namespace Src\shop\exception;

class InvalidCurrencyCodeException extends \InvalidArgumentException {

    public function __construct(
        private string $code
    )
    {
        parent::__construct("Invalid currency code: {$code}"); 
    }
}
