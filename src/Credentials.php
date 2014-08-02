<?php
namespace PHPSC\PagSeguro;

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
     * @var boolean
     */
    private $sandbox;

    /**
     * @param string $email
     * @param string $token
     * @param boolean $sandbox
     */
    public function __construct($email, $token, $sandbox = false)
    {
        $this->setEmail($email);
        $this->setToken($token);

        $this->sandbox = (boolean) $sandbox;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    protected function setEmail($email)
    {
        $this->email = substr($email, 0, 60);
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    protected function setToken($token)
    {
        $this->token = substr($token, 0, 32);
    }

    /**
     * @return boolean
     */
    public function isSandbox()
    {
        return $this->sandbox;
    }
}
