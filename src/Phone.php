<?php
namespace PHPSC\PagSeguro;

use SimpleXMLElement;

class Phone implements XmlSerializable
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
        $this->setAreaCode($areaCode);
        $this->setNumber($number);
    }

    /**
     * @return string
     */
    public function getAreaCode()
    {
        return $this->areaCode;
    }

    /**
     * @param string $areaCode
     */
    protected function setAreaCode($areaCode)
    {
        $this->areaCode = substr($areaCode, 0, 2);
    }

    /**
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param string $number
     */
    protected function setNumber($number)
    {
        $this->number = substr($number, 0, 9);
    }

    /**
     * {@inheritdoc}
     */
    public function xmlSerialize(SimpleXMLElement $parent)
    {
        $phone = $parent->addChild('phone');
        $phone->addChild('areaCode', $this->areaCode);
        $phone->addChild('number', $this->number);

        return $phone;
    }
}
