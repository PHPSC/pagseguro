<?php
namespace PHPSC\PagSeguro\Test\Service;

use Guzzle\Common\Event;
use Guzzle\Http\Client as HttpClient;
use Guzzle\Http\Message\Response;
use Guzzle\Http\Message\Request;
use PHPSC\PagSeguro\Service\BaseService;
use PHPSC\PagSeguro\Service\Client;
use Symfony\Component\EventDispatcher\EventDispatcher;

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
        $this->httpClient = $this->getMock('Guzzle\Http\Client', array(), array(), '', false);
        $this->request = $this->getMock('Guzzle\Http\Message\Request', array(), array(), '', false);
        $this->response = $this->getMock('Guzzle\Http\Message\Response', array(), array(), '', false);

        $this->httpClient->expects($this->any())
                         ->method('getEventDispatcher')
                         ->willReturn(new EventDispatcher());

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
        $this->assertTrue($this->httpClient->getEventDispatcher()->hasListeners('request.error'));
    }

    /**
     * @test
     */
    public function handleErrorShouldBypassEventWhenHostIsNotFromPagSeguro()
    {
        $client = new Client($this->httpClient);
        $event = new Event(array('request' => $this->request, 'response' => $this->response));

        $this->request->expects($this->any())
                      ->method('getHost')
                      ->willReturn('example.org');

        $this->assertNull($client->handleError($event));
    }

    /**
     * @test
     * @expectedException PHPSC\PagSeguro\Service\PagSeguroException
     */
    public function handleErrorShouldRaiseExceptionWhenHostIsFromPagSeguro()
    {
        $client = new Client($this->httpClient);
        $event = new Event(array('request' => $this->request, 'response' => $this->response));

        $this->request->expects($this->any())
                      ->method('getHost')
                      ->willReturn(BaseService::SANDBOX_HOST);

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
                             array('Content-Type' => 'application/xml; charset=UTF-8'),
                             $xml->asXML(),
                             array('verify' => false)
                         )->willReturn($this->request);

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
                         ->with('/test?name=Test', null, array('verify' => false))
                         ->willReturn($this->request);

        $this->assertInstanceOf('SimpleXMLElement', $client->get('/test?name=Test'));
    }
}
