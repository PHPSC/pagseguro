<?php
namespace PHPSC\PagSeguro;

use PHPSC\PagSeguro\Checkout\Checkout;

interface CheckoutService
{
    /**
     * @var string
     */
    const REDIRECT_TO = 'https://pagseguro.uol.com.br/v2/checkout/payment.html';

    /**
     * @var string
     */
    const SANDBOX_REDIRECT_TO = 'https://sandbox.pagseguro.uol.com.br/v2/checkout/payment.html';

    /**
     * @var string
     */
    const ENDPOINT = '/v2/checkout';

    /**
     * @param Checkout $checkout
     *
     * @return Redirection
     */
    public function checkout(Checkout $checkout);
}
