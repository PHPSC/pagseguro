<?php
namespace PHPSC\PagSeguro\Shipping;

use PHPSC\PagSeguro\Customer\Address;

class ShippingTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function constructorMustRaiseExceptionWhenTypeIsInvalid()
    {
        new Shipping(-10);
    }

    /**
     * @test
     */
    public function constructorMustBeAbleToReceiveTypeOnly()
    {
        $shipping = new Shipping(Type::TYPE_PAC);

        $this->assertAttributeEquals(Type::TYPE_PAC, 'type', $shipping);
        $this->assertAttributeEquals(null, 'address', $shipping);
        $this->assertAttributeEquals(null, 'cost', $shipping);
    }

    /**
     * @test
     */
    public function constructorMustBeAbleToReceiveTypeAndCost()
    {
        $shipping = new Shipping(Type::TYPE_PAC, null, '10.31');

        $this->assertAttributeEquals(Type::TYPE_PAC, 'type', $shipping);
        $this->assertAttributeEquals(null, 'address', $shipping);
        $this->assertAttributeEquals(10.31, 'cost', $shipping);
    }

    /**
     * @test
     */
    public function constructorMustBeAbleToReceiveTypeAndAddress()
    {
        $address = $this->getMock(Address::class, [], [], '', false);
        $shipping = new Shipping(Type::TYPE_PAC, $address);

        $this->assertAttributeEquals(Type::TYPE_PAC, 'type', $shipping);
        $this->assertAttributeSame($address, 'address', $shipping);
        $this->assertAttributeEquals(null, 'cost', $shipping);
    }

    /**
     * @test
     */
    public function constructorMustBeAbleToReceiveAllArguments()
    {
        $address = $this->getMock(Address::class, [], [], '', false);
        $shipping = new Shipping(Type::TYPE_PAC, $address, '10.31');

        $this->assertAttributeEquals(Type::TYPE_PAC, 'type', $shipping);
        $this->assertAttributeSame($address, 'address', $shipping);
        $this->assertAttributeEquals(10.31, 'cost', $shipping);
    }

    /**
     * @test
     */
    public function getterShouldReturnConfiguredData()
    {
        $address = $this->getMock(Address::class, [], [], '', false);
        $shipping = new Shipping(Type::TYPE_PAC, $address, '10.31');

        $this->assertEquals(Type::TYPE_PAC, $shipping->getType());
        $this->assertSame($address, $shipping->getAddress());
        $this->assertEquals(10.31, $shipping->getCost());
    }

    /**
     * @test
     */
    public function xmlSerializeMustAppendFormattedShippingData()
    {
        $data = simplexml_load_string('<?xml version="1.0" encoding="UTF-8"?><data />');

        $address = new Address('BA', 'Salvador', '40999-999', 'Red River', 'Beco Sem Nome', 25, 'Buteco do França');
        $shipping = new Shipping(Type::TYPE_PAC, $address, '10.31');

        $xml = $shipping->xmlSerialize($data);

        $this->assertEquals(1, (string) $xml->shipping->type);
        $this->assertEquals(10.31, (string) $xml->shipping->cost);

        $this->assertEquals('BRA', (string) $xml->shipping->address->country);
        $this->assertEquals('BA', (string) $xml->shipping->address->state);
        $this->assertEquals('Salvador', (string) $xml->shipping->address->city);
        $this->assertEquals('40999999', (string) $xml->shipping->address->postalCode);
        $this->assertEquals('Red River', (string) $xml->shipping->address->district);
        $this->assertEquals('Beco Sem Nome', (string) $xml->shipping->address->street);
        $this->assertEquals('25', (string) $xml->shipping->address->number);
        $this->assertEquals('Buteco do França', (string) $xml->shipping->address->complement);
    }
}
