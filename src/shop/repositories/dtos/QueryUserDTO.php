<?php

namespace Src\shop\repositories\dtos;

class QueryUserDTO
{

    public function __construct(
        public readonly string $email,
        public readonly string $name
    ) {}
}
