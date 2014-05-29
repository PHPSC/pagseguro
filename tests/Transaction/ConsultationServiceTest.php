<?php
namespace PHPSC\PagSeguro\Test\Transaction;

use PHPSC\PagSeguro\Credentials;
use PHPSC\PagSeguro\Client;
use PHPSC\PagSeguro\Transaction\ConsultationService;
use PHPSC\PagSeguro\Transaction\Decoder;

class ConsultationServiceTest extends \PHPUnit_Framework_TestCase
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

    protected function setUp()
    {
        $this->credentials = new Credentials('a@a.com', 't');
        $this->client = $this->getMock('PHPSC\PagSeguro\Client', array(), array(), '', false);
        $this->decoder = $this->getMock('PHPSC\PagSeguro\Transaction\Decoder', array(), array(), '', false);
    }

    /**
     * @test
     */
    public function getByCodeShouldDoAGetRequestAddingCredentialsData()
    {
        $xml = simplexml_load_string('<?xml version="1.0" encoding="UTF-8"?><data />');
        $transaction = $this->getMock('PHPSC\PagSeguro\Transaction\Transaction', array(), array(), '', false);

        $this->client->expects($this->once())
                     ->method('get')
                     ->with('https://ws.pagseguro.uol.com.br/v2/transactions/1?email=a%40a.com&token=t')
                     ->willReturn($xml);

        $this->decoder->expects($this->once())
                      ->method('decode')
                      ->with($xml)
                      ->willReturn($transaction);

        $service = new ConsultationService($this->credentials, $this->client, $this->decoder);

        $this->assertSame($transaction, $service->getByCode(1));
    }
}
