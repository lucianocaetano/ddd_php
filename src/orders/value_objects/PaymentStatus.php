<?php

namespace Src\orders\value_objects;

class PaymentStatus {

    private function getStatus(): array {

        return ['pending', 'authorized', 'completed', 'failed', 'canceled', 'refunded', 'disputed'];
    } 

    public function __construct(
        public string $status
    ) {

        if(!in_array($this->status, $this->getStatus())) {
            throw new \Exception('Invalid payment status');
        } 
    }
}


