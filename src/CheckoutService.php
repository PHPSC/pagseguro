<?php
namespace PHPSC\PagSeguro;

use PHPSC\PagSeguro\Checkout\Checkout;
use PHPSC\PagSeguro\Checkout\Response;

interface CheckoutService
{
    /**
     * @var string
     */
    const ENDPOINT = '/v2/checkout';

    /**
     * @param Checkout $checkout
     *
     * @return Response
     */
    public function checkout(Checkout $checkout);
}
