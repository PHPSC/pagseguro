<?php
namespace PHPSC\PagSeguro\Test;

use PHPSC\PagSeguro\Codec\PaymentEncoder;
use PHPSC\PagSeguro\Codec\PaymentDecoder;
use PHPSC\PagSeguro\Http\Client;
use PHPSC\PagSeguro\ValueObject\Credentials;
use PHPSC\PagSeguro\PaymentService;

class PaymentServiceTest extends \PHPUnit_Framework_TestCase
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
     * @var PaymentEncoder|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $encoder;

    /**
     * @var PaymentDecoder|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $decoder;

    protected function setUp()
    {
        $this->credentials = new Credentials('a@a.com', 't');
        $this->client = $this->getMock('PHPSC\PagSeguro\Http\Client', [], [], '', false);
        $this->encoder = $this->getMock('PHPSC\PagSeguro\Codec\PaymentEncoder', [], [], '', false);
        $this->decoder = $this->getMock('PHPSC\PagSeguro\Codec\PaymentDecoder', [], [], '', false);
    }

    /**
     * @test
     */
    public function checkoutShouldDoAPostRequestAddingCredentialsData()
    {
        $xml = simplexml_load_string('<?xml version="1.0" encoding="UTF-8"?><data />');
        $request = $this->getMock('PHPSC\PagSeguro\ValueObject\Payment\PaymentRequest', [], [], '', false);
        $response = $this->getMock('PHPSC\PagSeguro\ValueObject\Payment\PaymentResponse', [], [], '', false);

        $this->encoder->expects($this->once())
                      ->method('encode')
                      ->with($request)
                      ->willReturn(array('email' => 'a@a.com', 'token' => 't'));

        $this->client->expects($this->once())
                     ->method('post')
                     ->with('https://ws.pagseguro.uol.com.br/v2/checkout', array('email' => 'a@a.com', 'token' => 't'))
                     ->willReturn($xml);

        $this->decoder->expects($this->once())
                      ->method('decode')
                      ->with($xml)
                      ->willReturn($response);

        $service = new PaymentService($this->credentials, $this->client, $this->encoder, $this->decoder);

        $this->assertSame($response, $service->checkout($request));
    }
}
