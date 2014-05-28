<?php
namespace PHPSC\PagSeguro\ValueObject;

use DateTime;

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
        $this->setCode($code);
        $this->setReference($reference);
        $this->setType($type);
        $this->setStatus($status);
        $this->setDate($date);
        $this->setLastEventDate($lastEventDate);
        $this->setEscrowEndDate($escrowEndDate);
        $this->setPaymentMethod($paymentMethod);
        $this->setGrossAmount($grossAmount);
        $this->setDiscountAmount($discountAmount);
        $this->setFeeAmount($feeAmount);
        $this->setNetAmount($netAmount);
        $this->setExtraAmount($extraAmount);
        $this->setInstallmentCount($installmentCount);
        $this->setItems($items);
        $this->setSender($sender);
        $this->setShipping($shipping);
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    protected function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     */
    protected function setReference($reference)
    {
        $this->reference = $reference;
    }

    /**
     * @return number
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param number $type
     */
    protected function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return number
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param number $status
     */
    protected function setStatus($status)
    {
        $this->status = $status;
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
     * @param DateTime $date
     */
    protected function setDate(DateTime $date)
    {
        $this->date = $date;
    }

    /**
     * @return DateTime
     */
    public function getLastEventDate()
    {
        return $this->lastEventDate;
    }

    /**
     * @param DateTime $lastEventDate
     */
    protected function setLastEventDate(DateTime $lastEventDate)
    {
        $this->lastEventDate = $lastEventDate;
    }

    /**
     * @return DateTime
     */
    public function getEscrowEndDate()
    {
        return $this->escrowEndDate;
    }

    /**
     * @param DateTime $escrowEndDate
     */
    protected function setEscrowEndDate(DateTime $escrowEndDate = null)
    {
        $this->escrowEndDate = $escrowEndDate;
    }

    /**
     * @return PaymentMethod
     */
    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }

    /**
     * @param PaymentMethod $paymentMethod
     */
    protected function setPaymentMethod(PaymentMethod $paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;
    }

    /**
     * @return number
     */
    public function getGrossAmount()
    {
        return $this->grossAmount;
    }

    /**
     * @param number $grossAmount
     */
    protected function setGrossAmount($grossAmount)
    {
        $this->grossAmount = $grossAmount;
    }

    /**
     * @return number
     */
    public function getDiscountAmount()
    {
        return $this->discountAmount;
    }

    /**
     * @param number $discountAmount
     */
    protected function setDiscountAmount($discountAmount)
    {
        $this->discountAmount = $discountAmount;
    }

    /**
     * @return number
     */
    public function getFeeAmount()
    {
        return $this->feeAmount;
    }

    /**
     * @param number $feeAmount
     */
    protected function setFeeAmount($feeAmount)
    {
        $this->feeAmount = $feeAmount;
    }

    /**
     * @return number
     */
    public function getNetAmount()
    {
        return $this->netAmount;
    }

    /**
     * @param number $netAmount
     */
    protected function setNetAmount($netAmount)
    {
        $this->netAmount = $netAmount;
    }

    /**
     * @return number
     */
    public function getExtraAmount()
    {
        return $this->extraAmount;
    }

    /**
     * @param number $extraAmount
     */
    protected function setExtraAmount($extraAmount)
    {
        $this->extraAmount = $extraAmount;
    }

    /**
     * @return number
     */
    public function getInstallmentCount()
    {
        return $this->installmentCount;
    }

    /**
     * @param number $installmentCount
     */
    protected function setInstallmentCount($installmentCount)
    {
        $this->installmentCount = $installmentCount;
    }

    /**
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param array $items
     */
    protected function setItems(array $items)
    {
        $this->items = $items;
    }

    /**
     * @return Sender
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * @param Sender $sender
     */
    protected function setSender(Sender $sender)
    {
        $this->sender = $sender;
    }

    /**
     * @return Shipping
     */
    public function getShipping()
    {
        return $this->shipping;
    }

    /**
     * @param Shipping $shipping
     */
    protected function setShipping(Shipping $shipping)
    {
        $this->shipping = $shipping;
    }
}
