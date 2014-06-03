<?php
namespace PHPSC\PagSeguro\Test\Purchases;

use PHPSC\PagSeguro\Credentials;
use PHPSC\PagSeguro\Purchases\OrderingService;

class OrderingServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Client|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $client;

    protected function setUp()
    {
        $this->client = $this->getMock('PHPSC\PagSeguro\Client', array(), array(), '', false);
    }

    /**
     * @test
     * @dataProvider environments
     */
    public function checkoutShouldDoAPostRequestReturningDataAccordingWithEnvironment(
        Credentials $credentials,
        $wsUri,
        $redirectUri
    ) {
        $xml = simplexml_load_string('<?xml version="1.0" encoding="UTF-8"?><checkout />');
        $order = $this->getMock('PHPSC\PagSeguro\Purchases\Order', array(), array(), '', false);

        $order->expects($this->any())
              ->method('xmlSerialize')
              ->willReturn($xml);

        $this->client->expects($this->once())
                     ->method('post')
                     ->with($wsUri, $xml)
                     ->willReturn($xml);

        $service = new OrderingService($credentials, $this->client);
        $redirection = $service->checkout($order);

        $this->assertInstanceOf('PHPSC\PagSeguro\Redirection', $redirection);
        $this->assertAttributeEquals($redirectUri, 'uri', $redirection);
    }

    public function environments()
    {
        return array(
            array(
                new Credentials('a@a.com', 't'),
                'https://ws.pagseguro.uol.com.br/v2/checkout?email=a%40a.com&token=t',
                'https://pagseguro.uol.com.br/v2/checkout/payment.html'
            ),
            array(
                new Credentials('a@a.com', 't', true),
                'https://ws.sandbox.pagseguro.uol.com.br/v2/checkout?email=a%40a.com&token=t',
                'https://sandbox.pagseguro.uol.com.br/v2/checkout/payment.html'
            )
        );
    }
}
