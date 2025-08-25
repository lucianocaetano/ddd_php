<?php

namespace Test\Unit\inventory;

use PHPUnit\Framework\TestCase;
use Src\inventories\value_objects\Id;

class IdTest extends TestCase {

    public function testGeneratedId() {
        $id = Id::randomId();

        $this->assertInstanceOf(Id::class, $id);
    }

    public function testEquals() {
        $id1 = Id::randomId();
        $id2 = Id::randomId();
    
        $this->assertTrue($id1->equals($id1));
        $this->assertFalse($id1->equals($id2));
    }

    public function testCustomId() {
        $id = new Id("custom-id");

        $this->assertEquals("custom-id", $id->value());
    }
}
