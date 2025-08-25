<?php

namespace Src\inventories\entities;

use Src\inventories\value_objects\Amount;
use Src\inventories\value_objects\ProductQuantity;
use Src\inventories\value_objects\Id;

/**
 * @package Src\inventories\entities
 * 
 * Represents a product in the domain
 */
class Product {

    /**
     * @param Id $id
     * @param string $slug
     * @param string $name
     * @param string $description
     * @param Id $supplier_id
     * @param ProductQuantity $quantity
     * @param Amount $price
     * @param Id $category_id
     */
    public function __construct(
        private Id $id,
        private string $slug,
        private string $name,
        private string $description,
        private Id $supplier_id,
        private ProductQuantity $quantity,
        private Amount $price,
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
    public function slug(): string {
        
        return $this->slug;
    }

    /**
     * @return string
     */
    public function description(): string {
        
        return $this->description;
    }

    /**
     * @return string
     */
    public function supplier_id(): string {
        
        return $this->supplier_id->value();
    }

    /**
     * @return int
     */
    public function quantity(): int {

        return $this->quantity->value();
    }

    /**
     * @return string
     */
    public function price(): string {

        return $this->price->toString();
    }

    /**
     * @return string
     */
    public function category_id(): string {

        return $this->category_id->value();
    }
}

