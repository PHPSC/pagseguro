<?php
namespace PHPSC\PagSeguro\Purchases\Subscriptions;

use PHPSC\PagSeguro\Purchases\Details;

class Subscription
{
    const INITIATED = 'INITIATED';
    const PENDING = 'PENDING';
    const ACTIVE = 'ACTIVE';
    const CANCELLED = 'CANCELLED';
    const CANCELLED_BY_RECEIVER = 'CANCELLED_BY_RECEIVER';
    const CANCELLED_BY_SENDER = 'CANCELLED_BY_SENDER';
    const EXPIRED = 'EXPIRED';

    /**
     * @var string
     */
    private $name;

    /**
     * @var Details
     */
    private $details;

    /**
     * @var string
     */
    private $tracker;

    /**
     * @param string $name
     * @param Details $details
     * @param string $tracker
     * @param boolean $automatic
     */
    public function __construct(
        $name,
        Details $details,
        $tracker,
        $automatic
    ) {
        $this->name = $name;
        $this->details = $details;
        $this->tracker = $tracker;
        $this->automatic = $automatic;
    }

    /**
     * @var boolean
     */
    private $automatic;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return TransactionDetails
     */
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * @return string
     */
    public function getTracker()
    {
        return $this->tracker;
    }

    /**
     * @return boolean
     */
    public function isAutomatic()
    {
        return $this->automatic;
    }

    /**
     * @return boolean
     */
    public function isInitiated()
    {
        return $this->getDetails()->getStatus() === static::INITIATED;
    }

    /**
     * @return boolean
     */
    public function isPending()
    {
        return $this->getDetails()->getStatus() === static::PENDING;
    }

    /**
     * @return boolean
     */
    public function isActive()
    {
        return $this->getDetails()->getStatus() === static::ACTIVE;
    }

    /**
     * @return boolean
     */
    public function isCancelledByAcquirer()
    {
        return $this->getDetails()->getStatus() === static::CANCELLED;
    }

    /**
     * @return boolean
     */
    public function isCancelledByReceiver()
    {
        return $this->getDetails()->getStatus() === static::CANCELLED_BY_RECEIVER;
    }

    /**
     * @return boolean
     */
    public function isCancelledByCustomer()
    {
        return $this->getDetails()->getStatus() === static::CANCELLED_BY_SENDER;
    }

    /**
     * @return boolean
     */
    public function isExpired()
    {
        return $this->getDetails()->getStatus() === static::EXPIRED;
    }
}
