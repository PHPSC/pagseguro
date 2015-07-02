<?php
namespace PHPSC\PagSeguro\Purchases\Transactions;

use PHPSC\PagSeguro\Purchases\Details;
use PHPSC\PagSeguro\Purchases\Transactions\PaymentMethod;

class TransactionSearchItem
{

    const TYPE_PAGAMENTO = 1;
    const TYPE_ASSINATURA = 11;

    /**
     * @var Details
     */
    protected $details;
    /**
     * @var int
     */
    protected $type;

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
     * @param Details $details
     * @param int $type
     * @param string $cancellationSource
     * @param PaymentMethod $paymentMethod
     * @param float $grossAmount
     * @param float $discountAmount
     * @param float $feeAmount
     * @param float $netAmount
     * @param float $extraAmount
     */
    public function __construct(
        Details $details,
        $type,
        $cancellationSource,
        PaymentMethod $paymentMethod,
        $grossAmount,
        $discountAmount = 0,
        $feeAmount = 0,
        $netAmount = 0,
        $extraAmount = 0
    ) {
        $this->details = $details;
        $this->type = $type;
        $this->cancellationSource = $cancellationSource;
        $this->paymentMethod = $paymentMethod;
        $this->grossAmount = $grossAmount;
        $this->discountAmount = $discountAmount;
        $this->feeAmount = $feeAmount;
        $this->netAmount = $netAmount;
        $this->extraAmount = $extraAmount;
    }
    
    public function getDetails()
    {
        return $this->details;
    }

    public function getCancellationSource()
    {
        return $this->cancellationSource;
    }

    public function getType()
    {
        return $this->type;
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
}
