<?php
namespace PHPSC\PagSeguro\Requests\Checkout;

use PHPSC\PagSeguro\Customer\Customer;
use PHPSC\PagSeguro\Items\Item;
use PHPSC\PagSeguro\Requests\CheckoutBuilder as CheckoutBuilderInterface;
use PHPSC\PagSeguro\Shipping\Shipping;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class CheckoutBuilder implements CheckoutBuilderInterface
{
    /**
     * @var Checkout
     */
    private $checkout;

    /**
     * @param Checkout $checkout
     */
    public function __construct(Checkout $checkout = null)
    {
        $this->checkout = $checkout ?: new Checkout();
    }

    /**
     * {@inheritdoc}
     */
    public function addItem(Item $item)
    {
        $this->checkout->getOrder()->getItems()->add($item);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setShipping(Shipping $shipping)
    {
        $this->checkout->getOrder()->setShipping($shipping);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setReference($reference)
    {
        $this->checkout->getOrder()->setReference($reference);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setCustomer(Customer $customer)
    {
        $this->checkout->setCustomer($customer);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setRedirectTo($redirectTo)
    {
        $this->checkout->setRedirectTo($redirectTo);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setMaxAge($maxAge)
    {
        $this->checkout->setMaxAge($maxAge);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setMaxUses($maxUses)
    {
        $this->checkout->setMaxUses($maxUses);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setExtraAmount($extraAmount)
    {
        $this->checkout->getOrder()->setExtraAmount($extraAmount);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCheckout()
    {
        return $this->checkout;
    }
}
