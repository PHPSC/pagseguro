<?php
namespace PHPSC\PagSeguro\Customer;

class CustomerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function constructShouldConfigureTheAttributes()
    {
        $phone = new Phone(11, 999999999);
        $address = new Address('aa', 'aa', '2123', 'aa', 'asdad', 12312);
        $customer = new Customer('aa@test.com', 'aa', $phone, $address);

        $this->assertAttributeEquals('aa@test.com', 'email', $customer);
        $this->assertAttributeEquals('aa', 'name', $customer);
        $this->assertAttributeSame($phone, 'phone', $customer);
        $this->assertAttributeSame($address, 'address', $customer);

        return $customer;
    }

    /**
     * @test
     */
    public function gettersShouldRetrieveConfiguredData()
    {
        $phone = new Phone(11, 999999999);
        $address = new Address('aa', 'aa', '2123', 'aa', 'asdad', 12312);
        $customer = new Customer('aa@test.com', 'aa', $phone, $address);

        $this->assertEquals('aa@test.com', $customer->getEmail());
        $this->assertEquals('aa', $customer->getName());
        $this->assertSame($phone, $customer->getPhone());
        $this->assertSame($address, $customer->getAddress());
    }

    /**
     * @test
     */
    public function xmlSerializeMustAppendFormattedCustomerData()
    {
        $this->markTestSkipped();

        $name = str_repeat('a', 55);
        $xml = simplexml_load_string('<?xml version="1.0" encoding="UTF-8"?><test />');

        $phone = $this->getMock(Phone::class, [], [], '', false);
        $address = $this->getMock(Address::class, [], [], '', false);
        $customer = new Customer($name . '@test.com', $name, $phone, $address);

        $phone->expects($this->any())
              ->method('xmlSerialize')
              ->with($this->isInstanceOf('SimpleXMLElement'));

        $address->expects($this->any())
                ->method('xmlSerialize')
                ->with($this->isInstanceOf('SimpleXMLElement'));

        $customer->xmlSerialize($xml);

        $this->assertEquals($name . '@test', (string) $xml->sender->email);
        $this->assertEquals(str_repeat('a', 50), (string) $xml->sender->name);
    }
}
