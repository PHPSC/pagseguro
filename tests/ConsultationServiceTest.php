<?php
namespace PHPSC\PagSeguro\Test;

use PHPSC\PagSeguro\Http\Client;
use PHPSC\PagSeguro\Codec\TransactionDecoder;
use PHPSC\PagSeguro\ValueObject\Credentials;
use PHPSC\PagSeguro\ConsultationService;

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
     * @var TransactionDecoder|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $decoder;

    protected function setUp()
    {
        $this->credentials = new Credentials('a@a.com', 't');
        $this->client = $this->getMock('PHPSC\PagSeguro\Http\Client', [], [], '', false);
        $this->decoder = $this->getMock('PHPSC\PagSeguro\Codec\TransactionDecoder', [], [], '', false);
    }

    /**
     * @test
     */
    public function getByCodeShouldDoAGetRequestAddingCredentialsData()
    {
        $xml = simplexml_load_string('<?xml version="1.0" encoding="UTF-8"?><data />');
        $transaction = $this->getMock('PHPSC\PagSeguro\ValueObject\Transaction', [], [], '', false);

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
