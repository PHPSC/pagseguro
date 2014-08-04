<?php
namespace PHPSC\PagSeguro\Requests;

use PHPSC\PagSeguro\Requests\Checkout\Checkout;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
interface CheckoutService
{
    /**
     * @var string
     */
    const REDIRECT_TO = '/v2/checkout/payment.html';

    /**
     * @var string
     */
    const ENDPOINT = '/v2/checkout';

    /**
     * @return CheckoutBuilder
     */
    public function createCheckoutBuilder();

    /**
     * @param Checkout $checkout
     *
     * @return Redirection
     */
    public function checkout(Checkout $checkout);
}
