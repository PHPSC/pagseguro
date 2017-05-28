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
        $name = str_repeat('a', 55);
        $data = simplexml_load_string('<?xml version="1.0" encoding="UTF-8"?><data />');

        $phone = new Phone(12, 999999989);
        $address = new Address('DF', 'Brasília', '70999-999', 'Plano Piloto', 'SQWN 17', 12, 'Apto 507');
        $customer = new Customer($name . '@test.com', $name, $phone, $address);

        $xml = $customer->xmlSerialize($data);

        $this->assertEquals($name . '@test.com', (string) $xml->sender->email);
        $this->assertEquals(str_repeat('a', 55), (string) $xml->sender->name);

        $this->assertEquals('BRA', (string) $xml->sender->address->country);
        $this->assertEquals('DF', (string) $xml->sender->address->state);
        $this->assertEquals('Brasília', (string) $xml->sender->address->city);
        $this->assertEquals('70999999', (string) $xml->sender->address->postalCode);
        $this->assertEquals('Plano Piloto', (string) $xml->sender->address->district);
        $this->assertEquals('SQWN 17', (string) $xml->sender->address->street);
        $this->assertEquals('12', (string) $xml->sender->address->number);
        $this->assertEquals('Apto 507', (string) $xml->sender->address->complement);

        $this->assertEquals(12, (string) $xml->sender->phone->areaCode);
        $this->assertEquals(999999989, (string) $xml->sender->phone->number);
    }

    /**
     * @test
     */
    public function xmlSerializeShouldNotAppendAddressIfItWasntInformed()
    {
        $name = str_repeat('a', 55);
        $data = simplexml_load_string('<?xml version="1.0" encoding="UTF-8"?><data />');

        $phone = new Phone(12, 999999989);
        $customer = new Customer($name . '@test.com', $name, $phone);

        $xml = $customer->xmlSerialize($data);

        $this->assertEquals($name . '@test.com', (string) $xml->sender->email);
        $this->assertEquals(str_repeat('a', 55), (string) $xml->sender->name);

        $this->assertEquals(12, (string) $xml->sender->phone->areaCode);
        $this->assertEquals(999999989, (string) $xml->sender->phone->number);

        $this->assertEmpty($xml->xpath('//sender/address'));
    }

    /**
     * @test
     */
    public function xmlSerializeShouldNotAppendPhoneIfItWasntInformed()
    {
        $name = str_repeat('a', 55);
        $data = simplexml_load_string('<?xml version="1.0" encoding="UTF-8"?><data />');

        $address = new Address('DF', 'Brasília', '70999-999', 'Plano Piloto', 'SQWN 17', 12, 'Apto 507');
        $customer = new Customer($name . '@test.com', $name, null, $address);

        $xml = $customer->xmlSerialize($data);

        $this->assertEquals($name . '@test.com', (string) $xml->sender->email);
        $this->assertEquals(str_repeat('a', 55), (string) $xml->sender->name);

        $this->assertEquals('BRA', (string) $xml->sender->address->country);
        $this->assertEquals('DF', (string) $xml->sender->address->state);
        $this->assertEquals('Brasília', (string) $xml->sender->address->city);
        $this->assertEquals('70999999', (string) $xml->sender->address->postalCode);
        $this->assertEquals('Plano Piloto', (string) $xml->sender->address->district);
        $this->assertEquals('SQWN 17', (string) $xml->sender->address->street);
        $this->assertEquals('12', (string) $xml->sender->address->number);
        $this->assertEquals('Apto 507', (string) $xml->sender->address->complement);

        $this->assertEmpty($xml->xpath('//sender/phone'));
    }
}
