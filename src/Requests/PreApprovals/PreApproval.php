<?php
namespace PHPSC\PagSeguro\Requests\PreApprovals;

use DateTime;
use InvalidArgumentException;
use JMS\Serializer\Annotation as Serializer;
use PHPSC\PagSeguro\SerializerTrait;

/**
 * @Serializer\AccessType("public_method")
 * @Serializer\ReadOnly
 * @Serializer\XmlRoot("preApproval")
 *
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class PreApproval
{
    use SerializerTrait;

    /**
     * @Serializer\XmlElement(cdata=false)
     *
     * @var string
     */
    private $name;

    /**
     * @Serializer\SerializedName("charge")
     * @Serializer\XmlElement(cdata=false)
     *
     * @var string
     */
    private $chargeType;

    /**
     * @Serializer\XmlElement(cdata=false)
     *
     * @var string
     */
    private $details;

    /**
     * @Serializer\XmlElement(cdata=false)
     *
     * @var string
     */
    private $period;

    /**
     * @Serializer\Type("DateTime<'Y-m-d\TH:i:sP'>")
     * @Serializer\XmlElement(cdata=false)
     *
     * @var DateTime
     */
    private $finalDate;

    /**
     * @Serializer\XmlElement(cdata=false)
     *
     * @var float
     */
    private $maxTotalAmount;

    /**
     * @Serializer\XmlElement(cdata=false)
     *
     * @var float
     */
    private $amountPerPayment;

    /**
     * @Serializer\XmlElement(cdata=false)
     *
     * @var float
     */
    private $maxAmountPerPayment;

    /**
     * @Serializer\Type("integer")
     *
     * @var int
     */
    private $maxPaymentsPerPeriod;

    /**
     * @Serializer\XmlElement(cdata=false)
     *
     * @var float
     */
    private $maxAmountPerPeriod;

    /**
     * @Serializer\Type("DateTime<'Y-m-d\TH:i:sP','00:00'>")
     * @Serializer\XmlElement(cdata=false)
     *
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
     * @return string
     */
    public function getMaxTotalAmount()
    {
        return $this->formatAmount($this->maxTotalAmount);
    }

    /**
     * @param float $maxTotalAmount
     */
    public function setMaxTotalAmount($maxTotalAmount)
    {
        $this->maxTotalAmount = $maxTotalAmount;
    }

    /**
     * @return string
     */
    public function getAmountPerPayment()
    {
        return $this->formatAmount($this->amountPerPayment);
    }

    /**
     * @param float $amountPerPayment
     */
    public function setAmountPerPayment($amountPerPayment)
    {
        $this->amountPerPayment = $amountPerPayment;
    }
    /**
     * @return string
     */
    public function getMaxAmountPerPayment()
    {
        return $this->formatAmount($this->maxAmountPerPayment);
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
     * @return string
     */
    public function getMaxAmountPerPeriod()
    {
        return $this->formatAmount($this->maxAmountPerPeriod);
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
