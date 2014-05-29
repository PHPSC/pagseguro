<?php
namespace PHPSC\PagSeguro;

use PHPSC\PagSeguro\Transaction\Transaction;

interface ConsultationService
{
    /**
     * @param string $code
     *
     * @return Transaction
     */
    public function getByCode($code);
}
