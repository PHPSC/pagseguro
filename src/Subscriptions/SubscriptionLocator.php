<?php
namespace PHPSC\PagSeguro\Subscriptions;

use PHPSC\PagSeguro\NotificationService;
use PHPSC\PagSeguro\SearchService;
use PHPSC\PagSeguro\Service\BaseService;
use PHPSC\PagSeguro\Service\Credentials;
use PHPSC\PagSeguro\Service\Client;

class SubscriptionLocator extends BaseService implements SearchService, NotificationService
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
