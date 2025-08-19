<?php

namespace Src\shop\entities;

use Src\shop\value_objects\CategoryParent;
use Src\shop\value_objects\Id;

class Category {
    
    public function __construct(
        private Id $id,
        private string $slug,
        private string $name,
        private CategoryParent $parent,
    ) {}

    public function id(): string {
        return $this->id->value();
    }

    public function slug(): string {
        return $this->slug;
    }

    public function name(): string {
        return $this->name;
    }

    public function parent(): string|null {
        return $this->parent->value();
    }

}
