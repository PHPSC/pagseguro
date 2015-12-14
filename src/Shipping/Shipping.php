<?php
namespace PHPSC\PagSeguro\Shipping;

use InvalidArgumentException;
use PHPSC\PagSeguro\Customer\Address;
use PHPSC\PagSeguro\Requests\SerializerTrait;
use JMS\Serializer\Annotation as JSA;

/**
 * @JSA\AccessType("public_method")
 * @JSA\ExclusionPolicy("all")
 * @JSA\ReadOnly
 * @JSA\XmlRoot("shipping")
 *
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class Shipping
{
    use SerializerTrait;
    
    /**
     * @JSA\Expose
     * @JSA\Type("integer")
     *
     * @var int
     */
    private $type;

    /**
     * @JSA\Expose
     * @JSA\Type("PHPSC\PagSeguro\Customer\Address")
     *
     * @var Address
     */
    private $address;

    /**
     * @JSA\Expose
     * @JSA\Type("double")
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
     * @return number
     */
    public function getCost()
    {
        return $this->cost;
    }
}
