<?php

namespace Src\shop\repositories\dtos;

use src\shop\value_objects\CategoryParent;

/**
 * @package Src\shop\repositories
 */
readonly class QueryCategoryDTO {

    /**
     * @param string $name
     * @param CategoryParent $parent
     * @param string $order
     * @param int $page
     * @param int $limit
     */
    public function __construct(
        private readonly string $name = null,
        private readonly CategoryParent $parent = null,
        private readonly string $order = "asc",
        private readonly int $page = 1,
        private readonly int $limit = 15,
    ) {}

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function getOrder(): bool {
        return $this->order;
    }

    /**
     * @return CategoryParent
     */
    public function getParent(): CategoryParent {
        return $this->parent;
    } 

    /**
     * @return int
     */
    public function getPage(): int {
        return $this->page;
    }

    /**
     * @return int
     */
    public function getLimit(): int {
        return $this->limit;
    }
}
