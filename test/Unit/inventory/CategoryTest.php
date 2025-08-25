<?php

namespace Test\Unit\inventory;

use PHPUnit\Framework\TestCase;
use Src\inventories\entities\Category;
use Src\inventories\value_objects\CategoryParent;
use Src\inventories\value_objects\Id;

class CategoryTest extends TestCase
{

    private Category $category;

    public function setUp(): void
    {
        $this->category = $this->makeCategory();
    }

    private function makeCategory(): Category 
    {
        
        return new Category(
            Id::randomId(),
            "slug",
            "name",
            new CategoryParent(Id::randomId()->value()), 
        );
    }

    public function testGetIdMethod()
    {
        $id = $this->category->id();

        $this->assertIsString($id);
    }

    public function testGetSlugMethod()
    {
        $slug = $this->category->slug();

        $this->assertIsString($slug);
    }

    public function testGetNameMethod()
    {
        $name = $this->category->name();

        $this->assertIsString($name);
    }

    public function testGetParentMethod()
    {
        $parent = $this->category->parent();

        $this->assertIsString($parent);
    }
}
