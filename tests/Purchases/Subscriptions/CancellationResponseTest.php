<?php
namespace PHPSC\PagSeguro\Purchases\Subscriptions;

use DateTime;

/**
 * @author Adelar Tiemann Junior <adelar@adelarcubs.com>
 */
class CancellationResponseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CancellationResponse
     */
    private $cancellationResponse;

    /**
     * @var DateTime
     */
    private $date;

    public function setUp()
    {
        $this->date = new DateTime('2015-01-01');
        $this->cancellationResponse = new CancellationResponse('someStatus', $this->date);
    }

    /**
     * @test
     */
    public function constructShouldConfigureTheAttributes()
    {
        $this->assertAttributeEquals('someStatus', 'status', $this->cancellationResponse);
        $this->assertAttributeSame($this->date, 'date', $this->cancellationResponse);
    }

    /**
     * @test
     * @depends constructShouldConfigureTheAttributes
     */
    public function getStatusShouldReturnTheConfiguredStatus()
    {
        $this->assertEquals('someStatus', $this->cancellationResponse->getStatus());
    }

    /**
     * @test
     * @depends constructShouldConfigureTheAttributes
     */
    public function getDateShouldReturnTheConfiredDate()
    {
        $this->assertSame($this->date, $this->cancellationResponse->getDate());
    }
}
