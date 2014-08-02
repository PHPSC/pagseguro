<?php
namespace PHPSC\PagSeguro;

use PHPSC\PagSeguro\Environment;
use PHPSC\PagSeguro\Environments\Production;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class Credentials
{
    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $token;

    /**
     * @var Environment
     */
    private $environment;

    /**
     * @param string $email
     * @param string $token
     * @param Environment $environment
     */
    public function __construct($email, $token, Environment $environment = null)
    {
        $this->email = substr($email, 0, 60);
        $this->token = substr($token, 0, 32);
        $this->environment = $environment ?: new Production();
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @return Environment
     */
    public function getEnvironment()
    {
        return $this->environment;
    }

    /**
     * @param string $resource
     * @param array $params
     *
     * @return string
     */
    public function getWsUrl($resource, array $params = array())
    {
        $params = array_merge(
            $params,
            array('email' => $this->email, 'token' => $this->token)
        );

        return sprintf(
            '%s?%s',
            $this->environment->getWsUrl($resource),
            http_build_query($params)
        );
    }

    /**
     * @param string $resource
     *
     * @return string
     */
    public function getUrl($resource)
    {
        return $this->environment->getUrl($resource);
    }
}
