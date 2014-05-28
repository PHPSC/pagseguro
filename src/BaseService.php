<?php
namespace PHPSC\PagSeguro;

use PHPSC\PagSeguro\ValueObject\Credentials;
use PHPSC\PagSeguro\Http\Client;

abstract class BaseService
{
    /**
     * @var Credentials
     */
    protected $credentials;

    /**
     * @var Client
     */
    protected $client;

    /**
     * @param Credentials $credentials
     * @param Client $client
     */
    public function __construct(
        Credentials $credentials,
        Client $client = null
    ) {
        $this->credentials = $credentials;
        $this->client = $client ?: new Client();
    }
}
