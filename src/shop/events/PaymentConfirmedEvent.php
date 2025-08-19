<?php

namespace Src\shop\events;

use Src\shop\shared\event\BaseEvent;

/**
 * @package Src\shop\events
 *
 * Represents a payment confirmed event
 */
class PaymentConfirmedEvent extends BaseEvent
{

    /**
     * @param array<int, array{
     *     id: string,
     *     product_id: string,
     *     quantity: int,
     *     total_price: float
     * }> $articles
     */    
    public function __construct(
        private string $client_id,
        private string $client_email,
        private string $client_name,
        private string $client_phone,
        private float $amount,
        private string $currency,
        private string $method,
        private array $articles,
        private int $total_quantity,
        private string $address_line_1,
        private string $address_line_2,
    ) {}

    public function toPayload(): array {

        return [
            'client_id' => $this->client_id,
            'client_email' => $this->client_email,
            'client_name' => $this->client_name,
            'client_phone' => $this->client_phone,
            'amount' => $this->amount,
            'currency' => $this->currency,
            'method' => $this->method,
            'articles' => $this->articles,
            'total_quantity' => $this->total_quantity,
            'address_line_1' => $this->address_line_1,
            'address_line_2' => $this->address_line_2
        ]; 
    } 
}

