<?php
namespace PHPSC\PagSeguro\Purchases\Subscriptions;

use PHPSC\PagSeguro\Purchases\Details;
use PHPSC\PagSeguro\Requests\PreApprovals\ChargeType;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
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
     * @var string
     */
    private $chargeType;

    /**
     * @param string $name
     * @param Details $details
     * @param string $tracker
     * @param string $chargeType
     */
    public function __construct(
        $name,
        Details $details,
        $tracker,
        $chargeType
    ) {
        $this->name = $name;
        $this->details = $details;
        $this->tracker = $tracker;
        $this->chargeType = $chargeType;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return Details
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
        return $this->chargeType == ChargeType::AUTOMATIC;
    }

    /**
     * @return boolean
     */
    public function isManual()
    {
        return $this->chargeType == ChargeType::MANUAL;
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
