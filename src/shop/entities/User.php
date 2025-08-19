<?php

namespace Src\shop\entities;

use Src\shop\value_objects\Address;
use Src\shop\value_objects\Id;

/**
 * @package Src\shop\entities
 *
 * The objective of this class is to provide a value object for the user
 */
class User {

    /**
     * @param Id $id
     * @param string $name
     * @param string $email
     * @param string $phone
     * @param string $password
     * @param OrderAddress $address
     * @param Id $cart_id
     */
    public function __construct(
        private Id $id,
        private string $name,
        private string $email,
        private string $phone,
        private string $password,
        private Id $cart_id,
        private Address $address,
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
    public function email(): string {
        return $this->email;
    }

    /**
     * @return string
     */
    public function phone(): string {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function password(): string {
        return $this->password;
    }
    
    /**
     * @return string
     */
    public function cart_id(): string {
        return $this->cart_id->value();
    }
} 
