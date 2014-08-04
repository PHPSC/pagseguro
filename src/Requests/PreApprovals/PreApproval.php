<?php
namespace PHPSC\PagSeguro\Requests\PreApprovals;

use DateTime;
use InvalidArgumentException;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class PreApproval
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $chargeType;

    /**
     * @var string
     */
    private $details;

    /**
     * @var string
     */
    private $period;

    /**
     * @var DateTime
     */
    private $finalDate;

    /**
     * @var float
     */
    private $maxTotalAmount;

    /**
     * @var float
     */
    private $amountPerPayment;

    /**
     * @var float
     */
    private $maxAmountPerPayment;

    /**
     * @var int
     */
    private $maxPaymentsPerPeriod;

    /**
     * @var float
     */
    private $maxAmountPerPeriod;

    /**
     * @var DateTime
     */
    private $initialDate;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getChargeType()
    {
        return $this->chargeType;
    }

    /**
     * @param string $chargeType
     *
     * @throws InvalidArgumentException
     */
    public function setChargeType($chargeType)
    {
        if (!ChargeType::isValid($chargeType)) {
            throw new InvalidArgumentException('You should inform a valid charge type');
        }

        $this->chargeType = $chargeType;
    }

    /**
     * @return string
     */
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * @param string $details
     */
    public function setDetails($details)
    {
        $this->details = $details;
    }

    /**
     * @return string
     */
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * @param string $period
     *
     * @throws InvalidArgumentException
     */
    public function setPeriod($period)
    {
        if (!Period::isValid($period)) {
            throw new InvalidArgumentException('You should inform a valid period');
        }

        $this->period = $period;
    }

    /**
     * @return DateTime
     */
    public function getFinalDate()
    {
        return $this->finalDate;
    }

    /**
     * @param DateTime $finalDate
     */
    public function setFinalDate(DateTime $finalDate)
    {
        $this->finalDate = $finalDate;
    }

    /**
     * @return float
     */
    public function getMaxTotalAmount()
    {
        return $this->maxTotalAmount;
    }

    /**
     * @param float $amountPerPayment
     */
    public function setMaxTotalAmount($maxTotalAmount)
    {
        $this->maxTotalAmount = $maxTotalAmount;
    }

    /**
     * @return float
     */
    public function getAmountPerPayment()
    {
        return $this->amountPerPayment;
    }

    /**
     * @param float $maxTotalAmount
     */
    public function setAmountPerPayment($amountPerPayment)
    {
        $this->amountPerPayment = $amountPerPayment;
    }
    /**
     * @return float
     */
    public function getMaxAmountPerPayment()
    {
        return $this->maxAmountPerPayment;
    }

    /**
     * @param float $maxAmountPerPayment
     */
    public function setMaxAmountPerPayment($maxAmountPerPayment)
    {
        $this->maxAmountPerPayment = $maxAmountPerPayment;
    }

    /**
     * @return int
     */
    public function getMaxPaymentsPerPeriod()
    {
        return $this->maxPaymentsPerPeriod;
    }

    /**
     * @param int $maxPaymentsPerPeriod
     */
    public function setMaxPaymentsPerPeriod($maxPaymentsPerPeriod)
    {
        $this->maxPaymentsPerPeriod = $maxPaymentsPerPeriod;
    }

    /**
     * @return float
     */
    public function getMaxAmountPerPeriod()
    {
        return $this->maxAmountPerPeriod;
    }

    /**
     * @param float $maxAmountPerPeriod
     */
    public function setMaxAmountPerPeriod($maxAmountPerPeriod)
    {
        $this->maxAmountPerPeriod = $maxAmountPerPeriod;
    }

    /**
     * @return DateTime
     */
    public function getInitialDate()
    {
        return $this->initialDate;
    }

    /**
     * @param DateTime $initialDate
     */
    public function setInitialDate(DateTime $initialDate)
    {
        $this->initialDate = $initialDate;
    }
}
