<?php
namespace PHPSC\PagSeguro\Requests\Checkout;

use PHPSC\PagSeguro\Items\ItemCollection;
use PHPSC\PagSeguro\Shipping\Shipping;
use PHPSC\PagSeguro\XmlSerializable;
use SimpleXMLElement;
use PHPSC\PagSeguro\Items\Items;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class Order implements XmlSerializable
{
    /**
     * @var string
     */
    private $currency;

    /**
     * @var ItemCollection
     */
    private $items;

    /**
     * @var string
     */
    private $reference;

    /**
     * @var Shipping
     */
    private $shipping;

    /**
     * @var float
     */
    private $extraAmount;

    /**
     * @param ItemCollection $items
     */
    public function __construct(ItemCollection $items = null)
    {
        $this->items = $items ?: new Items();
        $this->currency = 'BRL';
    }

    /**
     * @return ItemCollection
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param string $reference
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
    }

    /**
     * @param Shipping $shipping
     */
    public function setShipping(Shipping $shipping)
    {
        $this->shipping = $shipping;
    }

    /**
     * @param float $extraAmount
     */
    public function setExtraAmount($extraAmount)
    {
        $this->extraAmount = $extraAmount;
    }

    /**
     * {@inheritdoc}
     */
    public function xmlSerialize(SimpleXMLElement $parent)
    {
        $parent->addChild('currency', $this->currency);

        $items = $parent->addChild('items');

        foreach ($this->items as $item) {
            $item->xmlSerialize($items);
        }

        if ($this->reference !== null) {
            $parent->addChild('reference', $this->reference);
        }

        if ($this->extraAmount !== null) {
            $parent->addChild('extraAmount', $this->extraAmount);
        }

        if ($this->shipping !== null) {
            $this->shipping->xmlSerialize($parent);
        }

        return $parent;
    }
}
