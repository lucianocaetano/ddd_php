<?php

namespace Test\Unit\inventories\value_objects;

use PHPUnit\Framework\TestCase;
use Src\inventories\exception\AmountExceedsAllowedDecimalsException;
use Src\inventories\exception\TheAmountCannotBeLessThanOneException;
use Src\inventories\value_objects\Amount;
use Src\inventories\value_objects\Currency;

class AmountTest extends TestCase
{

    public function testAmountConstructorException()
    {
        $this->expectException(TheAmountCannotBeLessThanOneException::class); 

        new Amount(0, new Currency("USD", "$"));
    }

    public function testGetValueMethod()
    {
        $amount = new Amount(100.00,
            new Currency("USD", "$")
        );

        $this->assertIsFloat($amount->amount());
        $this->assertEquals(100.00, $amount->amount());
    }
    
    public function testGetCurrencyMethod()
    {
        $amount = new Amount(100.00,
            new Currency("USD", "$")
        );

        $this->assertInstanceOf(Currency::class, $amount->currency());
        $this->assertEquals(100.00, $amount->amount());
    }

    public function testEditCurrencyMethod()
    {
        $amount = new Amount(100.0,
            new Currency("USD", "$")
        );

        $this->assertInstanceOf(Amount::class, $amount->editCurrency(new Currency("EUR", "€")));
        $this->assertEquals(100.0, $amount->amount());
    }

    public function testEditCurrencyMethodException()
    {
        $this->expectException(AmountExceedsAllowedDecimalsException::class);

        $amount = new Amount(100.11,
            new Currency("USD", "$")
        );

        $amount->editCurrency(new Currency("EUR", "€", 1));
    }

    public function testEditAmountMethod()
    {
        $amount = new Amount(100.0,
            new Currency("USD", "$")
        );

        $this->assertInstanceOf(Amount::class, $amount->editAmount(200.0));
        $this->assertEquals(100.0, $amount->amount());
    }
    
    public function testEditAmountMethodException()
    {
        $this->expectException(AmountExceedsAllowedDecimalsException::class);

        $amount = new Amount(100.00,
            new Currency("USD", "$")
        );

        $amount->editAmount(200.123);

    } 
    
    public function testEditMethod()
    {
        $amount = new Amount(100.00,
            new Currency("USD", "$")
        );

        $this->assertInstanceOf(Amount::class, $amount->edit(200.00, new Currency("EUR", "€")));
    }

    public function testEditMethodException()
    {
        $this->expectException(AmountExceedsAllowedDecimalsException::class);

        $amount = new Amount(100.00,
            new Currency("USD", "$")
        );

        $amount->edit(200.2123, new Currency("EUR", "€"));
    }

    public function testToStringMethod()
    {
        $amount = new Amount(100.00,
            new Currency("USD", "$")
        );

        $this->assertIsString($amount->toString());
        $this->assertEquals("100 USD", $amount->toString());
    }
}
