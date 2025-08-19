<?php

namespace Src\shop\events;

use Src\shop\shared\event\BaseEvent;

/**
 * @package Src\shop\events
 *
 * This is an event to use in your use cases, it is to notify the customer about the payment status and to update the order in the bounded context of orders
 */
class PaymentChangeUpdateEvent extends BaseEvent {

    public function __construct(
        private string $client_id,
        private string $client, 
    ) {}
}
