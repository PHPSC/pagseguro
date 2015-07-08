<?php

namespace PHPSC\PagSeguro\Client;

use GuzzleHttp\Event\ErrorEvent as Event;
use GuzzleHttp\Event\Emitter;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Message\Response;
use GuzzleHttp\Message\Request;
use PHPSC\PagSeguro\Environments\Production;
use GuzzleHttp\Transaction;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var HttpClient|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $httpClient;

    /**
     * @var Request|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $request;

    /**
     * @var Response|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $response;

    protected function setUp()
    {
        $this->httpClient = $this->getMock(HttpClient::class, [], [], '', false);
        $this->request = $this->getMock(Request::class, [], [], '', false);
        $this->response = $this->getMock(Response::class, [], [], '', false);

        $this->httpClient->expects($this->any())
                         ->method('getEmitter')
                         ->willReturn(new Emitter());

        $this->request->expects($this->any())
                      ->method('send')
                      ->willReturn($this->response);

        $xml = <<<'XML'
<?xml version="1.0" encoding="UTF-8"?>
<checkout>
    <code>8CF4BE7DCECEF0F004A6DFA0A8243412</code>
    <date>2010-12-02T10:11:28.000-02:00</date>
</checkout>
XML;

        $this->response->expects($this->any())
                       ->method('xml')
                       ->willReturn(simplexml_load_string($xml));
    }

    /**
     * @test
     */
    public function constructShouldAppendANewErrorListener()
    {
        $client = new Client($this->httpClient);

        $this->assertAttributeSame($this->httpClient, 'client', $client);
        $this->assertTrue($this->httpClient->getEmitter()->hasListeners('error'));
    }

    /**
     * @test
     */
    public function handleErrorShouldBypassEventWhenHostIsNotFromPagSeguro()
    {
        $client = new Client($this->httpClient);
        $transaction = new Transaction($this->httpClient, $this->request);
        $transaction->response = $this->response;
        $event = new Event($transaction);

        $this->request->expects($this->any())
                      ->method('getHost')
                      ->willReturn('example.org');

        $this->assertNull($client->handleError($event));
    }

    /**
     * @test
     * @expectedException \PHPSC\PagSeguro\Client\PagSeguroException
     */
    public function handleErrorShouldRaiseExceptionWhenHostIsFromPagSeguro()
    {
        $client = new Client($this->httpClient);
        $transaction = new Transaction($this->httpClient, $this->request);
        $transaction->response = $this->response;
        $event = new Event($transaction);

        $this->request->expects($this->any())
                      ->method('getHost')
                      ->willReturn(Production::WS_HOST);

        $this->response->expects($this->any())
                       ->method('getStatusCode')
                       ->willReturn(401);

        $this->response->expects($this->any())
                       ->method('getBody')
                       ->willReturn('Unauthorized');

        $client->handleError($event);
    }

    /**
     * @test
     */
    public function postShouldSendTheBodyAsXml()
    {
        $client = new Client($this->httpClient);
        $xml = simplexml_load_string('<?xml version="1.0" encoding="UTF-8"?><checkout/>');

        $this->httpClient->expects($this->once())
                         ->method('post')
                         ->with(
                             '/test',
                             [
                                'headers' => ['Content-Type' => 'application/xml; charset=UTF-8'],
                                'body' => $xml->asXML(),
                                'verify' => false
                             ]
                         )->willReturn($this->response);

        $this->assertInstanceOf('SimpleXMLElement', $client->post('/test', $xml));
    }

    /**
     * @test
     */
    public function getShouldConfigureHeaders()
    {
        $client = new Client($this->httpClient);

        $this->httpClient->expects($this->once())
                         ->method('get')
                         ->with('/test?name=Test', ['verify' => false])
                         ->willReturn($this->response);

        $this->assertInstanceOf('SimpleXMLElement', $client->get('/test?name=Test'));
    }
}
