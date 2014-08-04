<?php
namespace PHPSC\PagSeguro\Purchases\Subscriptions;

use PHPSC\PagSeguro\Items\Item;
use PHPSC\PagSeguro\Purchases\ChargeBuilder as ChargeBuilderInterface;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class ChargeBuilder implements ChargeBuilderInterface
{
    /**
     * @var Charge
     */
    private $charge;

    /**
     * @param string $code
     * @param Charge $charge
     */
    public function __construct($code, Charge $charge = null)
    {
        $this->charge = $charge ?: new Charge();
        $this->charge->setSubscriptionCode($code);
    }

    /**
     * {@inheritdoc}
     */
    public function addItem(Item $item)
    {
        $this->charge->getItems()->add($item);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setReference($reference)
    {
        $this->charge->setReference($reference);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCharge()
    {
        return $this->charge;
    }
}
