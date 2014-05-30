<?php
namespace PHPSC\PagSeguro\Transaction;

use PHPSC\PagSeguro\BaseService;
use PHPSC\PagSeguro\Client;
use PHPSC\PagSeguro\Credentials;
use PHPSC\PagSeguro\SearchService as SearchServiceInterface;

class SearchService extends BaseService implements SearchServiceInterface
{
    /**
     * @var Decoder
     */
    private $decoder;

    /**
     * @param Credentials $credentials
     * @param Client $client
     * @param Decoder $decoder
     */
    public function __construct(
        Credentials $credentials,
        Client $client = null,
        Decoder $decoder = null
    ) {
        parent::__construct($credentials, $client);

        $this->decoder = $decoder ?: new Decoder();
    }

    /**
     * @param string $code
     *
     * @return Transaction
     */
    public function getByCode($code)
    {
        return $this->decoder->decode($this->get(static::ENDPOINT . '/' . $code));
    }
}
