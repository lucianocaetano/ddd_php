<?php

namespace Src\orders\value_objects;

class PaymentStatus {

    private function getStatus(): array {

        return ['pending', 'approved', 'rejected', 'refunded', 'canceled'];
    } 

    public function __construct(
        public string $status
    ) {

        if(!in_array($this->status, $this->getStatus())) {
            
        } 
    }
}


