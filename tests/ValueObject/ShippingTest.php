<?php
namespace PHPSC\PagSeguro\Test\ValueObject;

use PHPSC\PagSeguro\ValueObject\Shipping;

class ShippingTest extends \PHPUnit_Framework_TestCase
{
    public function testRealCase01()
    {
        $shipping = new Shipping(Shipping::TYPE_PAC);

        $this->assertEquals(Shipping::TYPE_PAC, $shipping->getType());
        $this->assertNull($shipping->getAddress());
        $this->assertNull($shipping->getCost());
    }

    public function testRealCase02()
    {
        $address = $this->getMock('PHPSC\PagSeguro\ValueObject\Address', array(), array(), '', false);

        $shipping = new Shipping(Shipping::TYPE_PAC, $address);
        $this->assertEquals(Shipping::TYPE_PAC, $shipping->getType());
        $this->assertInstanceOf('PHPSC\PagSeguro\ValueObject\Address', $shipping->getAddress());
        $this->assertNull($shipping->getCost());
    }

    public function testRealCase03()
    {
        $shipping = new Shipping(Shipping::TYPE_PAC, null, 10);

        $this->assertEquals(Shipping::TYPE_PAC, $shipping->getType());
        $this->assertNull($shipping->getAddress());
        $this->assertNotInstanceOf('PHPSC\PagSeguro\ValueObject\Address', $shipping->getAddress());
        $this->assertEquals(10, $shipping->getCost());
    }

    public function testRealCase04()
    {
        $address = $this->getMock('PHPSC\PagSeguro\ValueObject\Address', array(), array(), '', false);

        $shipping = new Shipping(Shipping::TYPE_PAC, $address, 15);
        $this->assertEquals(Shipping::TYPE_PAC, $shipping->getType());
        $this->assertInstanceOf('PHPSC\PagSeguro\ValueObject\Address', $shipping->getAddress());
        $this->assertEquals(15, $shipping->getCost());
    }
}