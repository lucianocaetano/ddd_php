<?php

namespace Src\shop\entities;

use Src\shop\events\PaymentConfirmedEvent;
use Src\shop\exception\CouponNotValidException;
use Src\shop\shared\domain\AggregateRoot;
use Src\shop\value_objects\Address;
use Src\shop\value_objects\Id;

/**
 * @package Src\shop\entities
 * 
 * Represents a product in the domain
 */
class Product extends AggregateRoot {

    /**
     * @param Id $id
     * @param string $slug
     * @param string $name
     * @param string $description
     * @param int $quantity
     * @param float $price
     * @param Id $category_id
     * @param Coupon $coupon
     */
    public function __construct(
        private Id $id,
        private string $slug,
        private string $name,
        private string $description,
        private int $quantity,
        private float $price,
        private Id $category_id,
        private ?Coupon $coupon = null,
    ) {

        if($coupon && !$coupon->isValidNow())
            throw new CouponNotValidException();
    }

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
    public function description(): string {
        
        return $this->description;
    }

    /**
     * @return int
     */
    public function quantity(): int {

        return $this->quantity;
    }

    /**
     * @return float
     */
    public function price(): float {

        if($this->coupon && !$this->coupon->isValidNow())
            return $this->price;

        if($this->coupon)
            return $this->coupon->applyTo($this->price);

        return $this->price;
    }

    /**
     * @return string
     */
    public function category_id(): string {

        return $this->category_id->value();
    }

    /**
     * @return Coupon|null
     */
    public function coupon(): ?Coupon {
        
        return $this->coupon;
    }

    /**
     * @param Coupon $coupon
     * @return void
     */
    public function toggleApplyCoupon(Coupon $coupon): void {
        if($this->coupon) {
            $this->coupon = null;
        }else {
            $this->coupon = $coupon;
        }
    }
    
    /**
     * Confirms the payment and emit event PaymentConfirmedEvent
     *
     * @return void
     */
    public function checkout(
        Id $user_id,
        string $currency,
        string $client_email,
        string $client_full_name,
        string $client_phone, 
        string $payment_method,
        Address $address_1,
        Address $address_2
    ): void
    {

        $this->recordEvent(new PaymentConfirmedEvent(
            $user_id->value(),
            $client_email,
            $client_full_name,
            $client_phone,
            $this->price(),
            $currency,
            $payment_method,
            $this->mapItemsToArray(),
            $this->quantity(),
            $address_1->toString(),
            $address_2->toString()
        ));
    }

    private function mapItemsToArray(): array {
        return [
            "product_id" => $this->id(),
            "quantity" => $this->quantity() 
        ];
    }
}

