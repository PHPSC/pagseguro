<?php
namespace PHPSC\PagSeguro;

use PHPSC\PagSeguro\ValueObject\Credentials;
use PHPSC\PagSeguro\Http\Client;

abstract class BaseService
{
    /**
     * @var Credentials
     */
    private $credentials;

    /**
     * @var Client
     */
    private $client;

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

    protected function get($url, array $params = array())
    {
        $params = array_merge($params, $this->getCredentials());
        $url = $url . '?' . http_build_query($params);

        return $this->client->get($url);
    }

    protected function post($url, array $params = array())
    {
        $params = array_merge($params, $this->getCredentials());

        return $this->client->post($url, $params);
    }

    protected function getCredentials()
    {
        return array(
        	'email' => $this->credentials->getEmail(),
        	'token' => $this->credentials->getToken()
        );
    }
}
