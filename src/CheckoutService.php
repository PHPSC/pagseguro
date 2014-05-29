<?php
namespace PHPSC\PagSeguro;

use PHPSC\PagSeguro\Checkout\Checkout;
use PHPSC\PagSeguro\Checkout\Response;

interface CheckoutService
{
    /**
     * @param Checkout $checkout
     *
     * @return Response
     */
    public function checkout(Checkout $checkout);
}
