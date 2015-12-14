<?php
namespace PHPSC\PagSeguro\Shipping;

use InvalidArgumentException;
use PHPSC\PagSeguro\Customer\Address;
use PHPSC\PagSeguro\SerializerTrait;
use JMS\Serializer\Annotation as Serializer;

/**
 * @Serializer\AccessType("public_method")
 * @Serializer\ReadOnly
 * @Serializer\XmlRoot("shipping")
 *
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class Shipping
{
    use SerializerTrait;

    /**
     * @Serializer\Type("integer")
     *
     * @var int
     */
    private $type;

    /**
     * @Serializer\Type("PHPSC\PagSeguro\Customer\Address")
     *
     * @var Address
     */
    private $address;

    /**
     * @Serializer\XmlElement(cdata=false)
     *
     * @var float
     */
    private $cost;

    /**
     * @param int $type
     * @param Address $address
     * @param float $cost
     */
    public function __construct($type, Address $address = null, $cost = null)
    {
        $this->setType($type);
        $this->address = $address;

        if ($cost !== null) {
            $this->cost = (float) $cost;
        }
    }

    /**
     * @return number
     */
    public function getType()
    {
        return $this->type;
    }

    protected function setType($type)
    {
        if (!Type::isValid($type)) {
            throw new InvalidArgumentException('Invalid shipping type informed');
        }

        $this->type = (int) $type;
    }

    /**
     * @return Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return string
     */
    public function getCost()
    {
        return $this->formatAmount($this->cost);
    }
}
