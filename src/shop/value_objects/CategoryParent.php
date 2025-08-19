<?php

namespace src\shop\value_objects;

class CategoryParent {

    private readonly ?string $parent;

    public function __construct(
        ?string $parent = null
    ) {
        if ($parent !== null && trim($parent) === '') {
            throw new \InvalidArgumentException('Parent category ID cannot be empty.');
        }

        $this->parent = $parent;
    }

    public function value() {
        return $this->parent;
    }
}
