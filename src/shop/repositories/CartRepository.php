<?php

namespace Src\shop\repositories;

use Src\shop\entities\aggregates\cart\Cart;
use Src\shop\value_objects\Id;

/**
 * @package Src\shop\repositories
 *
 * The objective of this interface is to provide a repository for the cart
 */
interface CartRepository {

    /**
     * @param Id $user_id It has to be the user's id to get their cart.
     * @return Cart 
     */
    public function findByUserId(Id $user_id): Cart;

    /**
     * @param Cart $cart
     * @return Cart
     */
    public function save(Cart $cart): Cart;

    /**
     * @param Id $user_id It has to be the user's id to get their cart.
     * @param Cart $cart
     */
    public function update(Id $user_id, Cart $cart): Cart;

    /**
     * @param Id $id
     * @return void
     */
    public function delete(Id $id): void;
}

