<?php
namespace PHPSC\PagSeguro\Purchases\Transactions;

use PHPSC\PagSeguro\Credentials;
use PHPSC\PagSeguro\Client\Client;
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
    const ENDPOINT = '/v2/transactions';

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

    /**
     * {@inheritdoc}
     */
    public function getByNotification($code)
    {
        return $this->decoder->decode($this->get(static::ENDPOINT . '/notifications/' . $code));
    }
    
    /**
     * Consultar transações por período
     * @param \DateTime $initialDate Data inicial do intervalo
     * @param \DateTime $finalDate Data final do intervalo
     * @param int $page Página Página de resultados a ser retornada.
     * @param type $maxPageResults Número máximo de resultados por página.
     * @return TransactionSearchResult
     */
    public function getByPeriod(\DateTime $initialDate, \DateTime $finalDate, $page = 1, $maxPageResults = 50)
    {
        return $this->decoder->decodeTransactionSearch($this->get(static::ENDPOINT . '/', [
            'initialDate' => $initialDate->format('Y-m-d\TH:i'),
            'finalDate' => $finalDate->format('Y-m-d\TH:i'),
            'page' => $page,
            'maxPageResults' => $maxPageResults
        ]));
    }
}
