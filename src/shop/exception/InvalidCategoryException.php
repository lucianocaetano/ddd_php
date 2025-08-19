<?php

namespace Src\shop\exception;

class InvalidCategoryException extends \InvalidArgumentException {

    public function __construct() {
        parent::__construct("Invalid category");        
    } 
}
