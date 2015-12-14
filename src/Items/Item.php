<?php
namespace PHPSC\PagSeguro\Items;

use PHPSC\PagSeguro\Requests\SerializerTrait;
use JMS\Serializer\Annotation as JSA;

/**
 * @JSA\AccessType("public_method")
 * @JSA\ExclusionPolicy("all")
 * @JSA\ReadOnly
 * @JSA\XmlRoot("item")
 *
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class Item
{
    use SerializerTrait;

    /**
     * @JSA\Expose
     * @JSA\XmlElement(cdata=false)
     *
     * @var string
     */
    private $id;

    /**
     * @JSA\Expose
     * @JSA\XmlElement(cdata=false)
     *
     * @var string
     */
    private $description;

    /**
     * @JSA\Expose
     * @JSA\Type("double")
     *
     * @var float
     */
    private $amount;

    /**
     * @JSA\Expose
     * @JSA\Type("integer")
     *
     * @var int
     */
    private $quantity;

    /**
     * @JSA\Expose
     * @JSA\Type("double")
     *
     * @var float
     */
    private $shippingCost;

    /**
     * @JSA\Expose
     * @JSA\Type("integer")
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
     * @return number
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return number
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @return number
     */
    public function getShippingCost()
    {
        return $this->shippingCost;
    }

    /**
     * @return number
     */
    public function getWeight()
    {
        return $this->weight;
    }
}
