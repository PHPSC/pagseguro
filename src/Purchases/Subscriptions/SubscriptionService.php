<?php
namespace PHPSC\PagSeguro\Purchases\Subscriptions;

use DateTime;
use PHPSC\PagSeguro\Purchases\SubscriptionService as SubscriptionServiceInterface;
use PHPSC\PagSeguro\Service;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class SubscriptionService extends Service implements SubscriptionServiceInterface
{
    /**
     * {@inheritdoc}
     */
    public function createChargeBuilder($code)
    {
        return new ChargeBuilder($code);
    }

    /**
     * {@inheritdoc}
     */
    public function cancel($code)
    {
        $response = $this->get(static::CANCEL_ENDPOINT . '/' . $code);

        return new CancellationResponse(
            (string) $response->status,
            new DateTime((string) $response->date)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function charge(Charge $charge)
    {
        $response = $this->post(static::CHARGE_ENDPOINT, $charge->xmlSerialize());

        return new ChargeResponse(
            (string) $response->transactionCode,
            new DateTime((string) $response->date)
        );
    }
}
