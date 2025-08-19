<?php

namespace Src\orders\entities\aggregates\order;

use Src\orders\events\OrderCanceledEvent;
use Src\orders\events\OrderPaidEvent;
use Src\orders\exception\TheOrderLineAlreadyExistsException;
use Src\orders\shared\domain\AggregateRoot;
use Src\orders\value_objects\Address;
use Src\orders\value_objects\Id;
use Src\orders\value_objects\OrderStatus;
use Src\orders\value_objects\OrderTotalPrice;

/**
 * @package Src\orders\entities\aggregates\order
 * 
 * Represents an order in the domain
 */
class Order extends AggregateRoot {

    /**
     * @var OrderStatus
     */
    private OrderStatus $status;
        
    /**
     * @param Id $id
     * @param Id $client_id
     * @param string $client_full_name
     * @param string $client_email
     * @param string $client_phone
     * @param array[string, OrderLine] $orders_lines
     * @param string $status
     * @param OrderTotalPrice $total_price
     * @param string $currency
     * @param Address $address_1
     * @param Address|null $address_2
     */
    public function __construct(
        private Id $id,
        private Id $client_id,
        private string $client_full_name,
        private string $client_email,
        private string $client_phone,
        private array $orders_lines,
        private OrderTotalPrice $total_price,
        private string $currency,
        private Address $address_1,
        private ?Address $address_2 = null,
    ) {
        $this->markAsPaid();
    }

    /**
     * @param OrderLine $line
     * @throws \InvalidArgumentException The order line already exists
     */
    public function addOrderLine(OrderLine $line): void {

        if(array_key_exists($line->id(), $this->orders_lines))
            throw new TheOrderLineAlreadyExistsException();
        
        array_push($this->orders_lines, [
           [$line->id()] => $line
        ]);
    }

    /**
     * Mark the order as paid 
     *
     * @return void
     */
    public function markAsPaid(): void {

        $this->status = new OrderStatus('paid');

        $this->recordEvent(
            new OrderPaidEvent(
                $this->id->value(),
                $this->client_id->value(),
                $this->client_full_name,
                $this->client_email,
                $this->client_phone,
                $this->mapItemsToArray(),
                $this->total_price->value(),
                $this->currency,
                $this->address_1->__toString(),
                $this->address_2->__toString(),
                $this->status->value(),
            )
        );
    }

    /**
     * Mark the order as pending 
     *
     * @return void
     */
    public function markAsPending(): void {
        $this->status = new OrderStatus('pending');
        
        $this->recordEvent(
            new OrderCanceledEvent(
                $this->id->value(),
                $this->client_id->value(),
                $this->client_full_name,
                $this->client_email,
                $this->client_phone,
                $this->mapItemsToArray(),
                $this->total_price->value(),
                $this->currency,
                $this->address_1->__toString(),
                $this->address_2->__toString(),
                $this->status->value(),
            )
        );
    }


    /**
     * Mark the order as delivered
     *
     * @return void
     */
    public function markAsDelivered(): void {
        $this->status = new OrderStatus('delivered');
        
        $this->recordEvent(
            new OrderCanceledEvent(
                $this->id->value(),
                $this->client_id->value(),
                $this->client_full_name,
                $this->client_email,
                $this->client_phone,
                $this->mapItemsToArray(),
                $this->total_price->value(),
                $this->currency,
                $this->address_1->__toString(),
                $this->address_2->__toString(),
                $this->status->value(),
            )
        );
    }

    /**
     * Mark the order as canceled 
     *
     * @return void
     */
    public function markAsCancel(): void {
        $this->status = new OrderStatus('canceled');
        
        $this->recordEvent(
            new OrderCanceledEvent(
                $this->id->value(),
                $this->client_id->value(),
                $this->client_full_name,
                $this->client_email,
                $this->client_phone,
                $this->mapItemsToArray(),
                $this->total_price->value(),
                $this->currency,
                $this->address_1->__toString(),
                $this->address_2->__toString(),
                $this->status->value(),
            )
        );
    }

    /**
     * Get the client data
     * 
     * @return array
     */
    public function getDataClient() {
        
        return [
            'client_full_name' => $this->client_full_name,
            'client_email' => $this->client_email,
            'client_phone' => $this->client_phone,
            'address_1' => $this->address_1,
            'address_2' => $this->address_2,
        ];
    }

    private function mapItemsToArray(): array {
        return array_map(function ($order_line) {
            return [
                'id' => $order_line->id(),
                'product_id' => $order_line->product_id(),
                'quantity' => $order_line->quantity(),
                'total_price' => $order_line->total_price(),
            ];
        }, $this->orders_lines);
    }
}
