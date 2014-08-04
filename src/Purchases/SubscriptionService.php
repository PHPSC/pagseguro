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
    const CHARGE_ENDPOINT = '/v2/pre-approvals/payment';

    /**
     * @var string
     */
    const CANCEL_ENDPOINT = '/v2/pre-approvals/cancel';

    /**
     * @param string $code
     */
    public function cancel($code);

    /**
     * @param Charge $charge
     */
    public function pay(Charge $charge);
}
