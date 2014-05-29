<?php
namespace PHPSC\PagSeguro\ValueObject;

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
     * @var string
     */
    private $sandboxToken;

    /**
     * @param string $email
     * @param string $token
     * @param string $sandboxToken
     */
    public function __construct($email, $token, $sandboxToken = null)
    {
        $this->setEmail($email);
        $this->setToken($token);

        if (!empty($sandboxToken)) {
            $this->setSandboxToken($sandboxToken);
        }
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
     * @return string
     */
    public function getSandboxToken()
    {
        return $this->sandboxToken;
    }

    /**
     * @param string $sandboxToken
     */
    protected function setSandboxToken($sandboxToken)
    {
        $this->sandboxToken = substr($sandboxToken, 0, 32);
    }
}
