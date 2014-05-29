<?php
namespace PHPSC\PagSeguro\Test\Customer;

use PHPSC\PagSeguro\Customer\Sender;
use PHPSC\PagSeguro\Customer\Phone;

class SenderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function constructShouldTruncateEmail()
    {
        $sender = new Sender(str_repeat('a', 60) . '@test.com');

        $this->assertAttributeEquals(str_repeat('a', 60), 'email', $sender);
        $this->assertAttributeEquals(null, 'name', $sender);
        $this->assertAttributeEquals(null, 'phone', $sender);
    }

    /**
     * @test
     */
    public function constructShouldTruncateName()
    {
        $sender = new Sender('aa@test.com', str_repeat('a', 60));

        $this->assertAttributeEquals('aa@test.com', 'email', $sender);
        $this->assertAttributeEquals(str_repeat('a', 50), 'name', $sender);
        $this->assertAttributeEquals(null, 'phone', $sender);
    }

    /**
     * @test
     */
    public function constructShouldConfigurePhone()
    {
        $phone = new Phone(11, 999999999);
        $sender = new Sender(str_repeat('a', 60) . '@test.com', null, $phone);

        $this->assertAttributeEquals(str_repeat('a', 60), 'email', $sender);
        $this->assertAttributeEquals(null, 'name', $sender);
        $this->assertAttributeSame($phone, 'phone', $sender);
    }

    /**
     * @test
     */
    public function gettersShouldRetrieveConfiguredData()
    {
        $phone = new Phone(11, 999999999);
        $sender = new Sender('aa@test.com', 'aa', $phone);

        $this->assertEquals('aa@test.com', $sender->getEmail());
        $this->assertEquals('aa', $sender->getName());
        $this->assertSame($phone, $sender->getPhone());
    }
}
