<?php
namespace PHPSC\PagSeguro\Notification;

use InvalidArgumentException;
use PHPSC\PagSeguro\BaseService;
use PHPSC\PagSeguro\Client;
use PHPSC\PagSeguro\Credentials;
use PHPSC\PagSeguro\NotificationService as NotificationServiceInterface;
use PHPSC\PagSeguro\Transaction\Decoder as TransactionDecoder;

class NotificationService extends BaseService implements NotificationServiceInterface
{
    /**
     * @var TransactionDecoder
     */
    private $transactionDecoder;

    /**
     * @param Credentials $credentials
     * @param Client $client
     * @param TransactionDecoder $transactionDecoder
     */
    public function __construct(
        Credentials $credentials,
        Client $client = null,
        TransactionDecoder $transactionDecoder = null
    ) {
        parent::__construct($credentials, $client);

        $this->transactionDecoder = $transactionDecoder ?: new TransactionDecoder();
    }

    /**
     * {@inheritdoc}
     */
    public function getByCode($type, $code)
    {
        if ($type == 'transaction') {
            return $this->transactionDecoder->decode($this->get(static::TRANSACTION . '/' . $code));
        }

        throw new InvalidArgumentException('Invalid type');
    }
}
