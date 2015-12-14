<?php
namespace PHPSC\PagSeguro\Requests\PreApprovals;

use DateTime;
use InvalidArgumentException;
use JMS\Serializer\Annotation as JSA;
use PHPSC\PagSeguro\Requests\SerializerTrait;

/**
 * @JSA\AccessType("public_method")
 * @JSA\ExclusionPolicy("all")
 * @JSA\ReadOnly
 * @JSA\XmlRoot("preApproval")
 *
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class PreApproval
{
    use SerializerTrait;
    
    /**
     * @JSA\Expose
     * @JSA\XmlElement(cdata=false)
     *
     * @var string
     */
    private $name;

    /**
     * @JSA\Expose
     * @JSA\SerializedName("charge")
     * @JSA\XmlElement(cdata=false)
     *
     * @var string
     */
    private $chargeType;

    /**
     * @JSA\Expose
     * @JSA\XmlElement(cdata=false)
     *
     * @var string
     */
    private $details;

    /**
     * @JSA\Expose
     * @JSA\XmlElement(cdata=false)
     *
     * @var string
     */
    private $period;

    /**
     * @JSA\Expose
     * @JSA\Type("DateTime<'Y-m-d\TH:i:sP'>")
     * @JSA\XmlElement(cdata=false)
     *
     * @var DateTime
     */
    private $finalDate;

    /**
     * @JSA\Expose
     * @JSA\Type("double")
     *
     * @var float
     */
    private $maxTotalAmount;

    /**
     * @JSA\Expose
     * @JSA\Type("double")
     *
     * @var float
     */
    private $amountPerPayment;

    /**
     * @JSA\Expose
     * @JSA\Type("double")
     *
     * @var float
     */
    private $maxAmountPerPayment;

    /**
     * @JSA\Expose
     * @JSA\Type("integer")
     *
     * @var int
     */
    private $maxPaymentsPerPeriod;

    /**
     * @JSA\Expose
     * @JSA\Type("double")
     *
     * @var float
     */
    private $maxAmountPerPeriod;

    /**
     * @JSA\Expose
     * @JSA\Type("DateTime<'Y-m-d\TH:i:sP','00:00'>")
     * @JSA\XmlElement(cdata=false)
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
        return number_format($this->maxTotalAmount, 2, '.', '');
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
        return number_format($this->amountPerPayment, 2, '.', '');
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
        return number_format($this->maxAmountPerPayment, 2, '.', '');
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
        return number_format($this->maxAmountPerPeriod, 2, '.', '');
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
