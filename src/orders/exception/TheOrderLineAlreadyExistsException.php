<?php

namespace Src\orders\exception;

class TheOrderLineAlreadyExistsException extends \InvalidArgumentException {

    public function __construct()
    {
        parent::__construct('The order line already exists');
    }
}


