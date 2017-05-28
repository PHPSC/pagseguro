<?php
namespace PHPSC\PagSeguro\Customer;

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

        $data = simplexml_load_string('<?xml version="1.0" encoding="UTF-8"?><data />');
        
        $phone = new Phone(47, 1234567890);
        $xml = $phone->xmlSerialize($data);

        $this->assertSame($data, $xml);
        $this->assertEquals(47, (string) $xml->phone->areaCode);
        $this->assertEquals(1234567890, (string) $xml->phone->number);
    }
}
