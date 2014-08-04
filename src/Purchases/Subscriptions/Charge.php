<?php
namespace PHPSC\PagSeguro\Purchases\Subscriptions;

use PHPSC\PagSeguro\Items\ItemCollection;

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
}
