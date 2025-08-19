<?php

namespace Src\shop\factories;

use Src\shop\entities\aggregates\cart\Cart;
use Src\shop\entities\aggregates\order\Order;
use Src\shop\value_objects\Address;
use Src\shop\value_objects\CurrencyCode;
use Src\shop\value_objects\Id;
use Src\shop\value_objects\OrderTotalPrice;

/** 
 * @package Src\shop\factories
 * 
 * The goal of this class is to provide a factory for ordering, with the purpose of helping simplify your use cases. 
 */
class OrderFactory {

    /**
     * @param Cart $cart
     * @param string $client_full_name
     * @param string $client_email
     * @param string $client_phone
     * @param CurrencyCode $currency
     * @param Address $address_1
     * @param Address|null $address_2
     * @return Order
     */
    public static function make(
        Cart $cart,
        string $client_full_name,
        string $client_email,
        string $client_phone,
        CurrencyCode $currency,
        Address $address_1,
        ?Address $address_2 = null
    ): Order {

        return new Order(
            Id::randomId(), 
            new Id($cart->user_id()),
            $client_full_name,
            $client_email,
            $client_phone,
            $cart->items(),
            new OrderTotalPrice($cart->total_price()),
            $currency,
            $address_1,
            $address_2
        );
    }
}
