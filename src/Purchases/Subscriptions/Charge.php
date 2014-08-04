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
     * @param string $subscriptionCode
     * @param ItemCollection $items
     * @param string $reference
     */
    public function __construct(
        $subscriptionCode,
        ItemCollection $items = null,
        $reference = null
    ) {
        $this->subscriptionCode = $subscriptionCode;
        $this->items = $items ?: new Items();
        $this->reference = $reference;
    }
}
