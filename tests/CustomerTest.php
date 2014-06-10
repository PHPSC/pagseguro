<?php
namespace PHPSC\PagSeguro\Test;

use PHPSC\PagSeguro\Customer;
use PHPSC\PagSeguro\Phone;

class CustomerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function constructShouldConfigureTheAttributes()
    {
        $phone = new Phone(11, 999999999);
        $customer = new Customer('aa@test.com', 'aa', $phone);

        $this->assertAttributeEquals('aa@test.com', 'email', $customer);
        $this->assertAttributeEquals('aa', 'name', $customer);
        $this->assertAttributeSame($phone, 'phone', $customer);
    }

    /**
     * @test
     */
    public function gettersShouldRetrieveConfiguredData()
    {
        $phone = new Phone(11, 999999999);
        $customer = new Customer('aa@test.com', 'aa', $phone);

        $this->assertEquals('aa@test.com', $customer->getEmail());
        $this->assertEquals('aa', $customer->getName());
        $this->assertSame($phone, $customer->getPhone());
    }

    /**
     * @test
     */
    public function xmlSerializeMustAppendFormattedCustomerData()
    {
        $name = str_repeat('a', 55);
        $xml = simplexml_load_string('<?xml version="1.0" encoding="UTF-8"?><test />');

        $phone = $this->getMock('PHPSC\PagSeguro\Phone', array(), array(), '', false);
        $customer = new Customer($name . '@test.com', $name, $phone);

        $phone->expects($this->any())
              ->method('xmlSerialize')
              ->with($this->isInstanceOf('SimpleXMLElement'));

        $customer->xmlSerialize($xml);

        $this->assertEquals($name . '@test', (string) $xml->sender->email);
        $this->assertEquals(str_repeat('a', 50), (string) $xml->sender->name);
    }
}
