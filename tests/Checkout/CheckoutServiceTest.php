<?php
namespace PHPSC\PagSeguro\Test;

use DateTime;
use PHPSC\PagSeguro\Checkout\CheckoutService;
use PHPSC\PagSeguro\Credentials;
use PHPSC\PagSeguro\Client;

class CheckoutServiceTest extends \PHPUnit_Framework_TestCase
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
    public function checkoutShouldDoAPostRequestReturningDataAccordingWithEnvironment($credentials, $wsUri, $redirectUri)
    {
        $xml = simplexml_load_string(
            '<?xml version="1.0" encoding="UTF-8"?>'
            . '<checkout>'
            . '<code>8CF4BE7DCECEF0F004A6DFA0A8243412</code><date>2014-05-29T03:11:28.000-03:00</date>'
            . '</checkout>'
        );
        $checkout = $this->getMock('PHPSC\PagSeguro\Checkout\Checkout', array(), array(), '', false);

        $checkout->expects($this->any())
                 ->method('xmlSerialize')
                 ->willReturn($xml);

        $this->client->expects($this->once())
                     ->method('post')
                     ->with($wsUri, $xml)
                     ->willReturn($xml);

        $service = new CheckoutService($credentials, $this->client);
        $redirection = $service->checkout($checkout);

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
