<?php

namespace Src\shop\entities\aggregates\cart;

use Src\shop\entities\aggregates\cart\CartItem;
use Src\shop\entities\Coupon;
use Src\shop\entities\Product;
use Src\shop\events\PaymentConfirmedEvent;
use Src\shop\exception\CouponAlreadyAddedException;
use Src\shop\exception\CouponNotFoundException;
use Src\shop\exception\ProductQuantityNotAvailableException;
use Src\shop\exception\YouCanNotAddMoreCouponsException;
use Src\shop\exception\YouCanNotAddMoreThanThreeCouponsException;
use Src\shop\shared\domain\AggregateRoot;
use Src\shop\value_objects\Address;
use Src\shop\value_objects\CartTotalPrice;
use Src\shop\value_objects\Quantity;
use Src\shop\value_objects\Id;

/**
 * @package Src\shop\entities\aggregates\cart
 *
 * Represents a cart in the domain
 */
class Cart extends AggregateRoot {

    /**
     * @param Id $id
     * @param Id $user_id
     * @param CartTotalPrice $total_price
     * @param CartTotalQuantity $total_quantity
     * @param array[string, CartItem] $items
     * @param array[string, Coupon] $coupons
     */
    public function __construct(
        private Id $id,
        private Id $user_id,
        private CartTotalPrice $total_price,
        private Quantity $total_quantity,
        private array $items = [],
        private array $coupons = []
    ) {}


    /**
     * @return string returns the cart id
     */
    public function id(): string {
        return $this->id->value();
    }

    /**
     * @return string returns the user id
     */
    public function user_id(): string {
        return $this->user_id->value();
    }

    /**
     * @return CartItem[] returns the cart items
     */
    public function items(): array {
        return $this->items;
    }

    /**
     * @return float returns the cart total price
     */
    public function total_price(): float {
        return $this->total_price->value();
    }

    /**
     * @return float returns the cart total price with applied coupons
     */
    public function total_price_with_coupons(): float {
        $total_price = $this->total_price;

        foreach ($this->coupons as $_ => $coupon) {
            $total_price = $coupon->applyTo($total_price);
        }
        
        return $total_price->value();
    }

    /**
     * @return int returns the total amount of products in the cart
     */
    public function total_quantity(): int {
        return $this->total_quantity->value();
    }

    /**
     * @return Coupon[] returns the cart coupons
     */
    public function list_coupons(): array {

        return $this->coupons;
    }

    /**
     * Add a coupon to the cart
     *
     * @param Coupon $coupon
     * @return void
     * @throws CouponAlreadyAddedException if the coupon already exists
     * @throws YouCanNotAddMoreCouponsException If the discount drops to 1200 because of this coupon
     * @throws YouCanNotAddMoreThanThreeCouponsException if the cart already has 3 coupons
     */
    public function add_coupon(Coupon $coupon): void {
        if(array_key_exists($coupon->code()->value(), $this->coupons)) throw new CouponAlreadyAddedException();
        if($coupon->applyTo($this->total_price) === 1200.00) throw new YouCanNotAddMoreCouponsException();
        if(count($this->coupons) >= 3) throw new YouCanNotAddMoreThanThreeCouponsException();

        $this->coupons[$coupon->code()->value()] = $coupon;
    }

    /**
     * Remove a coupon from the cart
     *
     * @param Coupon $coupon
     * @return void
     * @throws CouponNotFoundException if the coupon is not found
     */
    public function remove_coupon(Coupon $coupon): void {
        if(!array_key_exists($coupon->code()->value(), $this->coupons)) throw new CouponNotFoundException();

        unset($this->coupons[$coupon->code()->value()]);
    }

    /**
     * Add a product to the cart, if it already exists the product, just increment the quantity
     *
     * @param Product $product
     * @param Quantity $quantity
     * @return void
     * @throws ProductQuantityNotAvailableException
     */
    public function add_product(Product $product, Quantity $quantity): void {
        $productId = $product->id();

        if($product->quantity() < $quantity->value()) {
            throw new ProductQuantityNotAvailableException();
        }

        if (!array_key_exists($productId, $this->items)) {
            $item = new CartItem(
                Id::randomId(),
                $product,
                $quantity
            );

            $this->items[$productId] = $item;

            $this->total_quantity = $this->total_quantity->increment_quantity($quantity->value());
            $this->total_price = $this->total_price->increment_price($product->price() * $quantity->value());
        } else {
    
            $this->items[$productId]->increment_quantity($quantity->value());
            
            $this->total_quantity = $this->total_quantity->increment_quantity($quantity->value());
            $this->total_price = $this->total_price->increment_price($product->price() * $quantity->value());
        }
    }

    /**
     * Remove a product from the cart if it already exists
     *
     * @param Product $product
     * @return void
     */
    public function remove_product(Product $product): void {
        $productId = $product->id();
        if (array_key_exists($productId, $this->items)) {

            $item = $this->items[$productId];

            $this->total_price = $this->total_price->decrement_price(
                $item->total_price()
            );

            $this->total_quantity = $this->total_quantity->decrement_quantity(
                $item->quantity()
            );

            unset($this->items[$productId]);
        }
    }

    /**
     * Remove a product from the cart if it already exists
     *
     * @param Product $product
     * @param Quantity $quantity
     * @return void
     */
    public function decrement_product(Product $product, Quantity $quantity): void {

        $item = $this->items[$product->id()];

        if($item->quantity() === 1) {
            $this->remove_product($product);
            return;
        }

        $item->decrement_quantity($quantity->value()); 
        
        $this->total_price = $this->total_price->decrement_price(
            $product->price() * $quantity->value()
        );

        $this->total_quantity = $this->total_quantity->decrement_quantity(
            $quantity->value()    
        );
    }
    
    /**
     * Confirms the payment and emit event PaymentConfirmedEvent
     *
     * @return void
     */
    public function checkout(
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
            $this->user_id(),
            $client_email,
            $client_full_name,
            $client_phone,
            $this->total_price_with_coupons(),
            $currency,
            $payment_method,
            $this->mapItemsToArray(),
            $this->total_quantity(),
            $address_1->__toString(),
            $address_2->__toString()
        ));
    }

    private function mapItemsToArray(): array {
        return array_map(function (CartItem $item) {
            return [
                "id" => $item->id(),
                "product_id" => $item->product()->id(),
                "quantity" => $item->quantity() 
            ];
        }, $this->items);
    }
}
