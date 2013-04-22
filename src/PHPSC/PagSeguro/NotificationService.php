<?php
namespace PHPSC\PagSeguro;

use PHPSC\PagSeguro\Codec\TransactionDecoder;
use PHPSC\PagSeguro\ValueObject\Credentials;
use PHPSC\PagSeguro\Http\Client;

class NotificationService
{
    /**
     * @var string
     */
    const ENDPOINT = 'https://ws.pagseguro.uol.com.br/v2/transactions/notifications';

    /**
     * @var \PHPSC\PagSeguro\ValueObject\Credentials
     */
    private $credentials;

    /**
     * @var \PHPSC\PagSeguro\Http\Client
     */
    private $client;

    /**
     * @var \PHPSC\PagSeguro\Codec\TransactionDecoder
     */
    private $decoder;

    /**
     * @param \PHPSC\PagSeguro\ValueObject\Credentials $credentials
     * @param \PHPSC\PagSeguro\Http\Client $client
     * @param \PHPSC\PagSeguro\Codec\TransactionDecoder $decoder
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
     * @return \PHPSC\PagSeguro\ValueObject\Transaction
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
