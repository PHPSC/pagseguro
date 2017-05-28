<?php
namespace PHPSC\PagSeguro\Purchases\Subscriptions;

use PHPSC\PagSeguro\Purchases\SubscriptionService as SubscriptionServiceInterface;
use PHPSC\PagSeguro\Service;
use PHPSC\PagSeguro\Credentials;
use PHPSC\PagSeguro\Client\Client;
use DateTime;
use SimpleXMLElement;

/**
 * @author Renato Moura <moura137@gmail.com>
 */
class SubscriptionServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Credentials|\PHPUnit_Framework_MockObject_MockObject
     */
    private $credentials;

    /**
     * @var Client|\PHPUnit_Framework_MockObject_MockObject
     */
    private $client;

    /**
     * @var ChargeSerializer|\PHPUnit_Framework_MockObject_MockObject
     */
    private $serializer;

    protected function setUp()
    {
        $this->credentials = $this->createMock(Credentials::class);
        $this->client      = $this->createMock(Client::class);
    }

    public function testConstructShouldSettersDecoder()
    {
        $service = new SubscriptionService($this->credentials, $this->client);

        $this->assertInstanceOf(SubscriptionServiceInterface::class, $service);
        $this->assertInstanceOf(Service::class, $service);
    }

    public function testCreateChargeBuilderShouldReturnObjectBuilder()
    {
        $service = new SubscriptionService($this->credentials, $this->client);

        $this->assertEquals(new ChargeBuilder('ABCDEF'), $service->createChargeBuilder('ABCDEF'));
    }

    public function testCancelShouldDoReturnCancellationResponse()
    {
        $wsUrl = 'https://ws.test.com/v2/transactions?token=zzzzz';
        $this->credentials
            ->expects($this->once())
            ->method('getWsUrl')
            ->with('/v2/pre-approvals/cancel/ABCDEF', [])
            ->willReturn($wsUrl);

        $response  = '<?xml version="1.0" encoding="UTF-8"?><transaction>';
        $response .= '<status>6</status><date>2015-11-19T11:33:54.000-03:00</date>';
        $response .= '</transaction>';
        $xmlResponse = new SimpleXMLElement($response);
        $this->client
            ->expects($this->once())
            ->method('get')
            ->with($wsUrl)
            ->willReturn($xmlResponse);

        $service = new SubscriptionService($this->credentials, $this->client);

        $expected = new CancellationResponse('6', new DateTime('2015-11-19T11:33:54.000-03:00'));
        $this->assertEquals($expected, $service->cancel('ABCDEF'));
    }

    public function testChargeShouldDoReturnChargeResponse()
    {
        $charge = $this->createMock(Charge::class);

        $request  = '<?xml version="1.0" encoding="UTF-8"?><payment/>';
        $xmlRequest = new SimpleXMLElement($request);
        $charge
            ->expects($this->once())
            ->method('xmlSerialize')
            ->willReturn($xmlRequest);

        $wsUrl = 'https://ws.test.com/v2/transactions?token=zzzzz';
        $this->credentials
            ->expects($this->once())
            ->method('getWsUrl')
            ->with('/v2/pre-approvals/payment')
            ->willReturn($wsUrl);

        $response  = '<?xml version="1.0" encoding="UTF-8"?><transaction>';
        $response .= '<transactionCode>123456</transactionCode><date>2015-11-19T11:33:54.000-03:00</date>';
        $response .= '</transaction>';
        $xmlResponse = new SimpleXMLElement($response);
        $this->client
            ->expects($this->once())
            ->method('post')
            ->with($wsUrl, $xmlRequest)
            ->willReturn($xmlResponse);

        $service = new SubscriptionService($this->credentials, $this->client);

        $expected = new ChargeResponse('123456', new DateTime('2015-11-19T11:33:54.000-03:00'));
        $this->assertEquals($expected, $service->charge($charge));
    }
}
