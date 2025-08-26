<?php

namespace Src\orders\entities\aggregates\order;

use Src\orders\value_objects\Id;

/**
 * @package Src\shop\entities
 * 
 * Represents a product in the domain
 */
class Product {

    /**
     * @param Id $id
     * @param string $slug
     * @param string $name
     * @param string $description
     * @param int $quantity
     * @param float $price
     * @param Id $category_id
     */
    public function __construct(
        private Id $id,
        private string $slug,
        private string $name,
        private string $description,
        private int $quantity,
        private float $price,
        private Id $category_id,
    ) {}

    /**
     * @return string
     */
    public function id(): string {
        
        return $this->id->value();
    }

    /**
     * @return string
     */
    public function name(): string {
        
        return $this->name;
    }

    /**
     * @return string
     */
    public function description(): string {
        
        return $this->description;
    }

    /**
     * @return int
     */
    public function quantity(): string {

        return $this->quantity;
    }

    /**
     * @return float
     */
    public function price(): float {

        return $this->price;
    }

    /**
     * @return string
     */
    public function category_id(): string {

        return $this->category_id->value();
    }

}

