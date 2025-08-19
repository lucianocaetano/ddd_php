<?php

namespace Src\orders\events;

use Src\shop\shared\event\BaseEvent;

class OrderCanceledEvent extends BaseEvent {

    /**
     * @param array<int, array{
     *     id: string,
     *     product_id: string,
     *     quantity: int,
     *     total_price: float
     * }> $orders_lines
     */
    public function __construct(
        private string $id,
        private string $client_id,
        private string $client_full_name,
        private string $client_email,
        private string $client_phone,
        private array $orders_lines,
        private string $total_price,
        private string $currency,
        private string $address_1,
        private string $address_2,
        private string $status,
    ){}

    public function toPayload(): array {
        return [
            'id' => $this->id,
            'client_id' => $this->client_id,
            'client_full_name' => $this->client_full_name,
            'client_email' => $this->client_email,
            'client_phone' => $this->client_phone,
            'orders_lines' => $this->orders_lines,
            'total_price' => $this->total_price,
            'currency' => $this->currency,
            'address_1' => $this->address_1,
            'address_2' => $this->address_2,
            'status' => $this->status,
        ];
    }
}
