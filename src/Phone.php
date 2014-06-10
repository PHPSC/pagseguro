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

    /**
     * {@inheritdoc}
     */
    public function xmlSerialize(SimpleXMLElement $parent)
    {
        $phone = $parent->addChild('phone');
        $phone->addChild('areaCode', substr($this->areaCode, 0, 2));
        $phone->addChild('number', substr($this->number, 0, 9));

        return $phone;
    }
}
