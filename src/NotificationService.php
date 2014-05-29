<?php
namespace PHPSC\PagSeguro;

use PHPSC\PagSeguro\Transaction\Decoder;
use PHPSC\PagSeguro\Credentials;
use PHPSC\PagSeguro\Transaction\Transaction;
use PHPSC\PagSeguro\Http\Client;

class NotificationService extends BaseService
{
    /**
     * @var string
     */
    const ENDPOINT = '/v2/transactions/notifications';

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
     * @param string $code
     * @return Transaction
     */
    public function getByCode($code)
    {
        return $this->decoder->decode($this->get(static::ENDPOINT . '/' . $code));
    }
}
