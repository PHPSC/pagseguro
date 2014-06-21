<?php
namespace PHPSC\PagSeguro\Subscriptions;

use PHPSC\PagSeguro\TransactionDetails;

class Subscription
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var TransactionDetails
     */
    private $details;

    /**
     * @var string
     */
    private $tracker;

    /**
     * @param string $name
     * @param TransactionDetails $details
     * @param string $tracker
     * @param boolean $automatic
     */
    public function __construct(
        $name,
        TransactionDetails $details,
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
}
