<?php
namespace PHPSC\PagSeguro\Requests\Checkout;

use PHPSC\PagSeguro\Customer\Customer;
use PHPSC\PagSeguro\XmlSerializable;
use SimpleXMLElement;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class Checkout implements XmlSerializable
{
    /**
     * @var Order
     */
    private $order;

    /**
     * @var Customer
     */
    private $customer;

    /**
     * @var string
     */
    private $redirectTo;

    /**
     * @var int
     */
    private $maxUses;

    /**
     * @var int
     */
    private $maxAge;

    /**
     * @param Order $order
     * @param Customer $customer
     * @param string $redirectTo
     * @param string $maxUses
     * @param string $maxAge
     */
    public function __construct(Order $order = null)
    {
        $this->order = $order ?: new Order();
    }

    /**
     * @return Order
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param Customer $customer
     */
    public function setCustomer(Customer $customer)
    {
        $this->customer = $customer;
    }

    /**
     * @param string $redirectTo
     */
    public function setRedirectTo($redirectTo)
    {
        $this->redirectTo = $redirectTo;
    }

    /**
     * @param int $maxUses
     */
    public function setMaxUses($maxUses)
    {
        $this->maxUses = $maxUses;
    }

    /**
     * @param int $maxAge
     */
    public function setMaxAge($maxAge)
    {
        $this->maxAge = $maxAge;
    }

    /**
     * {@inheritdoc}
     */
    public function xmlSerialize(SimpleXMLElement $parent)
    {
        $this->order->xmlSerialize($parent);

        if ($this->customer !== null) {
            $this->customer->xmlSerialize($parent);
        }

        if ($this->redirectTo !== null) {
            $parent->addChild('redirectURL', $this->redirectTo);
        }

        if ($this->maxUses !== null) {
            $parent->addChild('maxUses', $this->maxUses);
        }

        if ($this->maxAge !== null) {
            $parent->addChild('maxAge', $this->maxAge);
        }

        return $parent;
    }
}
