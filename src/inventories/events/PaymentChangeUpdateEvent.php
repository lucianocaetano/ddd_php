<?php

namespace Src\inventories\events;

use Src\inventories\shared\event\BaseEvent;

/**
 * @package Src\inventories\events
 *
 * This is an event to use in your use cases, it is to notify the customer about the payment status and to update the order in the bounded context of orders
 */
class PaymentChangeUpdateEvent extends BaseEvent {

    public function __construct(
        private string $payment_id,
        private string $client_id,
        private string $status,
    ) {}

    public function toPayload(): array {
        return [
            'payment_id' => $this->payment_id,
            'client_id' => $this->client_id,
            'status' => $this->status,
        ];
    }
}
