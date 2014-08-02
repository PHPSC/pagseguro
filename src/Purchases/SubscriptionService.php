<?php
namespace PHPSC\PagSeguro\Purchases;

use PHPSC\PagSeguro\Purchases\Subscriptions\Charge;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
interface SubscriptionService
{
    /**
     * @var string
     */
    const ENDPOINT = '/v2/pre-approvals';

    /**
     * @param string $code
     */
    public function cancel($code);

    /**
     * @param Charge $charge
     */
    public function pay(Charge $charge);
}
