<?php
namespace PHPSC\PagSeguro\Purchases;

use DateTime;
use PHPSC\PagSeguro\Customer\Customer;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class Details
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
     * @param string $code
     * @param string $reference
     * @param int $status
     * @param DateTime $date
     * @param DateTime $lastEventDate
     * @param Customer $customer
     */
    public function __construct(
        $code,
        $reference,
        $status,
        DateTime $date,
        DateTime $lastEventDate,
        Customer $customer
    ) {
        $this->code = $code;
        $this->reference = $reference;
        $this->status = $status;
        $this->date = $date;
        $this->lastEventDate = $lastEventDate;
        $this->customer = $customer;
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
     * @return mixed
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
