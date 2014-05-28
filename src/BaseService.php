<?php
namespace PHPSC\PagSeguro;

use PHPSC\PagSeguro\ValueObject\Credentials;
use PHPSC\PagSeguro\Http\Client;

abstract class BaseService
{
    /**
     * @var string
     */
    const HOST = 'ws.pagseguro.uol.com.br';

    /**
     * @var string
     */
    const SANDBOX_HOST = 'ws.sandbox.pagseguro.uol.com.br';

    /**
     * @var Credentials
     */
    private $credentials;

    /**
     * @var Client
     */
    private $client;

    /**
     * @var boolean
     */
    private $sandbox;

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
        $this->sandbox = false;
    }

    /**
     * @param boolean $sandbox
     */
    public function setSandbox($sandbox)
    {
        $this->sandbox = (boolean) $sandbox;
    }

    /**
     * @return boolean
     */
    public function useSandbox()
    {
        return $this->sandbox;
    }

    /**
     * @param string $resource
     *
     * @return string
     */
    public function buildUri($resource)
    {
        if ($this->useSandbox()) {
            return 'https://' . static::SANDBOX_HOST . $resource;
        }

        return 'https://' . static::HOST . $resource;
    }

    /**
     * @return array
     */
    public function getCredentials()
    {
        return array(
            'email' => $this->credentials->getEmail(),
            'token' => $this->useSandbox() ? $this->credentials->getSandboxToken() : $this->credentials->getToken()
        );
    }

    /**
     * @param string $resource
     * @param array $params
     *
     * @return \SimpleXMLElement
     */
    protected function get($resource, array $params = array())
    {
        $params = array_merge($params, $this->getCredentials());

        return $this->client->get($this->buildUri($resource) . '?' . http_build_query($params));
    }

    /**
     * @param string $resource
     * @param array $params
     *
     * @return \SimpleXMLElement
     */
    protected function post($resource, array $params = array())
    {
        $params = array_merge($params, $this->getCredentials());

        return $this->client->post($this->buildUri($resource), $params);
    }
}
