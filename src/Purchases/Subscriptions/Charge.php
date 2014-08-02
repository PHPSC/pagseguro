<?php
namespace PHPSC\PagSeguro\Purchases\Subscriptions;

use PHPSC\PagSeguro\Items\ItemCollection;
use PHPSC\PagSeguro\XmlSerializable;
use SimpleXMLElement;

class Charge implements XmlSerializable
{
    /**
     * @var string
     */
    private $subscriptionCode;

    /**
     * @var ItemCollection
     */
    private $items;

    /**
     * @var string
     */
    private $reference;

    /**
     * @param string $subscriptionCode
     * @param ItemCollection $items
     * @param string $reference
     */
    public function __construct(
        $subscriptionCode,
        ItemCollection $items,
        $reference = null
    ) {
        $this->subscriptionCode = $subscriptionCode;
        $this->items = $items;
        $this->reference = $reference;
    }

    /**
     * {@inheritdoc}
     */
    public function xmlSerialize(SimpleXMLElement $parent)
    {
        //TODO: implement it!

        return $parent;
    }
}
