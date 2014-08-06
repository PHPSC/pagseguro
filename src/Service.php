<?php
namespace PHPSC\PagSeguro;

use PHPSC\PagSeguro\Client\Client;
use SimpleXMLElement;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
abstract class Service
{
    /**
     * @var Credentials
     */
    protected $credentials;

    /**
     * @var Client
     */
    private $client;

    /**
     * @param Credentials $credentials
     * @param Client $client
     */
    public function __construct(Credentials $credentials, Client $client = null)
    {
        $this->credentials = $credentials;
        $this->client = $client ?: new Client();
    }

    /**
     * @param string $resource
     * @param array $params
     *
     * @return SimpleXMLElement
     */
    protected function get($resource, array $params = [])
    {
        return $this->client->get($this->credentials->getWsUrl($resource, $params));
    }

    /**
     * @param string $resource
     * @param SimpleXMLElement $request
     *
     * @return SimpleXMLElement
     */
    protected function post($resource, SimpleXMLElement $request)
    {
        return $this->client->post($this->credentials->getWsUrl($resource), $request);
    }
}
