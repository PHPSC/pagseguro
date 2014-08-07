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
     * @param string $resource
     *
     * @return string
     */
    public function getUrl($resource)
    {
        return $this->environment->getUrl($resource);
    }

    /**
     * @param string $resource
     * @param array $params
     *
     * @return string
     */
    public function getWsUrl($resource, array $params = [])
    {
        $params = array_merge(
            $params,
            ['email' => $this->email, 'token' => $this->token]
        );

        return sprintf(
            '%s?%s',
            $this->environment->getWsUrl($resource),
            http_build_query($params)
        );
    }
}
