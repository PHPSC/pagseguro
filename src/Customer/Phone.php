<?php
namespace PHPSC\PagSeguro\Customer;

use PHPSC\PagSeguro\Requests\SerializerTrait;
use JMS\Serializer\Annotation as JSA;

/**
 * @JSA\AccessType("public_method")
 * @JSA\ExclusionPolicy("all")
 * @JSA\ReadOnly
 * @JSA\XmlRoot("phone")
 *
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class Phone
{
    use SerializerTrait;

    /**
     * @JSA\Expose
     *
     * @var string
     */
    private $areaCode;

    /**
     * @JSA\Expose
     *
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
