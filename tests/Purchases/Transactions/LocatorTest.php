<?php
namespace PHPSC\PagSeguro\Purchases\Transactions;

use PHPSC\PagSeguro\Credentials;
use PHPSC\PagSeguro\Client\Client;
use PHPSC\PagSeguro\Environment;
use DateTime;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class LocatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Credentials
     */
    protected $credentials;

    /**
     * @var Client|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $client;

    /**
     * @var Decoder|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $decoder;
    
    /**
     * @var DecoderTransactionSearch|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $decoderTransactionSearch;

    /**
     * @var Transaction|\PHPUnit_Framework_MockObject_MockObject
     */
    private $transaction;
    
    /**
     * @var TransactionSearchResult|\PHPUnit_Framework_MockObject_MockObject
     */
    private $transactionSearchResult;

    protected function setUp()
    {
        $environment = $this->getMockForAbstractClass(Environment::class);

        $environment->expects($this->any())
                    ->method('getHost')
                    ->willReturn('test.com');

        $environment->expects($this->any())
                    ->method('getWsHost')
                    ->willReturn('ws.test.com');

        $this->credentials = new Credentials('a@a.com', 't', $environment);
        $this->client = $this->getMock(Client::class, [], [], '', false);

        $this->decoder = $this->getMock(
            Decoder::class,
            [],
            [],
            '',
            false
        );
        
        $this->decoderTransactionSearch = $this->getMock(
            DecoderTransactionSearch::class,
            [],
            [],
            '',
            false
        );

        $this->transaction = $this->getMock(
            Transaction::class,
            [],
            [],
            '',
            false
        );
    }

    /**
     * @test
     */
    public function getByCodeShouldDoAGetRequestAddingCredentialsData()
    {
        $xml = simplexml_load_string('<?xml version="1.0" encoding="UTF-8"?><data />');

        $this->client->expects($this->once())
                     ->method('get')
                     ->with('https://ws.test.com/v2/transactions/1?email=a%40a.com&token=t')
                     ->willReturn($xml);

        $this->decoder->expects($this->once())
                      ->method('decode')
                      ->with($xml)
                      ->willReturn($this->transaction);

        $service = new Locator($this->credentials, $this->client, $this->decoder);

        $this->assertSame($this->transaction, $service->getByCode(1));
    }

    /**
     * @test
     */
    public function getByNotificationShouldDoAGetRequestAddingCredentialsData()
    {
        $xml = simplexml_load_string('<?xml version="1.0" encoding="UTF-8"?><data />');

        $this->client->expects($this->once())
                     ->method('get')
                     ->with('https://ws.test.com/v2/transactions/notifications/1?email=a%40a.com&token=t')
                     ->willReturn($xml);

        $this->decoder->expects($this->once())
                      ->method('decode')
                      ->with($xml)
                      ->willReturn($this->transaction);

        $service = new Locator($this->credentials, $this->client, $this->decoder);

        $this->assertSame($this->transaction, $service->getByNotification(1));
    }
    
    /**
     * @test
     */
    public function getByPeriodShouldDoAGetRequestAddingCredentialsData()
    {
        $xml = simplexml_load_string('<?xml version="1.0" encoding="UTF-8"?><data />');

        $initialDate = new DateTime('2015-01-01');
        $finalDate = new DateTime('2015-01-10');
        $page = 1;
        $maxPageResults = 50;

        $this->client->expects($this->once())
                ->method('get')
                ->with('https://ws.test.com/v2/transactions/?' .
                        http_build_query(array(
                            'initialDate' => $initialDate->format('Y-m-d\TH:i'),
                            'finalDate' => $finalDate->format('Y-m-d\TH:i'),
                            'page' => $page,
                            'maxPageResults' => $maxPageResults
                        )) .
                        '&email=a%40a.com&token=t')
                ->willReturn($xml);

        $this->decoderTransactionSearch->expects($this->once())
                ->method('decode')
                ->with($xml)
                ->willReturn($this->transactionSearchResult);

        $service = new Locator($this->credentials, $this->client, $this->decoder, $this->decoderTransactionSearch);

        $this->assertSame($this->transactionSearchResult, $service->getByPeriod($initialDate, $finalDate, $page, $maxPageResults));
    }

}
