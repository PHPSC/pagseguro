<?php
namespace PHPSC\PagSeguro\Client;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class Environment
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
     * @return array
     */
    public static function getHosts()
    {
        return array(static::HOST, static::SANDBOX_HOST);
    }

    /**
     * @param string $host
     * @return boolean
     */
    public static function isValid($host)
    {
        return in_array($host, static::getHosts());
    }

    /**
     * @param string $resource
     * @param boolean $sandbox
     *
     * @return string
     */
    public static function createUri($resource, $sandbox = false)
    {
        if ($sandbox) {
            return 'https://' . static::SANDBOX_HOST . $resource;
        }

        return 'https://' . static::HOST . $resource;
    }
}
