<?php
namespace PHPSC\PagSeguro\Purchases\Subscriptions;

use DateTime;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class ChargeResponse
{
    /**
     * @var string
     */
    private $transactionCode;

    /**
     * @var DateTime
     */
    private $date;

    /**
     * @param string $transactionCode
     * @param DateTime $date
     */
    public function __construct($transactionCode, DateTime $date)
    {
        $this->transactionCode = $transactionCode;
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getTransactionCode()
    {
        return $this->transactionCode;
    }

    /**
     * @return DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
}
