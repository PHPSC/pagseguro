<?php
namespace PHPSC\PagSeguro;

use PHPSC\PagSeguro\Environments\Production;
use PHPSC\PagSeguro\Environments\Sandbox;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
abstract class Environment
{
    /**
     * @param string $host
     *
     * @return boolean
     */
    public static function isValid($host)
    {
        return in_array($host, [Production::WS_HOST, Sandbox::WS_HOST]);
    }

    /**
     * @param string $resource
     *
     * @return string
     */
    public function getWsUrl($resource)
    {
        return 'https://' . $this->getWsHost() . $resource;
    }

    /**
     * @param string $resource
     *
     * @return string
     */
    public function getUrl($resource)
    {
        return 'https://' . $this->getHost() . $resource;
    }

    /**
     * @return string
     */
    abstract public function getWsHost();

    /**
     * @return string
     */
    abstract public function getHost();
}
