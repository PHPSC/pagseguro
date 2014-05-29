<?php
namespace PHPSC\PagSeguro;

use PHPSC\PagSeguro\Transaction\Transaction;

interface TransactionLocatingService
{
    /**
     * @param string $code
     *
     * @return Transaction
     */
    public function getByCode($code);

    /**
     * @param string $code
     *
     * @return Transaction
     */
    public function getByNotification($code);
}
