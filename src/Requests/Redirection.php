<?php
namespace PHPSC\PagSeguro\Requests;

use DateTime;

class Redirection
{
    /**
     * @var string
     */
    private $code;

    /**
     * @var DateTime
     */
    private $date;

    /**
     * @var string
     */
    private $uri;

    /**
     * @param string $code
     * @param DateTime $date
     * @param string $uri
     */
    public function __construct($code, DateTime $date, $uri)
    {
        $this->code = $code;
        $this->date = $date;
        $this->uri = $uri;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getRedirectionUrl()
    {
        return $this->uri . '?code=' . $this->getCode();
    }
}
