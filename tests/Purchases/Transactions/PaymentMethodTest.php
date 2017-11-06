<?php
namespace PHPSC\PagSeguro\Purchases\Transactions;

use PHPUnit\Framework\TestCase;

class PaymentMethodTest extends TestCase
{
    public function testRealCase01()
    {
        $paymentMethod = new PaymentMethod(1, 2);

        $this->assertEquals(1, $paymentMethod->getType());
        $this->assertEquals(2, $paymentMethod->getCode());
    }
}
