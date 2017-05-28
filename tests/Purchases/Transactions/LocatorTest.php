<?php
namespace PHPSC\PagSeguro\Purchases\Transactions;

use PHPSC\PagSeguro\Credentials;
use PHPSC\PagSeguro\Client\Client;
use PHPSC\PagSeguro\Environment;

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
     * @var Transaction|\PHPUnit_Framework_MockObject_MockObject
     */
    private $transaction;

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

        $this->client      = $this->createMock(Client::class);
        $this->decoder     = $this->createMock(Decoder::class);
        $this->transaction = $this->createMock(Transaction::class);
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
}
