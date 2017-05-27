<?php
namespace PHPSC\PagSeguro\Purchases;

use DateTime;
use PHPSC\PagSeguro\Customer\Customer;

/**
 * @author Adelar Tiemann Junior <adelar@adelarcubs.com>
 */
class DetailsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Details
     */
    private $details;

    /**
     * @var DateTime
     */
    private $date;

    /**
     * @var DateTime
     */
    private $lastEventDate;

    /**
     * @var Customer
     */
    private $customer;

    protected function setUp()
    {
        $this->date = new DateTime("2015-01-01");
        $this->lastEventDate = new DateTime("2015-01-01");
        $this->customer = $this->createMock(Customer::class);
        $this->details = new Details(
            '1',
            'SomeRef',
            2,
            $this->date,
            $this->lastEventDate,
            $this->customer
        );
    }

    /**
     * @test
     */
    public function constructShouldConfigureTheAttributes()
    {
        $this->assertAttributeEquals('1', 'code', $this->details);
        $this->assertAttributeEquals('SomeRef', 'reference', $this->details);
        $this->assertAttributeEquals(2, 'status', $this->details);
        $this->assertAttributeSame($this->date, 'date', $this->details);
        $this->assertAttributeSame($this->lastEventDate, 'lastEventDate', $this->details);
        $this->assertAttributeSame($this->customer, 'customer', $this->details);
    }

    /**
     * @test
     * @depends constructShouldConfigureTheAttributes
     */
    public function getCodeShouldReturnTheConfiguredCode()
    {
        $this->assertEquals("1", $this->details->getCode());
    }

    /**
     * @test
     * @depends constructShouldConfigureTheAttributes
     */
    public function getReferenceShouldReturnTheConfiguredReference()
    {
        $this->assertEquals("SomeRef", $this->details->getReference());
    }

    /**
     * @test
     * @depends constructShouldConfigureTheAttributes
     */
    public function getStatusShouldReturnTheConfiguredStatus()
    {
        $this->assertEquals(2, $this->details->getStatus());
    }

    /**
     * @test
     * @depends constructShouldConfigureTheAttributes
     */
    public function getDateShouldReturnTheConfiredDate()
    {
        $this->assertSame($this->date, $this->details->getDate());
    }

    /**
     * @test
     * @depends constructShouldConfigureTheAttributes
     */
    public function getLastEventDateShouldReturnTheConfiredLastEventDate()
    {
        $this->assertSame($this->lastEventDate, $this->details->getLastEventDate());
    }

    /**
     * @test
     * @depends constructShouldConfigureTheAttributes
     */
    public function getCustomerShouldReturnTheConfiredCustomer()
    {
        $this->assertSame($this->customer, $this->details->getCustomer());
    }
}
