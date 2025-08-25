<?php

namespace Test\Unit\inventory;

use PHPUnit\Framework\TestCase;
use Src\inventories\exception\AmountExceedsAllowedDecimalsException;
use Src\inventories\exception\CurrencyCodeIsNotSupportedException;
use Src\inventories\value_objects\Currency;

class CurrencyTest extends TestCase
{

    public function testCurrencyConstructor() {
        $this->expectException(CurrencyCodeIsNotSupportedException::class);

        new Currency('BRL', '$');
    }

    public function testCurrencyEquals() {
        $currency = new Currency('USD', '$');
    
        $this->assertTrue($currency->equals(new Currency('USD', '$')));
        $this->assertFalse($currency->equals(new Currency('EUR', '$')));
    }

    public function testCurrencyCode() {
        $currency = new Currency('USD', '$');
    
        $this->assertEquals('USD', $currency->code());
    }

    public function testCurrencySymbol() {
        $currency = new Currency('USD', '$');
    
        $this->assertEquals('$', $currency->symbol());
    }

    public function testCurrencyDecimals() {
        $currency = new Currency('USD', '$');
    
        $this->assertEquals(2, $currency->decimals());
    }

    public function testCurrencyAssertValidAmount() {
        $currency = new Currency('USD', '$', 4);
    
        $this->expectException(AmountExceedsAllowedDecimalsException::class);
        $currency->assertValidAmount(1.123456789);
    }
} 
