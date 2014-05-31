<?php
namespace PHPSC\PagSeguro;

use DateTime;

abstract class Charge
{
    /**
     * @var string
     */
    protected $code;

    /**
     * @var string
     */
    protected $reference;

    /**
     * @var mixed
     */
    protected $status;

    /**
     * @var DateTime
     */
    protected $date;

    /**
     * @var DateTime
     */
    protected $lastEventDate;

    /**
     * @var Customer
     */
    protected $customer;

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
     * @return Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }
}
