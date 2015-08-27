<?php
namespace PHPSC\PagSeguro\Purchases\Subscriptions;

use DateTime;

/**
 * @author Adelar Tiemann Junior <adelar@adelarcubs.com>
 */
class ChargeResponseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ChargeResponse
     */
    private $chargeResponse;

    /**
     * @var DateTime
     */
    private $date;

    public function setUp()
    {
        $this->date = new DateTime('2015-01-01');
        $this->chargeResponse = new ChargeResponse('someTransactionCode', $this->date);
    }

    /**
     * @test
     */
    public function constructShouldConfigureTheAttributes()
    {
        $this->assertAttributeEquals('someTransactionCode', 'transactionCode', $this->chargeResponse);
        $this->assertAttributeSame($this->date, 'date', $this->chargeResponse);
    }

    /**
     * @test
     * @depends constructShouldConfigureTheAttributes
     */
    public function getTransactionCodeShouldReturnTheConfiguredTransactionCode()
    {
        $this->assertEquals('someTransactionCode', $this->chargeResponse->getTransactionCode());
    }

    /**
     * @test
     * @depends constructShouldConfigureTheAttributes
     */
    public function getDateShouldReturnTheConfiredDate()
    {
        $this->assertSame($this->date, $this->chargeResponse->getDate());
    }
}
