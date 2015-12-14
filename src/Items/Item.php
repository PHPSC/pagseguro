<?php
namespace PHPSC\PagSeguro\Items;

use JMS\Serializer\Annotation as Serializer;
use PHPSC\PagSeguro\SerializerTrait;

/**
 * @Serializer\AccessType("public_method")
 * @Serializer\ReadOnly
 * @Serializer\XmlRoot("item")
 *
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class Item
{
    use SerializerTrait;

    /**
     * @Serializer\XmlElement(cdata=false)
     *
     * @var string
     */
    private $id;

    /**
     * @Serializer\XmlElement(cdata=false)
     *
     * @var string
     */
    private $description;

    /**
     * @Serializer\XmlElement(cdata=false)
     *
     * @var float
     */
    private $amount;

    /**
     * @Serializer\Type("integer")
     *
     * @var int
     */
    private $quantity;

    /**
     * @Serializer\XmlElement(cdata=false)
     *
     * @var float
     */
    private $shippingCost;

    /**
     * @Serializer\Type("integer")
     *
     * @var int
     */
    private $weight;

    /**
     * @param string $id
     * @param string $description
     * @param float $amount
     * @param int $quantity
     * @param float $shippingCost
     * @param int $weight
     */
    public function __construct(
        $id,
        $description,
        $amount,
        $quantity = 1,
        $shippingCost = null,
        $weight = null
    ) {
        $this->id = $id;
        $this->description = $description;
        $this->amount = $amount;
        $this->quantity = $quantity;
        $this->shippingCost = $shippingCost;
        $this->weight = $weight;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getAmount()
    {
        return $this->formatAmount($this->amount);
    }

    /**
     * @return number
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @return string
     */
    public function getShippingCost()
    {
        return $this->formatAmount($this->shippingCost);
    }

    /**
     * @return number
     */
    public function getWeight()
    {
        return $this->weight;
    }
}
