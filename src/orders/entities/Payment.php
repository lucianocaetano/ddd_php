<?php

namespace App\orders\entities;

use Src\orders\value_objects\Amount;
use Src\orders\value_objects\Id;

/**
 * @package App\orders\entities
 *
 * Represents a payment in the domain
 */
class Payment {

    /**
     * @param Id $id
     * @param Id $order_id
     * @param Id $client_id
     * @param string $status
     * @param Amount $amount
     */
    public function __construct(
        private Id $id,
        private Id $order_id,
        private Id $client_id,
        private string $status,
        private Amount $amount
    ) {}

    public function id(): string {
        return $this->id->value();
    }

    public function order_id(): string {
        return $this->order_id->value();
    }

    public function amount(): string {
        return $this->amount->__toString();
    }
}
