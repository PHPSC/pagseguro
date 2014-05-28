<?php
namespace PHPSC\PagSeguro\Test\ValueObject;

use PHPSC\PagSeguro\ValueObject\PaymentMethod;

class PaymentMethodTest extends \PHPUnit_Framework_TestCase
{
    public function testRealCase01()
    {
        $paymentMethod = new PaymentMethod(1, 2);

        $this->assertEquals(1, $paymentMethod->getType());
        $this->assertEquals(2, $paymentMethod->getCode());
    }
}
