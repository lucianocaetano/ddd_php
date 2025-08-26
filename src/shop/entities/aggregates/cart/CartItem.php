<?php

namespace Src\shop\entities\aggregates\cart;

use Src\shop\entities\Coupon;
use Src\shop\entities\Product;
use Src\shop\exception\CouponNotValidException;
use Src\shop\value_objects\Id;
use Src\shop\value_objects\Quantity;

/**
 * @package Src\shop\entities\aggregates\cart
 *
 * Represents a cart item in the domain, is an internal entity of the Cart aggregate
 */
class CartItem {

    /**
     * @param Id $id
     * @param Product $product
     * @param Quantity $quantity
     * @param Coupon coupon
     */
    public function __construct(
        private Id $id,
        private Product $product,
        private Quantity $quantity,
        private ?Coupon $coupon = null,
    ) {

        if(!$this->coupon->isValidNow()) {
            throw new CouponNotValidException();
        }

        if($product->coupon()) {
            $this->coupon = $product->coupon(); 
        }
    }

    /**
     * @return string It is the id of the cart item
     */
    public function id(): string {
        return $this->id->value();
    }

    /**
     * @return Product
     */
    public function product(): Product {
        return $this->product;
    }

    /**
     * @return int
     */
    public function quantity(): int {
        return $this->quantity->value();
    }

    /**
     * @return float
     * @throws \InvalidArgumentException Coupon not valid
     */
    public function total_price(): float {

        if(!$this->coupon)
            return $this->product->price() * $this->quantity->value();

        if(!$this->coupon->isValidNow())
            throw new \InvalidArgumentException("Coupon not valid");

        $price = $this->product->price() * $this->quantity->value();

        return $this->coupon->applyTo($price);
    }

    /**
     * @param int $quantity Represents the desired internal quantity to increase in the cart item.
     * @return void
     */
    public function increment_quantity(int $quantity): void {

        $this->quantity = $this->quantity->increment_quantity($quantity);
    }

    /**
     * @param int $quantity Represents the desired internal quantity to decrease in the cart item.
     * @return void
     */
    public function decrement_quantity(int $quantity): void {
        $this->quantity = $this->quantity->decrement_quantity($quantity);
    }
}
