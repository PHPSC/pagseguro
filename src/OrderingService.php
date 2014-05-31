<?php
namespace PHPSC\PagSeguro;

use PHPSC\PagSeguro\Purchases\Order;

interface OrderingService
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
     * @param Order $order
     * @param Customer $customer
     * @param string $redirectTo
     * @param int $maxUses
     * @param int $maxAge
     *
     * @return Redirection
     */
    public function checkout(
        Order $order,
        Customer $customer = null,
        $redirectTo = null,
        $maxUses = null,
        $maxAge = null
    );
}
