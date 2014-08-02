<?php
namespace PHPSC\PagSeguro\Purchases;

use PHPSC\PagSeguro\Service\Credentials;
use PHPSC\PagSeguro\Service\Client;

class TransactionLocatorTest extends \PHPUnit_Framework_TestCase
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
     * @var TransactionDecoder|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $decoder;

    protected function setUp()
    {
        $this->credentials = new Credentials('a@a.com', 't');
        $this->client = $this->getMock('PHPSC\PagSeguro\Service\Client', array(), array(), '', false);
        $this->decoder = $this->getMock('PHPSC\PagSeguro\Purchases\TransactionDecoder', array(), array(), '', false);
    }

    /**
     * @test
     */
    public function getByCodeShouldDoAGetRequestAddingCredentialsData()
    {
        $xml = simplexml_load_string('<?xml version="1.0" encoding="UTF-8"?><data />');
        $transaction = $this->getMock('PHPSC\PagSeguro\Purchases\Transaction', array(), array(), '', false);

        $this->client->expects($this->once())
                     ->method('get')
                     ->with('https://ws.pagseguro.uol.com.br/v2/transactions/1?email=a%40a.com&token=t')
                     ->willReturn($xml);

        $this->decoder->expects($this->once())
                      ->method('decode')
                      ->with($xml)
                      ->willReturn($transaction);

        $service = new TransactionLocator($this->credentials, $this->client, $this->decoder);

        $this->assertSame($transaction, $service->getByCode(1));
    }

    /**
     * @test
     */
    public function getByNotificationShouldDoAGetRequestAddingCredentialsData()
    {
        $xml = simplexml_load_string('<?xml version="1.0" encoding="UTF-8"?><data />');
        $transaction = $this->getMock('PHPSC\PagSeguro\Transaction\Transaction', array(), array(), '', false);

        $this->client->expects($this->once())
                     ->method('get')
                     ->with('https://ws.pagseguro.uol.com.br/v2/transactions/notifications/1?email=a%40a.com&token=t')
                     ->willReturn($xml);

        $this->decoder->expects($this->once())
                      ->method('decode')
                      ->with($xml)
                      ->willReturn($transaction);

        $service = new TransactionLocator($this->credentials, $this->client, $this->decoder);

        $this->assertSame($transaction, $service->getByNotification(1));
    }
}
