<?php

namespace Test\Unit\inventory;

use PHPUnit\Framework\TestCase;
use Src\inventories\exception\TheQuantityCannotBeLessThan1Exception;
use Src\inventories\value_objects\ProductQuantity;

class ProductQuantityTest extends TestCase {

    public function testProductQuantityConstructor() {
        $this->expectException(TheQuantityCannotBeLessThan1Exception::class);

        new ProductQuantity(0);
    }

    public function testProductQuantityGetValue() {
        $productQuantity = new ProductQuantity(1);

        $this->assertEquals(1 ,$productQuantity->value());
    }
}
