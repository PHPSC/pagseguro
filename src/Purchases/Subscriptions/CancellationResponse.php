<?php
namespace PHPSC\PagSeguro\Purchases\Subscriptions;

use DateTime;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class CancellationResponse
{
    /**
     * @var string
     */
    private $status;

    /**
     * @var DateTime
     */
    private $date;

    /**
     * @param string $status
     * @param DateTime $date
     */
    public function __construct($status, DateTime $date)
    {
        $this->status = $status;
        $this->date = $date;
    }

    /**
     * @return string
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
}
