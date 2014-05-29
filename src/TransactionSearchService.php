<?php
namespace PHPSC\PagSeguro;

use PHPSC\PagSeguro\Transaction\Transaction;

interface TransactionSearchService
{
    /**
     * @var string
     */
    const ENDPOINT = '/v2/transactions';

    /**
     * @param string $code
     *
     * @return Transaction
     */
    public function getByCode($code);
}
