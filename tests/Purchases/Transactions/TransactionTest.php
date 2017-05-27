<?php
namespace PHPSC\PagSeguro\Purchases\Transactions;

use DateTime;
use PHPSC\PagSeguro\Shipping\Shipping;
use PHPSC\PagSeguro\Purchases\Details;
use PHPSC\PagSeguro\Items\ItemCollection;

/**
 * @author Adelar Tiemann Junior <adelar@adelarcubs.com>
 */
class TransactionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Transaction
     */
    private $transaction;
       
    /**
     * @var Details
     */
    private $details;
    
    /**
     * @var Payment
     */
    private $payment;
    
    /**
     * @var ItemCollection
     */
    private $itemCollection;
    
    /**
     * @var Shipping
     */
    private $shipping;

    protected function setUp()
    {
        $this->details        = $this->createMock(Details::class);
        $this->payment        = $this->createMock(Payment::class);
        $this->itemCollection = $this->createMock(ItemCollection::class);
        $this->shipping       = $this->createMock(Shipping::class);
        
        $this->transaction = new Transaction(
            $this->details,
            $this->payment,
            1,
            $this->itemCollection,
            $this->shipping
        );
    }

    /**
     * @test
     */
    public function constructShouldConfigureTheAttributes()
    {
        $this->assertAttributeSame($this->details, 'details', $this->transaction);
        $this->assertAttributeSame($this->payment, 'payment', $this->transaction);
        $this->assertAttributeEquals(1, 'type', $this->transaction);
        $this->assertAttributeSame($this->itemCollection, 'items', $this->transaction);
        $this->assertAttributeSame($this->shipping, 'shipping', $this->transaction);
    }

    /**
     * @test
     */
    public function getDetailsShouldReturnTheConfiguredDetails()
    {
        $this->assertSame($this->details, $this->transaction->getDetails());
    }

    /**
     * @test
     */
    public function getTypeShouldReturnTheConfiguredType()
    {
        $this->assertEquals(1, $this->transaction->getType());
    }

    /**
     * @test
     */
    public function getPaymentShouldReturnTheConfiguredPayment()
    {
        $this->assertSame($this->payment, $this->transaction->getPayment());
    }

    /**
     * @test
     */
    public function getItemsShouldReturnTheConfiguredItems()
    {
        $this->assertSame($this->itemCollection, $this->transaction->getItems());
    }

    /**
     * @test
     */
    public function getShippingShouldReturnTheConfiguredShipping()
    {
        $this->assertSame($this->shipping, $this->transaction->getShipping());
    }

    /**
     * @test
     */
    public function getIsWaitingPaymentShouldReturnTheConfiguredIsWaitingPayment()
    {
        $this->assertFalse($this->transaction->isWaitingPayment());
    }

    /**
     * @test
     */
    public function getIsUnderAnalysisShouldReturnTheConfiguredIsUnderAnalysis()
    {
        $this->assertFalse($this->transaction->isUnderAnalysis());
    }

    /**
     * @test
     */
    public function getIsPaidShouldReturnTheConfiguredIsPaid()
    {
        $this->assertFalse($this->transaction->isPaid());
    }

    /**
     * @test
     */
    public function getIsAvailableShouldReturnTheConfiguredIsAvailable()
    {
        $this->assertFalse($this->transaction->isAvailable());
    }

    /**
     * @test
     */
    public function getIsUnderContestShouldReturnTheConfiguredIsUnderContest()
    {
        $this->assertFalse($this->transaction->isUnderContest());
    }

    /**
     * @test
     */
    public function getIsReturnedShouldReturnTheConfiguredIsReturned()
    {
        $this->assertFalse($this->transaction->isReturned());
    }

    /**
     * @test
     */
    public function getIsCancelledShouldReturnTheConfiguredIsCancelled()
    {
        $this->assertFalse($this->transaction->isCancelled());
    }
}
