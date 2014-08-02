<?php
namespace PHPSC\PagSeguro\Test\Customer;

use PHPSC\PagSeguro\Customer\Phone;

class PhoneTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function constructMustTruncateData()
    {
        $phone = new Phone(479, 1234567890);

        $this->assertAttributeEquals(479, 'areaCode', $phone);
        $this->assertAttributeEquals(1234567890, 'number', $phone);
    }

    /**
     * @test
     */
    public function gettersShouldReturnConfiguredData()
    {
        $phone = new Phone(47, 98761234);

        $this->assertEquals(47, $phone->getAreaCode());
        $this->assertEquals(98761234, $phone->getNumber());
    }

    /**
     * @test
     */
    public function xmlSerializeMustAppendFormattedPhoneData()
    {
        $xml = simplexml_load_string('<?xml version="1.0" encoding="UTF-8"?><test />');

        $phone = new Phone(479, 1234567890);
        $phone->xmlSerialize($xml);

        $this->assertEquals(47, (string) $xml->phone->areaCode);
        $this->assertEquals(123456789, (string) $xml->phone->number);
    }
}
