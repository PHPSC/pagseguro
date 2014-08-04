<?php
namespace PHPSC\PagSeguro\Purchases;

use PHPSC\PagSeguro\Items\Item;
use PHPSC\PagSeguro\Purchases\Subscriptions\Charge;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
interface ChargeBuilder
{
    /**
     * @param Item $item
     *
     * @return self
     */
    public function addItem(Item $item);

    /**
     * @param string $reference
     *
     * @return self
     */
    public function setReference($reference);

    /**
     * @return Charge
     */
    public function getCharge();
}
