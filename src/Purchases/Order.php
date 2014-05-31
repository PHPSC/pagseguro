<?php
namespace PHPSC\PagSeguro\Purchases;

use PHPSC\PagSeguro\Shipping;
use PHPSC\PagSeguro\Item;
use PHPSC\PagSeguro\XmlSerializable;
use SimpleXMLElement;

class Order implements XmlSerializable
{
    /**
     * @var string
     */
    private $currency;

    /**
     * @var Item[]
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
     * @var int
     */
    private $maxUses;

    /**
     * @var int
     */
    private $maxAge;

    /**
     * @param array $items
     * @param string $reference
     * @param Shipping $shipping
     * @param float $extraAmount
     */
    public function __construct(
        array $items,
        $reference = null,
        Shipping $shipping = null,
        $extraAmount = null
    ) {
        $this->items = $items;
        $this->reference = $reference;
        $this->shipping = $shipping;
        $this->extraAmount = $extraAmount;
        $this->currency = 'BRL';
    }

    /**
     * {@inheritdoc}
     */
    public function xmlSerialize(SimpleXMLElement $parent)
    {
        $parent->addChild('currency', $this->currency);

        $items = $parent->addChild('items');

        /* @var $item Item */
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
