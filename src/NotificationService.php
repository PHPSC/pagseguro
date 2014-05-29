<?php
namespace PHPSC\PagSeguro;

use PHPSC\PagSeguro\Codec\TransactionDecoder;
use PHPSC\PagSeguro\Credentials;
use PHPSC\PagSeguro\ValueObject\Transaction;
use PHPSC\PagSeguro\Http\Client;

class NotificationService extends BaseService
{
    /**
     * @var string
     */
    const ENDPOINT = '/v2/transactions/notifications';

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
     * @return Transaction
     */
    public function getByCode($code)
    {
        return $this->decoder->decode($this->get(static::ENDPOINT . '/' . $code));
    }
}
