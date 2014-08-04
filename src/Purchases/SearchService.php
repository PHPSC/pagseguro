<?php
namespace PHPSC\PagSeguro\Purchases;

use PHPSC\PagSeguro\Purchases\Transaction;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
interface SearchService
{
    /**
     * @param string $code
     *
     * @return Transaction
     */
    public function getByCode($code);
}
