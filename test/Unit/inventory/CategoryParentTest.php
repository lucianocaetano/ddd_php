<?php

namespace Test\Unit\inventories\value_objects;

use Src\inventories\value_objects\CategoryParent;
use PHPUnit\Framework\TestCase;
use Src\inventories\value_objects\Id;

class CategoryParentTest extends TestCase
{

    public function testCategoryParentStringType()
    {
        $id = new CategoryParent(Id::randomId()->value());

        $this->assertIsString($id->value());
    }
    
    public function testCategoryParentNullType()
    {
        $id = new CategoryParent();

        $this->assertEquals(null, $id->value());
    }

}
