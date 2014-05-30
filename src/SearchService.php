<?php
namespace PHPSC\PagSeguro;

interface SearchService
{
    /**
     * @var string
     */
    const ENDPOINT = '/v2/transactions';

    /**
     * @param string $code
     *
     * @return Charge
     */
    public function getByCode($code);
}
