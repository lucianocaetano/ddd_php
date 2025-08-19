<?php

namespace Src\shop\repositories;

use Src\shop\value_objects\Id;
use Src\shop\entities\Product;

/**
 * @package Src\shop\repositories
 *
 * The objective of this interface is to provide a repository for the product
 */
interface ProductRepository {

    /**
     * @param Id $id
     * @return ?Product
     */
    public function find(Id $id): ?Product;

    /**
     * @param Product $product
     * @return ?Product
     */
    public function save(Product $product): ?Product;

    /**
     * @param Id $id
     * @param Product $product
     * @return ?Product
     */
    public function update(Id $id, Product $product): ?Product;

    /**
     * @param Id $id
     * @return void
     */
    public function delete(Id $id): void;
}
