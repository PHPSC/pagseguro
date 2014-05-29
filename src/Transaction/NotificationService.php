<?php
namespace PHPSC\PagSeguro\Transaction;

use PHPSC\PagSeguro\BaseService;
use PHPSC\PagSeguro\Credentials;
use PHPSC\PagSeguro\NotificationService as NotificationServiceInterface;
use PHPSC\PagSeguro\Http\Client;

class NotificationService extends BaseService implements NotificationServiceInterface
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
     *
     * @return Transaction
     */
    public function getByCode($code)
    {
        return $this->decoder->decode($this->get(static::ENDPOINT . '/' . $code));
    }
}
