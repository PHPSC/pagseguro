<?php
namespace PHPSC\PagSeguro\ValueObject;

use DateTime;
use PHPSC\PagSeguro\Customer\Shipping;

class Transaction
{
    /**
     * @var int
     */
    const WAITING_PAYMENT = 1;

    /**
     * @var int
     */
    const UNDER_ANALYSIS = 2;

    /**
     * @var int
     */
    const PAID = 3;

    /**
     * @var int
     */
    const AVAILABLE = 4;

    /**
     * @var int
     */
    const UNDER_CONTEST = 5;

    /**
     * @var int
     */
    const RETURNED = 6;

    /**
     * @var int
     */
    const CANCELLED = 7;

    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $reference;

    /**
     * @var int
     */
    private $type;

    /**
     * @var int
     */
    private $status;

    /**
     * @var DateTime
     */
    private $date;

    /**
     * @var DateTime
     */
    private $lastEventDate;

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
     * @var array
     */
    private $items;

    /**
     * @var Sender
     */
    private $sender;

    /**
     * @var Shipping
     */
    private $shipping;

    /**
     * @param string $code
     * @param string $reference
     * @param int $type
     * @param int $status
     * @param DateTime $date
     * @param DateTime $lastEventDate
     * @param PaymentMethod $paymentMethod
     * @param float $grossAmount
     * @param float $discountAmount
     * @param float $feeAmount
     * @param float $netAmount
     * @param float $extraAmount
     * @param int $installmentCount
     * @param array $items
     * @param Sender $sender
     * @param Shipping $shipping
     * @param DateTime $escrowEndDate
     */
    public function __construct(
        $code,
        $reference,
        $type,
        $status,
        DateTime $date,
        DateTime $lastEventDate,
        PaymentMethod $paymentMethod,
        $grossAmount,
        $discountAmount,
        $feeAmount,
        $netAmount,
        $extraAmount,
        $installmentCount,
        array $items,
        Sender $sender,
        Shipping $shipping,
        DateTime $escrowEndDate = null
    ) {
        $this->code = $code;
        $this->reference = $reference;
        $this->type = $type;
        $this->status = $status;
        $this->date = $date;
        $this->lastEventDate = $lastEventDate;
        $this->escrowEndDate = $escrowEndDate;
        $this->paymentMethod = $paymentMethod;
        $this->grossAmount = $grossAmount;
        $this->discountAmount = $discountAmount;
        $this->feeAmount = $feeAmount;
        $this->netAmount = $netAmount;
        $this->extraAmount = $extraAmount;
        $this->installmentCount = $installmentCount;
        $this->items = $items;
        $this->sender = $sender;
        $this->shipping = $shipping;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @return number
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return number
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return boolean
     */
    public function isWaitingPayment()
    {
        return $this->getStatus() === static::WAITING_PAYMENT;
    }

    /**
     * @return boolean
     */
    public function isUnderAnalysis()
    {
        return $this->getStatus() === static::UNDER_ANALYSIS;
    }

    /**
     * @return boolean
     */
    public function isPaid()
    {
        return $this->getStatus() === static::PAID;
    }

    /**
     * @return boolean
     */
    public function isAvailable()
    {
        return $this->getStatus() === static::AVAILABLE;
    }

    /**
     * @return boolean
     */
    public function isUnderContest()
    {
        return $this->getStatus() === static::UNDER_CONTEST;
    }

    /**
     * @return boolean
     */
    public function isReturned()
    {
        return $this->getStatus() === static::RETURNED;
    }

    /**
     * @return boolean
     */
    public function isCancelled()
    {
        return $this->getStatus() === static::CANCELLED;
    }

    /**
     * @return DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return DateTime
     */
    public function getLastEventDate()
    {
        return $this->lastEventDate;
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

    /**
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @return Sender
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * @return Shipping
     */
    public function getShipping()
    {
        return $this->shipping;
    }
}
