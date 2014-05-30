<?php
namespace PHPSC\PagSeguro\Test;

use DateTime;
use PHPSC\PagSeguro\Credentials;
use PHPSC\PagSeguro\Client;
use PHPSC\PagSeguro\Checkout\Encoder;
use PHPSC\PagSeguro\Checkout\CheckoutService;

class CheckoutServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Client|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $client;

    /**
     * @var Encoder|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $encoder;

    protected function setUp()
    {
        $this->client = $this->getMock('PHPSC\PagSeguro\Client', array(), array(), '', false);
        $this->encoder = $this->getMock('PHPSC\PagSeguro\Checkout\Encoder', array(), array(), '', false);
    }

    /**
     * @test
     * @dataProvider environments
     */
    public function checkoutShouldDoAPostRequestReturningDataAccordingWithEnvironment($sandbox, $wsUri, $redirectUri)
    {
        $data = <<<'XML'
<?xml version="1.0" encoding="ISO-8859-1"?>
<checkout>
    <code>8CF4BE7DCECEF0F004A6DFA0A8243412</code>
    <date>2014-05-29T03:11:28.000-03:00</date>
</checkout>
XML;

        $xml = simplexml_load_string($data);
        $checkout = $this->getMock('PHPSC\PagSeguro\Checkout\Checkout', array(), array(), '', false);
        $params = array('email' => 'a@a.com', 'token' => 't', 'testing' => true);

        $this->encoder->expects($this->once())
                      ->method('encode')
                      ->with($checkout)
                      ->willReturn(array('testing' => true));

        $this->client->expects($this->once())
                     ->method('post')
                     ->with($wsUri, $params)
                     ->willReturn($xml);

        $service = new CheckoutService(new Credentials('a@a.com', 't', $sandbox), $this->client, $this->encoder);
        $response = $service->checkout($checkout);

        $this->assertInstanceOf('PHPSC\PagSeguro\Checkout\Response', $response);
        $this->assertAttributeEquals('8CF4BE7DCECEF0F004A6DFA0A8243412', 'code', $response);
        $this->assertAttributeEquals(new DateTime('2014-05-29T03:11:28.000-03:00'), 'date', $response);
        $this->assertAttributeEquals($redirectUri, 'uri', $response);
    }

    public function environments()
    {
        return array(
            array(
                false,
                'https://ws.pagseguro.uol.com.br/v2/checkout',
                'https://pagseguro.uol.com.br/v2/checkout/payment.html'
            ),
            array(
                true,
                'https://ws.sandbox.pagseguro.uol.com.br/v2/checkout',
                'https://sandbox.pagseguro.uol.com.br/v2/checkout/payment.html'
            )
        );
    }
}
