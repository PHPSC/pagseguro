<?php
namespace PHPSC\PagSeguro\Purchases\Transactions;

use DateTime;

class Payment
{
    /**
     * @var DateTime
     */
    private $escrowEndDate;

    /**
     * @var PaymentMethod
     */
    private $paymentMethod;

    /**
     * @var float
     */
    private $grossAmount;

    /**
     * @var float
     */
    private $discountAmount;

    /**
     * @var float
     */
    private $feeAmount;

    /**
     * @var float
     */
    private $netAmount;

    /**
     * @var float
     */
    private $extraAmount;

    /**
     * @var int
     */
    private $installmentCount;

    /**
     * @param PaymentMethod $paymentMethod
     * @param float $grossAmount
     * @param float $discountAmount
     * @param float $feeAmount
     * @param float $netAmount
     * @param float $extraAmount
     * @param int $installmentCount
     * @param DateTime $escrowEndDate
     */
    public function __construct(
        PaymentMethod $paymentMethod,
        $grossAmount,
        $discountAmount,
        $feeAmount,
        $netAmount,
        $extraAmount,
        $installmentCount,
        DateTime $escrowEndDate = null
    ) {
        $this->escrowEndDate = $escrowEndDate;
        $this->paymentMethod = $paymentMethod;
        $this->grossAmount = $grossAmount;
        $this->discountAmount = $discountAmount;
        $this->feeAmount = $feeAmount;
        $this->netAmount = $netAmount;
        $this->extraAmount = $extraAmount;
        $this->installmentCount = $installmentCount;
    }

    /**
     * @return DateTime
     */
    public function getEscrowEndDate()
    {
        return $this->escrowEndDate;
    }

    /**
     * @return PaymentMethod
     */
    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }

    /**
     * @return number
     */
    public function getGrossAmount()
    {
        return $this->grossAmount;
    }

    /**
     * @return number
     */
    public function getDiscountAmount()
    {
        return $this->discountAmount;
    }

    /**
     * @return number
     */
    public function getFeeAmount()
    {
        return $this->feeAmount;
    }

    /**
     * @return number
     */
    public function getNetAmount()
    {
        return $this->netAmount;
    }

    /**
     * @return number
     */
    public function getExtraAmount()
    {
        return $this->extraAmount;
    }

    /**
     * @return number
     */
    public function getInstallmentCount()
    {
        return $this->installmentCount;
    }
}
