<?php
namespace PHPSC\PagSeguro\Purchases\Subscriptions;

use PHPSC\PagSeguro\Client\Client;
use PHPSC\PagSeguro\Credentials;
use PHPSC\PagSeguro\Purchases\NotificationService;
use PHPSC\PagSeguro\Purchases\SearchService;
use PHPSC\PagSeguro\Service;
use PHPSC\PagSeguro\Purchases\Transactions\Transaction;
use SimpleXMLElement;

/**
 * @author Renato Moura <moura137@gmail.com>
 */
class LocatorTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructShouldSettersDecoder()
    {
        $credentials = $this->createMock(Credentials::class);
        $client      = $this->createMock(Client::class);
        $decoder     = $this->createMock(Decoder::class);

        $locator = new Locator($credentials, $client, $decoder);

        $this->assertInstanceOf(NotificationService::class, $locator);
        $this->assertInstanceOf(SearchService::class, $locator);
        $this->assertInstanceOf(Service::class, $locator);
        $this->assertAttributeSame($decoder, 'decoder', $locator);
    }

    public function testGetByCodeShouldDoAGetRequestAddingCredentialsData()
    {
        $credentials = $this->createMock(Credentials::class);
        $client      = $this->createMock(CLient::class);
        $decoder     = $this->createMock(Decoder::class);

        $locator = new Locator($credentials, $client, $decoder);

        $wsUrl = 'https://ws.test.com/v2/transactions?token=zzzzz';

        $credentials->expects($this->once())
                    ->method('getWsUrl')
                    ->with('/v2/pre-approvals/123456', [])
                    ->willReturn($wsUrl);

        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><transaction/>');
        $client->expects($this->once())->method('get')->with($wsUrl)->willReturn($xml);

        $transaction = $this->createMock(Transaction::class);
        $decoder->expects($this->once())->method('decode')->with($xml)->willReturn($transaction);

        $this->assertEquals($transaction, $locator->getByCode('123456'));
    }

    public function testGetByNotificationShouldDoAGetRequestAddingCredentialsData()
    {
        $credentials = $this->createMock(Credentials::class);
        $client      = $this->createMock(Client::class);
        $decoder     = $this->createMock(Decoder::class);

        $locator = new Locator($credentials, $client, $decoder);

        $wsUrl = 'https://ws.test.com/v2/transactions?token=xxxxx';
        $credentials->expects($this->once())
            ->method('getWsUrl')
            ->with('/v2/pre-approvals/notifications/abcd', [])
            ->willReturn($wsUrl);

        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><transaction/>');
        $client->expects($this->once())->method('get')->with($wsUrl)->willReturn($xml);

        $transaction = $this->createMock(Transaction::class);

        $decoder->expects($this->once())
                ->method('decode')
                ->with($xml)
                ->willReturn($transaction);

        $this->assertEquals($transaction, $locator->getByNotification('abcd'));
    }
}
