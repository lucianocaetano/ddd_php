<?php

namespace Test\Unit\inventory;

use PHPUnit\Framework\TestCase;
use Src\inventories\entities\Product;
use Src\inventories\value_objects\Amount;
use Src\inventories\value_objects\Currency;
use Src\inventories\value_objects\Id;
use Src\inventories\value_objects\ProductQuantity;

class ProductTest extends TestCase
{

    private Product $product;

    protected function setUp(): void
    {
        parent::setUp();

        $this->product = $this->makePayment();
    }

    private function makePayment()
    {
        
        return new Product(
            Id::randomId(),
            "slug",
            "name",
            "description",
            Id::randomId(),
            new ProductQuantity(23),
            new Amount(100, new Currency("USD", "$")),
            Id::randomId(),
        );
    }

    public function testGetIdMethod()
    {
        $id = $this->product->id();

        $this->assertIsString($id);
    }

    public function testGetSlugMethod()
    {
        $slug = $this->product->slug();

        $this->assertIsString($slug);
    }

    public function testGetNameMethod()
    {
        $name = $this->product->name();

        $this->assertIsString($name);
    }

    public function testGetDescriptionMethod()
    {
        $description = $this->product->description();

        $this->assertIsString($description);
    }

    public function testGetSupplierIdMethod()
    {
        $supplierId = $this->product->supplier_id();

        $this->assertIsString($supplierId);
    }

    public function testGetQuantityMethod()
    {
        $quantity = $this->product->quantity();

        $this->assertIsInt($quantity);
    }

    public function testGetPriceMethod()
    {
        $price = $this->product->price();

        $this->assertIsString($price);
    }

    public function testWhatFormatAndValueGetPriceMethodReturn()
    {
        $price = $this->product->price();

        $this->assertEquals('100 USD' ,$price);
    }

    public function testGetCategoryIdMethod()
    {
        $categoryId = $this->product->category_id();

        $this->assertIsString($categoryId);
    }
}
