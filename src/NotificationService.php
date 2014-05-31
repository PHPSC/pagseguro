<?php
namespace PHPSC\PagSeguro;

use PHPSC\PagSeguro\Transaction\Transaction;

interface NotificationService
{
    const TYPE_TRANSACTION = 'transaction';

    /**
     * @var string
     */
    const TRANSACTION = '/v2/transactions/notifications';

    /**
     * @param string $type
     * @param string $code
     *
     * @return Transaction
     */
    public function getByCode($type, $code);
}
