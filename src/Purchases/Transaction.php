<?php
namespace PHPSC\PagSeguro\Purchases;

use DateTime;
use PHPSC\PagSeguro\Shipping;
use PHPSC\PagSeguro\TransactionDetails;

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
     * @var TransactionDetails
     */
    private $details;

    /**
     * @var PaymentDetails
     */
    private $payment;

    /**
     * @var int
     */
    private $type;

    /**
     * @var array
     */
    private $items;

    /**
     * @var Shipping
     */
    private $shipping;

    /**
     * @param TransactionDetails $details
     * @param PaymentDetails $payment
     * @param int $type
     * @param array $items
     * @param Shipping $shipping
     */
    public function __construct(
        TransactionDetails $details,
        PaymentDetails $payment,
        $type,
        array $items,
        Shipping $shipping = null
    ) {
        $this->details = $details;
        $this->payment = $payment;
        $this->type = $type;
        $this->items = $items;
        $this->shipping = $shipping;
    }

    /**
     * @return TransactionDetails
     */
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * @return number
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return PaymentDetails
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @return Shipping
     */
    public function getShipping()
    {
        return $this->shipping;
    }

    /**
     * @return boolean
     */
    public function isWaitingPayment()
    {
        return $this->details->getStatus() === static::WAITING_PAYMENT;
    }

    /**
     * @return boolean
     */
    public function isUnderAnalysis()
    {
        return $this->details->getStatus() === static::UNDER_ANALYSIS;
    }

    /**
     * @return boolean
     */
    public function isPaid()
    {
        return $this->details->getStatus() === static::PAID;
    }

    /**
     * @return boolean
     */
    public function isAvailable()
    {
        return $this->details->getStatus() === static::AVAILABLE;
    }

    /**
     * @return boolean
     */
    public function isUnderContest()
    {
        return $this->details->getStatus() === static::UNDER_CONTEST;
    }

    /**
     * @return boolean
     */
    public function isReturned()
    {
        return $this->details->getStatus() === static::RETURNED;
    }

    /**
     * @return boolean
     */
    public function isCancelled()
    {
        return $this->details->getStatus() === static::CANCELLED;
    }
}
