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

        $this->assertAttributeEquals(47, 'areaCode', $phone);
        $this->assertAttributeEquals(123456789, 'number', $phone);
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
}
