<?php
namespace PHPSC\PagSeguro\Test;

use PHPSC\PagSeguro\Customer;
use PHPSC\PagSeguro\Phone;

class CustomerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function constructShouldTruncateEmail()
    {
        $customer = new Customer(str_repeat('a', 60) . '@test.com');

        $this->assertAttributeEquals(str_repeat('a', 60), 'email', $customer);
        $this->assertAttributeEquals(null, 'name', $customer);
        $this->assertAttributeEquals(null, 'phone', $customer);
    }

    /**
     * @test
     */
    public function constructShouldTruncateName()
    {
        $customer = new Customer('aa@test.com', str_repeat('a', 60));

        $this->assertAttributeEquals('aa@test.com', 'email', $customer);
        $this->assertAttributeEquals(str_repeat('a', 50), 'name', $customer);
        $this->assertAttributeEquals(null, 'phone', $customer);
    }

    /**
     * @test
     */
    public function constructShouldConfigurePhone()
    {
        $phone = new Phone(11, 999999999);
        $customer = new Customer(str_repeat('a', 60) . '@test.com', null, $phone);

        $this->assertAttributeEquals(str_repeat('a', 60), 'email', $customer);
        $this->assertAttributeEquals(null, 'name', $customer);
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
}
