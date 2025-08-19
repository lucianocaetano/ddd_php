<?php

namespace Test\Unit\__mocks__;

use Exception;
use Src\shop\entities\Product;
use Src\shop\repositories\dtos\QueryProductDTO;
use Src\shop\repositories\dtos\PaginationDTO;
use Src\shop\repositories\ProductRepository;
use Src\shop\value_objects\Id;

class ProductInMemoryRepository implements ProductRepository
{

    private array $products = [];

    public function findAll(QueryProductDTO $query): PaginationDTO
    {

        return new PaginationDTO([], 1, 1);
    }

    public function find(Id $id): Product
    {

        if(!array_key_exists($id->value(), $this->products))
            throw new Exception('Product not found');

        return $this->products[$id->value()];
    }

    public function save(Product $product): Product
    {
        $this->products[$product->id()] = $product;

        return $product;
    }

    public function update(Id $id, Product $product): Product
    {
        if(!array_key_exists($id->value(), $this->products))
            throw new Exception('Product not found');

        $this->products[$id->value()] = $product;

        return $product; 
    }

    public function delete(Id $id)
    {
        if(!array_key_exists($id->value(), $this->products))
            throw new Exception('Product not found');

        unset($this->products[$id->value()]);
    }
}
