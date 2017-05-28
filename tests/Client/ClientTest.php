<?php
namespace PHPSC\PagSeguro\Client;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Client as HttpClient;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var HttpClient|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $httpClient;

    /**
     * @var RequestInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $request;
    private $response;

    protected function setUp()
    {
        $this->httpClient = $this->createMock(ClientInterface::class);
        $this->request    = $this->createMock(RequestInterface::class);
        $this->response   = $this->createMock(ResponseInterface::class);

        $xml = <<<'XML'
<?xml version="1.0" encoding="UTF-8"?>
<checkout>
    <code>8CF4BE7DCECEF0F004A6DFA0A8243412</code>
    <date>2010-12-02T10:11:28.000-02:00</date>
</checkout>
XML;

        $this->response->expects($this->once())
                       ->method('getBody')
                       ->willReturn($xml);
    }

    /**
     * @test
     */
    public function postShouldSendTheBodyAsXml()
    {
        $client = new Client($this->httpClient);
        $xml = simplexml_load_string('<?xml version="1.0" encoding="UTF-8"?><checkout/>');

        $this->httpClient->expects($this->once())
                         ->method('request')
                         ->with(
                             'POST',
                             '/test',
                             [
                                'headers' => ['Content-Type' => 'application/xml; charset=UTF-8'],
                                'body'    => $xml->asXML(),
                                'verify'  => false
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
                         ->method('request')
                         ->with('GET', '/test?name=Test', ['verify' => false])
                         ->willReturn($this->response);

        $this->assertInstanceOf('SimpleXMLElement', $client->get('/test?name=Test'));
    }


}
