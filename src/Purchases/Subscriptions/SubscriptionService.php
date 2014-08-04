<?php
namespace PHPSC\PagSeguro\Purchases\Subscriptions;

use DateTime;
use PHPSC\PagSeguro\Purchases\SubscriptionService as SubscriptionServiceInterface;
use PHPSC\PagSeguro\Service;
use PHPSC\PagSeguro\Credentials;
use PHPSC\PagSeguro\Client\Client;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class SubscriptionService extends Service implements SubscriptionServiceInterface
{
    /**
     * @var ChargeSerializer
     */
    private $serializer;

    /**
     * @param Credentials $credentials
     * @param Client $client
     * @param ChargeSerializer $serializer
     */
    public function __construct(
        Credentials $credentials,
        Client $client = null,
        ChargeSerializer $serializer = null
    ) {
        parent::__construct($credentials, $client);

        $this->serializer = $serializer ?: new ChargeSerializer();
    }

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
        $response = $this->post(static::CHARGE_ENDPOINT, $this->serializer->serialize($charge));

        return new ChargeResponse(
            (string) $response->transactionCode,
            new DateTime((string) $response->date)
        );
    }
}
