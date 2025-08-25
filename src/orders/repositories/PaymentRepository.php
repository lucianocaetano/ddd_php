<?php

namespace Src\orders\repositories;

use Src\orders\entities\Payment;

interface PaymentRepository {

    /**
     * @return Payment[]
     */
    public function getAll(): array;
    public function save(Payment $payment): Payment;
    public function find(string $id): Payment;
    public function update(Payment $payment): Payment;
}
