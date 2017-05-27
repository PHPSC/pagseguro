<?php
namespace PHPSC\PagSeguro\Purchases\Transactions;

use DateTime;

/**
 * @author Adelar Tiemann Junior <adelar@adelarcubs.com>
 */
class PaymentTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Payment
     */
    private $payment;
    
    /**
     * @var DateTime
     */
    private $escrowEndDate;
    
    /**
     * @var PaymentMethod
     */
    private $paymentMethod;

    protected function setUp()
    {
        $this->escrowEndDate = new DateTime("2015-01-01");
        $this->paymentMethod = $this->createMock(PaymentMethod::class);
        $this->payment = new Payment($this->paymentMethod, 123, 2, 3, 4, 5, 1, $this->escrowEndDate);
    }

    /**
     * @test
     */
    public function constructShouldConfigureTheAttributes()
    {
        $this->assertAttributeSame($this->paymentMethod, 'paymentMethod', $this->payment);
        $this->assertAttributeEquals(123, 'grossAmount', $this->payment);
        $this->assertAttributeEquals(2, 'discountAmount', $this->payment);
        $this->assertAttributeEquals(3, 'feeAmount', $this->payment);
        $this->assertAttributeEquals(4, 'netAmount', $this->payment);
        $this->assertAttributeEquals(5, 'extraAmount', $this->payment);
        $this->assertAttributeEquals(1, 'installmentCount', $this->payment);
    }

    /**
     * @test
     */
    public function getPaymentMethodShouldReturnTheConfiredPaymentMethod()
    {
        $this->assertSame($this->paymentMethod, $this->payment->getPaymentMethod());
    }

    /**
     * @test
     */
    public function getGrossAmountShouldReturnTheConfiredGrossAmount()
    {
        $this->assertEquals(123, $this->payment->getGrossAmount());
    }

    /**
     * @test
     */
    public function getDiscountAmountShouldReturnTheConfiredDiscountAmount()
    {
        $this->assertEquals(2, $this->payment->getDiscountAmount());
    }

    /**
     * @test
     */
    public function getFeeAmountShouldReturnTheConfiredFeeAmount()
    {
        $this->assertEquals(3, $this->payment->getFeeAmount());
    }

    /**
     * @test
     */
    public function getNetAmountShouldReturnTheConfiredNetAmount()
    {
        $this->assertEquals(4, $this->payment->getNetAmount());
    }

    /**
     * @test
     */
    public function getExtraAmountShouldReturnTheConfiredExtraAmount()
    {
        $this->assertEquals(5, $this->payment->getExtraAmount());
    }

    /**
     * @test
     */
    public function getInstallmentCountShouldReturnTheConfiredInstallmentCount()
    {
        $this->assertEquals(1, $this->payment->getInstallmentCount());
    }

    /**
     * @test
     */
    public function getEscrowEndDateShouldReturnTheConfiredEscrowEndDate()
    {
        $this->assertSame($this->escrowEndDate, $this->payment->getEscrowEndDate());
    }
}
