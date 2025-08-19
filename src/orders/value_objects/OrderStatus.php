<?php

namespace Src\orders\value_objects;

/**
 * @package Src\orders\value_objects
 *
 * The objective of this class is to provide a value object for the order status
 */
class OrderStatus {

    /**
     * @var string[] possible values     
     */
    private const STATUSES = [
        'pending',
        'paid',
        'canceled',
        'delivered',
    ];

    /**
     * @param string $status
     * @throws \InvalidArgumentException in case the value is not in the statuses constant
     */
    public function __construct(
        private readonly string $status
    ) {

        if(!in_array($this->status, self::STATUSES))
            throw new \InvalidArgumentException("The status is not valid");
    }

    public function value(): string {
        return $this->status;
    }
}
