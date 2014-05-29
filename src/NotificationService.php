<?php
namespace PHPSC\PagSeguro;

use PHPSC\PagSeguro\Transaction\Transaction;

interface NotificationService
{
    /**
     * @param string $code
     *
     * @return Transaction
     */
    public function getByCode($code);
}
