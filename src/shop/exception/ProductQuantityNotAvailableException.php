<?php

namespace Src\shop\exception;

class ProductQuantityNotAvailableException extends \InvalidArgumentException {

    public function __construct()
    {
        parent::__construct("Product quantity not available");
    }
}
