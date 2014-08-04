<?php
namespace PHPSC\PagSeguro\Purchases;

use PHPSC\PagSeguro\Purchases\Subscriptions\Charge;
use PHPSC\PagSeguro\Purchases\Subscriptions\ChargeResponse;
use PHPSC\PagSeguro\Purchases\Subscriptions\CancellationResponse;

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
     * @return ChargeBuilder
     */
    public function createChargeBuilder($code);

    /**
     * @param string $code
     *
     * @return CancellationResponse
     */
    public function cancel($code);

    /**
     * @param Charge $charge
     *
     * @return ChargeResponse
     */
    public function charge(Charge $charge);
}
