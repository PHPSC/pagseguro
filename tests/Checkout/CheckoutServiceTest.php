<?php
namespace PHPSC\PagSeguro\Test;

use PHPSC\PagSeguro\Credentials;
use PHPSC\PagSeguro\Checkout\Encoder;
use PHPSC\PagSeguro\Checkout\Decoder;
use PHPSC\PagSeguro\Checkout\CheckoutService;
use PHPSC\PagSeguro\Http\Client;

class CheckoutServiceTest extends \PHPUnit_Framework_TestCase
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
     * @var Encoder|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $encoder;

    /**
     * @var Decoder|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $decoder;

    protected function setUp()
    {
        $this->credentials = new Credentials('a@a.com', 't');
        $this->client = $this->getMock('PHPSC\PagSeguro\Http\Client', array(), array(), '', false);
        $this->encoder = $this->getMock('PHPSC\PagSeguro\Checkout\Encoder', array(), array(), '', false);
        $this->decoder = $this->getMock('PHPSC\PagSeguro\Checkout\Decoder', array(), array(), '', false);
    }

    /**
     * @test
     */
    public function checkoutShouldDoAPostRequestAddingCredentialsData()
    {
        $xml = simplexml_load_string('<?xml version="1.0" encoding="UTF-8"?><data />');
        $checkout = $this->getMock('PHPSC\PagSeguro\Checkout\Checkout', array(), array(), '', false);
        $response = $this->getMock('PHPSC\PagSeguro\Checkout\Response', array(), array(), '', false);
        $params = array('email' => 'a@a.com', 'token' => 't', 'testing' => true);

        $this->encoder->expects($this->once())
                      ->method('encode')
                      ->with($checkout)
                      ->willReturn(array('testing' => true));

        $this->client->expects($this->once())
                     ->method('post')
                     ->with('https://ws.pagseguro.uol.com.br/v2/checkout', $params)
                     ->willReturn($xml);

        $this->decoder->expects($this->once())
                      ->method('decode')
                      ->with($xml, false)
                      ->willReturn($response);

        $service = new CheckoutService($this->credentials, $this->client, $this->encoder, $this->decoder);

        $this->assertSame($response, $service->checkout($checkout));
    }
}
