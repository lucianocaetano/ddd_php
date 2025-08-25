<?php

namespace Src\shop\exception;

class ParentCategoryIDCannotBeEmptyException extends \InvalidArgumentException {

    public function __construct()
    {
        parent::__construct("Parent category ID cannot be empty.");
    }
}

