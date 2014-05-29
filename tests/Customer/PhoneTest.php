<?php
namespace PHPSC\PagSeguro\Test\Customer;

use PHPSC\PagSeguro\Customer\Phone;

class PhoneTest extends \PHPUnit_Framework_TestCase
{
    public function testRealCase01()
    {
        $phone = new Phone(47, 98761234);

        $this->assertEquals(47, $phone->getAreaCode());
        $this->assertEquals(98761234, $phone->getNumber());
    }
}
