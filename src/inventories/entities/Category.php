<?php

namespace Src\inventories\entities;

use Src\inventories\value_objects\CategoryParent;
use Src\inventories\value_objects\Id;

/**
 * @package Src\inventories\entities
 *
 * Represents a category in the domain
 */
class Category {

    /**
     * @param Id $id
     * @param string $slug
     * @param string $name
     * @param CategoryParent $parent
     */ 
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
