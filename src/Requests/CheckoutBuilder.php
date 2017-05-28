<?php
namespace PHPSC\PagSeguro\Requests;

use PHPSC\PagSeguro\Customer\Customer;
use PHPSC\PagSeguro\Items\Item;
use PHPSC\PagSeguro\Requests\Checkout\Checkout;
use PHPSC\PagSeguro\Shipping\Shipping;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
interface CheckoutBuilder
{
    /**
     * @param Item $item
     *
     * @return self
     */
    public function addItem(Item $item);

    /**
     * @param Shipping $shipping
     *
     * @return self
     */
    public function setShipping(Shipping $shipping);

    /**
     * @param string $reference
     *
     * @return self
     */
    public function setReference($reference);

    /**
     * @param Customer $customer
     *
     * @return self
     */
    public function setCustomer(Customer $customer);

    /**
     * @param string $redirectTo
     *
     * @return self
     */
    public function setRedirectTo($redirectTo);

    /**
     * @param int $maxAge
     *
     * @return self
     */
    public function setMaxAge($maxAge);

    /**
     * @param int $maxUses
     *
     * @return self
     */
    public function setMaxUses($maxUses);

    /**
     * @param float $extraAmount
     *
     * @return self
     */
    public function setExtraAmount($extraAmount);

    /**
     * @return Checkout
     */
    public function getCheckout();
}
