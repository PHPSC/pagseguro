<?php
namespace PHPSC\PagSeguro\ValueObject;

class Shipping
{
    /**
     * @var int
     */
    const TYPE_PAC = 1;

    /**
     * @var int
     */
    const TYPE_SEDEX = 2;

    /**
     * @var int
     */
    const TYPE_UNKNOWN = 3;

    /**
     * @var int
     */
    private $type;

    /**
     * @var Address
     */
    private $address;

    /**
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
        $this->type = (int) $type;
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
