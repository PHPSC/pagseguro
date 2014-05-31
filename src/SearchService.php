<?php
namespace PHPSC\PagSeguro;

use PHPSC\PagSeguro\Purchases\Transaction;

interface SearchService
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
