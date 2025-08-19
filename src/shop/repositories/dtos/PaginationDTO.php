<?php

namespace Src\shop\repositories\dtos;

/**
 * @package Src\shop\repositories
 * @template Result
 */
readonly class PaginationDTO {

    /**
     * @param Result $result
     * @param int $current_page
     * @param int $last_page
     */
    public function __construct(
        public readonly array $result,
        public readonly int $current_page,
        public readonly int $last_page
    ) {}
}
