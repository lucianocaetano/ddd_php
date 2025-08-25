<?php

namespace Src\inventories\entities;

use Src\inventories\shared\domain\AggregateRoot;
use Src\inventories\value_objects\Amount;
use Src\inventories\value_objects\Id;
use Src\inventories\events\PaymentChangeUpdateEvent;

/**
 * @package Src\inventories\entities
 *
 * Represents a payment in the domain
 */
class Payment extends AggregateRoot {

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
        return $this->amount->toString();
    }

    public function client_id(): string {
        return $this->client_id->value();
    }

    public function status(): string {
        return $this->status; 
    }

    public function editStatus(string $status): void {
        $this->status = $status;
        $this->recordEvent(
            new PaymentChangeUpdateEvent(
                $this->id(),
                $this->client_id(), 
                $this->status()
            )
        );
    }
}
