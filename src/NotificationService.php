<?php
namespace PHPSC\PagSeguro;

use PHPSC\PagSeguro\Purchases\Transaction;

interface NotificationService
{
    /**
     * @param string $code
     *
     * @return Transaction
     */
    public function getByNotification($code);
}
