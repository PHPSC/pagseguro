<?php
namespace PHPSC\PagSeguro\Purchases\Transactions;

use DateTime;
use PHPSC\PagSeguro\Items\ItemCollection;
use PHPSC\PagSeguro\Purchases\Details;
use PHPSC\PagSeguro\Shipping\Shipping;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class Transaction
{
    /**
     * @var int
     */
    const WAITING_PAYMENT = '1';

    /**
     * @var int
     */
    const UNDER_ANALYSIS = '2';

    /**
     * @var int
     */
    const PAID = '3';

    /**
     * @var int
     */
    const AVAILABLE = '4';

    /**
     * @var int
     */
    const UNDER_CONTEST = '5';

    /**
     * @var int
     */
    const RETURNED = '6';

    /**
     * @var int
     */
    const CANCELLED = '7';

    /**
     * @var Details
     */
    private $details;

    /**
     * @var Payment
     */
    private $payment;

    /**
     * @var int
     */
    private $type;

    /**
     * @var ItemCollection
     */
    private $items;

    /**
     * @var Shipping
     */
    private $shipping;

    /**
     * @param Details $details
     * @param Payment $payment
     * @param int $type
     * @param ItemCollection $items
     * @param Shipping $shipping
     */
    public function __construct(
        Details $details,
        Payment $payment,
        $type,
        ItemCollection $items,
        Shipping $shipping = null
    ) {
        $this->details = $details;
        $this->payment = $payment;
        $this->type = $type;
        $this->items = $items;
        $this->shipping = $shipping;
    }

    /**
     * @return Details
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
     * @return Payment
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * @return ItemCollection
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
