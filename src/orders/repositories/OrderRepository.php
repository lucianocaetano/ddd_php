<?php

namespace Src\orders\repositories\dtos;

use Src\orders\entities\aggregates\order\Order;

/**
 * @package Src\orders\repositories
 *
 * The objective of this interface is to provide a repository for the order 
 */
interface OrderRepository {

    public function save(Order $order);
    public function findById(string $id);
    public function findByClientId(string $client_id);
    public function update(Order $order);
}

