<?php
namespace PHPSC\PagSeguro\Purchases\Subscriptions;

use PHPSC\PagSeguro\Client\Client;
use PHPSC\PagSeguro\Credentials;
use PHPSC\PagSeguro\Purchases\NotificationService;
use PHPSC\PagSeguro\Purchases\SearchService;
use PHPSC\PagSeguro\Service;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class Locator extends Service implements SearchService, NotificationService
{
    /**
     * @var string
     */
    const ENDPOINT = '/v2/pre-approvals';

    /**
     * @var Decoder
     */
    private $decoder;

    /**
     * @param Credentials $credentials
     * @param Client $client
     * @param Decoder $decoder
     */
    public function __construct(
        Credentials $credentials,
        Client $client = null,
        Decoder $decoder = null
    ) {
        parent::__construct($credentials, $client);

        $this->decoder = $decoder ?: new Decoder();
    }

    /**
     * {@inheritdoc}
     */
    public function getByCode($code)
    {
        return $this->decoder->decode($this->get(static::ENDPOINT . '/' . $code));
    }

    /**
     * {@inheritdoc}
     */
    public function getByNotification($code)
    {
        return $this->decoder->decode($this->get(static::ENDPOINT . '/notifications/' . $code));
    }
}
