<?php

namespace Src\orders\entities;

use Src\orders\quantity_objects\ProductQuantity;
use Src\orders\value_objects\Id;
use Src\orders\value_objects\ProductPrice;

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
     * @param ProductQuantity $quantity
     * @param ProductPrice $price
     * @param Id $category_id
     */
    public function __construct(
        private Id $id,
        private string $slug,
        private string $name,
        private string $description,
        private ProductQuantity $quantity,
        private ProductPrice $price,
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

        return $this->quantity->value();
    }

    /**
     * @return float
     */
    public function price(): float {

        return $this->price->value();
    }

    /**
     * @return string
     */
    public function category_id(): string {

        return $this->category_id->value();
    }

}

