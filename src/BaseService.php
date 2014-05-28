<?php
namespace PHPSC\PagSeguro;

use PHPSC\PagSeguro\ValueObject\Credentials;
use PHPSC\PagSeguro\Http\Client;

abstract class BaseService
{
    const HOST = 'ws.pagseguro.uol.com.br';

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
    public function isSandbox()
    {
        return $this->sandbox;
    }

    protected function get($resource, array $params = array())
    {
        $params = array_merge($params, $this->getCredentials());

        return $this->client->get($this->buildUri($resource) . '?' . http_build_query($params));
    }

    protected function post($resource, array $params = array())
    {
        $params = array_merge($params, $this->getCredentials());

        return $this->client->post($this->buildUri($resource), $params);
    }

    protected function buildUri($resource)
    {
        if ($this->isSandbox()) {
            return 'https://' . static::SANDBOX_HOST . $resource;
        }

        return 'https://' . static::HOST . $resource;
    }

    protected function getCredentials()
    {
        return array(
            'email' => $this->credentials->getEmail(),
            'token' => $this->isSandbox() ? $this->credentials->getSandboxToken() : $this->credentials->getToken()
        );
    }
}
