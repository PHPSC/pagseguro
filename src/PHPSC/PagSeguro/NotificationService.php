<?php
namespace PHPSC\PagSeguro;

use PHPSC\PagSeguro\Codec\TransactionDecoder;
use PHPSC\PagSeguro\ValueObject\Credentials;
use PHPSC\PagSeguro\ValueObject\Transaction;
use PHPSC\PagSeguro\Http\Client;

class NotificationService
{
    /**
     * @var string
     */
    const ENDPOINT = 'https://ws.pagseguro.uol.com.br/v2/transactions/notifications';

    /**
     * @var Credentials
     */
    private $credentials;

    /**
     * @var Client
     */
    private $client;

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
        $this->credentials = $credentials;
        $this->client = $client ?: new Client();
        $this->decoder = $decoder ?: new TransactionDecoder();
    }

    /**
     * @param string $code
     * @return Transaction
     */
    public function getByCode($code)
    {
        $content = $this->client->get(
            static::ENDPOINT . '/' . $code
            . '?email=' . $this->credentials->getEmail()
            . '&token=' . $this->credentials->getToken()
        );

        return $this->decoder->decode($content);
    }
}
