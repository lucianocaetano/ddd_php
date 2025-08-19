<?php

namespace Src\shop\repositories\dtos;

use Src\shop\value_objects\ProductPrice;

/**
 * @package Src\shop\repositories
 */
readonly class QueryProductDTO {

    /**
     * @param string $name
     * @param string $description
     * @param ProductPrice $price_lte
     * @param ProductPrice $price_gte
     * @param string $order
     * @param int $page
     * @param int $limit
     */
    public function __construct(
        private readonly string $name = null,
        private readonly string $description = null,
        private readonly ProductPrice $price_lte = null,
        private readonly ProductPrice $price_gte = null,
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

    public function getDescription(): string {
        return $this->description;
    }

    public function getOrder(): string {
        return $this->order;
    }

    public function getPriceLte(): ProductPrice {
        return $this->price_lte;
    }

    public function getPriceGte(): ProductPrice {
        return $this->price_gte;
    }

    public function getPage(): int {
        return $this->page;
    }

    public function getLimit(): int {
        return $this->limit;
    }
}
