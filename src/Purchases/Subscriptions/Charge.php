<?php
namespace PHPSC\PagSeguro\Purchases\Subscriptions;

use PHPSC\PagSeguro\Items\ItemCollection;
use PHPSC\PagSeguro\Items\Items;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class Charge
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
     * @param ItemCollection $items
     */
    public function __construct(ItemCollection $items = null)
    {
        $this->items = $items ?: new Items();
    }

    /**
     * @return string
     */
    public function getSubscriptionCode()
    {
        return $this->subscriptionCode;
    }

    /**
     * @param string $subscriptionCode
     */
    public function setSubscriptionCode($subscriptionCode)
    {
        $this->subscriptionCode = $subscriptionCode;
    }

    /**
     * @return ItemCollection
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
    }
}
