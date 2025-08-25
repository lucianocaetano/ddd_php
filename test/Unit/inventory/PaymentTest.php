<?php

namespace Test\Unit\inventory;

use PHPUnit\Framework\TestCase;
use Src\inventories\entities\Payment;
use Src\inventories\events\PaymentChangeUpdateEvent;
use Src\inventories\value_objects\Amount;
use Src\inventories\value_objects\Currency;
use Src\inventories\value_objects\Id;

class PaymentTest extends TestCase {

    private Payment $payment;

    protected function setUp(): void {
        parent::setUp();

        $this->payment = $this->makePayment();
    }

    private function makePayment(): Payment {
    
        return new Payment(
            Id::randomId(),
            Id::randomId(),
            Id::randomId(),
            "pending",
            new Amount(100, new Currency("USD", "$")),
        );
    }

    public function testPaymentCreate() {
        $payment = $this->payment;
        
        $this->assertInstanceOf(Payment::class, $payment);
    }

    public function testPaymentGetIdMethod() {
        $payment = $this->payment;
        
        $this->assertIsString($payment->id());
    }

    public function testPaymentGetOrderIdMethod() {
        $payment = $this->payment;
        
        $this->assertIsString($payment->order_id());
    }

    public function testPaymentGetClientIdMethod() {
        $payment = $this->payment;
        
        $this->assertIsString($payment->client_id());
    }
    
    public function testPaymentGetAmountMethod() {
        $payment = $this->payment;
        
        $this->assertIsString($payment->amount());
    }
    
    public function testPaymentGetStatusMethod() {
        $payment = $this->payment;
        
        $this->assertEquals("pending", $payment->status());
    }

    public function testEditStatusMethod() {
        $payment = $this->payment;
        
        $payment->editStatus("approved");

        $this->assertEquals("approved", $payment->status());
        $this->assertEquals(1, count($payment->pullDomainEvents()));
        $this->assertEquals(0, count($payment->pullDomainEvents()));
    }

    public function testValidEventTypeWhatReturnEditStatusMethod() {
        $payment = $this->payment;
        
        $payment->editStatus("approved");
        $event = $payment->pullDomainEvents()[0];
        $this->assertInstanceOf(PaymentChangeUpdateEvent::class, $event);
    }
}
