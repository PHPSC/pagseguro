<?php
namespace PHPSC\PagSeguro\Items;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class Item
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $description;

    /**
     * @var float
     */
    private $amount;

    /**
     * @var int
     */
    private $quantity;

    /**
     * @var float
     */
    private $shippingCost;

    /**
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
