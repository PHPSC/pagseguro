<?php
namespace PHPSC\PagSeguro\Checkout;

use DateTime;

class Response
{
    /**
     * @var string
     */
    const HOST = 'pagseguro.uol.com.br';

    /**
     * @var string
     */
    const SANDBOX_HOST = 'sandbox.pagseguro.uol.com.br';

    /**
     * @var string
     */
    const RESOURCE = '/v2/checkout/payment.html';

    /**
     * @var string
     */
    private $code;

    /**
     * @var DateTime
     */
    private $date;

    /**
     * @var boolean
     */
    private $sandbox;

    /**
     * @param string $code
     * @param DateTime $date
     * @param boolean $sandbox
     */
    public function __construct($code, DateTime $date, $sandbox = false)
    {
        $this->setCode($code);
        $this->setDate($date);
        $this->sandbox = $sandbox;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    protected function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param DateTime $date
     */
    protected function setDate(DateTime $date)
    {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getRedirectionUrl()
    {
        if ($this->sandbox) {
            return 'https://' . static::SANDBOX_HOST . static::RESOURCE . '?code=' . $this->getCode();
        }

        return 'https://' . static::HOST . static::RESOURCE . '?code=' . $this->getCode();
    }
}
