<?php

namespace PHPSC\PagSeguro\Purchases\Transactions;

use DateTime;

class TransactionSearchItem
{

    const TYPE_PAGAMENTO = 1;
    const TYPE_ASSINATURA = 11;

    /**
     * @var DateTime
     */
    protected $date;

    /**
     * @var DateTime
     */
    protected $lastEventDate;

    /**
     * @var string
     */
    protected $code;

    /**
     * @var string
     */
    protected $reference;

    /**
     * @var int
     */
    protected $type;

    /**
     * @var mixed
     */
    protected $status;
    
    /**
     * @var string
     */
    protected $cancellationSource;

    /**
     * @var PaymentMethod
     */
    protected $paymentMethod;

    /**
     * @var float
     */
    protected $grossAmount;

    /**
     * @var float
     */
    protected $discountAmount;

    /**
     * @var float
     */
    protected $feeAmount;

    /**
     * @var float
     */
    protected $netAmount;

    /**
     * @var float
     */
    protected $extraAmount;

    /**
     * 
     * @param DateTime $date
     * @param DateTime $lastEventDate
     * @param string $code
     * @param string $reference
     * @param int $type
     * @param mixed $status
     * @param \PHPSC\PagSeguro\Purchases\Transactions\PaymentMethod $paymentMethod
     * @param float $grossAmount
     * @param float $discountAmount
     * @param float $feeAmount
     * @param float $netAmount
     * @param float $extraAmount
     */
    public function __construct(DateTime $date, DateTime $lastEventDate, $code, 
            $reference, $type, $status, $cancellationSource, 
            PaymentMethod $paymentMethod, $grossAmount, $discountAmount = 0, 
            $feeAmount = 0, $netAmount = 0, $extraAmount = 0)
    {
        $this->date = $date;
        $this->lastEventDate = $lastEventDate;
        $this->code = $code;
        $this->reference = $reference;
        $this->type = $type;
        $this->status = $status;
        $this->cancellationSource = $cancellationSource;
        $this->paymentMethod = $paymentMethod;
        $this->grossAmount = $grossAmount;
        $this->discountAmount = $discountAmount;
        $this->feeAmount = $feeAmount;
        $this->netAmount = $netAmount;
        $this->extraAmount = $extraAmount;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getLastEventDate()
    {
        return $this->lastEventDate;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function getReference()
    {
        return $this->reference;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }

    public function getGrossAmount()
    {
        return $this->grossAmount;
    }

    public function getDiscountAmount()
    {
        return $this->discountAmount;
    }

    public function getFeeAmount()
    {
        return $this->feeAmount;
    }

    public function getNetAmount()
    {
        return $this->netAmount;
    }

    public function getExtraAmount()
    {
        return $this->extraAmount;
    }

    public function setDate(DateTime $date)
    {
        $this->date = $date;
        return $this;
    }

    public function setLastEventDate(DateTime $lastEventDate)
    {
        $this->lastEventDate = $lastEventDate;
        return $this;
    }

    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    public function setReference($reference)
    {
        $this->reference = $reference;
        return $this;
    }

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function setPaymentMethod(PaymentMethod $paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;
        return $this;
    }

    public function setGrossAmount($grossAmount)
    {
        $this->grossAmount = $grossAmount;
        return $this;
    }

    public function setDiscountAmount($discountAmount)
    {
        $this->discountAmount = $discountAmount;
        return $this;
    }

    public function setFeeAmount($feeAmount)
    {
        $this->feeAmount = $feeAmount;
        return $this;
    }

    public function setNetAmount($netAmount)
    {
        $this->netAmount = $netAmount;
        return $this;
    }

    public function setExtraAmount($extraAmount)
    {
        $this->extraAmount = $extraAmount;
        return $this;
    }
    
    public function getCancellationSource()
    {
        return $this->cancellationSource;
    }

    public function setCancellationSource($cancellationSource)
    {
        $this->cancellationSource = $cancellationSource;
        return $this;
    }

}
