<?php
namespace PHPSC\PagSeguro\Customer;

class Phone
{
    /**
     * @var string
     */
    private $areaCode;

    /**
     * @var string
     */
    private $number;

    /**
     * @param string $areaCode
     * @param string $number
     */
    public function __construct($areaCode, $number)
    {
        $this->areaCode = $areaCode;
        $this->number = $number;
    }

    /**
     * @return string
     */
    public function getAreaCode()
    {
        return $this->areaCode;
    }

    /**
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }
}
