<?php

namespace Src\shop\value_objects;

class UserPassword {
    public function __construct(private readonly string $password) {

        if(empty($this->password)) {
            throw new \InvalidArgumentException("The password cannot be empty.");
        }

        if(strlen($this->password) < 8) {
            throw new \InvalidArgumentException("The password must be at least 8 characters.");
        }
    }
    
    public function value(): string { return $this->password; }
}
