<?php
namespace PHPSC\PagSeguro\Purchases\Subscriptions;

use PHPSC\PagSeguro\Client\Client;
use PHPSC\PagSeguro\Credentials;
use PHPSC\PagSeguro\Purchases\NotificationService;
use PHPSC\PagSeguro\Purchases\SearchService;
use PHPSC\PagSeguro\Service;

class SubscriptionLocator extends Service implements SearchService, NotificationService
{
    /**
     * @var SubscriptionDecoder
     */
    private $decoder;

    /**
     * @param Credentials $credentials
     * @param Client $client
     * @param SubscriptionDecoder $decoder
     */
    public function __construct(
        Credentials $credentials,
        Client $client = null,
        SubscriptionDecoder $decoder = null
    ) {
        parent::__construct($credentials, $client);

        $this->decoder = $decoder ?: new SubscriptionDecoder();
    }

    /**
     * {@inheritdoc}
     */
    public function getByCode($code)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getByNotification($code)
    {
    }
}
