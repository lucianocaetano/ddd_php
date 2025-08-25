<?php

namespace src\inventories\value_objects;

use Src\inventories\exception\ParentCategoryIDCannotBeEmptyException;

class CategoryParent {

    private readonly ?string $parent;

    public function __construct(
        string $parent = null
    ) {
        if ($parent !== null && trim($parent) === '') {
            throw new ParentCategoryIDCannotBeEmptyException();
        }

        $this->parent = $parent;
    }

    public function value() {
        return $this->parent;
    }
}
