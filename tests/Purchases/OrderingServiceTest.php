<?php
namespace PHPSC\PagSeguro\Purchases;

use PHPSC\PagSeguro\Service\Credentials;

class OrderingServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Client|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $client;

    protected function setUp()
    {
        $this->client = $this->getMock('PHPSC\PagSeguro\Service\Client', array(), array(), '', false);
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
        $customer = $this->getMock('PHPSC\PagSeguro\Customer\Customer', array(), array(), '', false);

        $order->expects($this->any())
              ->method('xmlSerialize');

        $customer->expects($this->any())
                 ->method('xmlSerialize');

        $this->client->expects($this->once())
                     ->method('post')
                     ->with($wsUri, $this->isInstanceOf('SimpleXMLElement'))
                     ->willReturn($xml);

        $service = new OrderingService($credentials, $this->client);
        $redirection = $service->checkout($order, $customer, 'http://example.com', 10, 12);

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
