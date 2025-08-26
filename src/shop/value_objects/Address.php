<?php

namespace Src\shop\value_objects;

/**
 * @package Src\shop\value_objects
 *
 * The objective of this class is to provide a value object for the address
 */
class Address {

    /**
     * @param string $street
     * @param string $city
     * @param string $zip
     * param country $country
     */
    public function __construct(
        private string $street,
        private string $city,
        private string $zip,
        private string $country
    ) {}

    public function street(): string {
        return $this->street;
    }

    public function city(): string {
        return $this->city;
    }

    public function zip(): string {
        return $this->zip;
    }

    public function country(): string {
        return $this->country;
    }

    public function toString(): string {
        return $this->street . ', ' . $this->city . ', ' . $this->zip . ', ' . $this->country;
    }
}
