<?php
namespace PHPSC\PagSeguro\Items;

use SimpleXMLElement;
use PHPSC\PagSeguro\XmlSerializable;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class Item implements XmlSerializable
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

    /**
     * {@inheritdoc}
     */
    public function xmlSerialize(SimpleXMLElement $parent)
    {
        $item = $parent->addChild('item');
        $item->addChild('id', substr($this->id, 0, 100));
        $item->addChild('description', substr($this->description, 0, 100));
        $item->addChild('amount', number_format($this->amount, 2, '.', ''));
        $item->addChild('quantity', (int) $this->quantity);
        $item->addChild('shippingCost', number_format($this->shippingCost, 2, '.', ''));
        $item->addChild('weight', (int) $this->weight);

        return $item;
    }
}
