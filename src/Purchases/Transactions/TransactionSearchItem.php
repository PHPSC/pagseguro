<?php
namespace PHPSC\PagSeguro\Purchases\Transactions;

use PHPSC\PagSeguro\Purchases\Details;
use PHPSC\PagSeguro\Purchases\Transactions\Payment;

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
     * @var Payment
     */
    protected $payment;

    /**
     * @param Details $details
     * @param int $type
     * @param string $cancellationSource
     * @param Payment $payment
     */
    public function __construct(
        Details $details,
        $type,
        $cancellationSource,
        Payment $payment
    ) {
        $this->details = $details;
        $this->type = $type;
        $this->cancellationSource = $cancellationSource;
        $this->payment = $payment;
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

    public function getPayment()
    {
        return $this->payment;
    }
}
