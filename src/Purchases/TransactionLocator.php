<?php
namespace PHPSC\PagSeguro\Purchases;

use PHPSC\PagSeguro\NotificationService;
use PHPSC\PagSeguro\SearchService;
use PHPSC\PagSeguro\Service\BaseService;
use PHPSC\PagSeguro\Service\Credentials;
use PHPSC\PagSeguro\Service\Client;

class TransactionLocator extends BaseService implements SearchService, NotificationService
{
    /**
     * @var TransactionDecoder
     */
    private $decoder;

    /**
     * @param Credentials $credentials
     * @param Client $client
     * @param TransactionDecoder $decoder
     */
    public function __construct(
        Credentials $credentials,
        Client $client = null,
        TransactionDecoder $decoder = null
    ) {
        parent::__construct($credentials, $client);

        $this->decoder = $decoder ?: new TransactionDecoder();
    }

    /**
     * @param string $code
     *
     * @return Transaction
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
