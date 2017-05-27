<?php
namespace PHPSC\PagSeguro\Requests\PreApprovals;

use PHPSC\PagSeguro\Client\Client;
use PHPSC\PagSeguro\Credentials;
use PHPSC\PagSeguro\Requests\Redirection;
use SimpleXMLElement;

/**
 * @author Renato Moura <moura137@gmail.com>
 */
class PreApprovalServiceTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateRequestBuilderShouldDoReturnObject()
    {
        $credentials = $this->createMock(Credentials::class);
        $client      = $this->createMock(Client::class);
        $serializer  = $this->createMock(RequestSerializer::class);

        $service = new PreApprovalService($credentials, $client, $serializer);

        $this->assertAttributeEquals($serializer, 'serializer', $service);
        $this->assertAttributeEquals($credentials, 'credentials', $service);
        $this->assertAttributeEquals($client, 'client', $service);

        $this->assertEquals(new RequestBuilder(true), $service->createRequestBuilder());
        $this->assertEquals(new RequestBuilder(false), $service->createRequestBuilder(false));
    }

    public function testAproveShouldReturningTheRedirection()
    {
        $request = new Request;
        $response = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><response/>');
        $xmlSerialize = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><request/>');
        $redirect = $this->createMock(Redirection::class);

        $credentials = $this->createMock(Credentials::class);
        $client      = $this->createMock(Client::class);
        $serializer  = $this->createMock(RequestSerializer::class);

        $serializer->expects($this->once())
                   ->method('serialize')
                   ->willReturn($xmlSerialize);

        $service = $this->getMockBuilder(PreApprovalService::class)
                        ->setMethods(['post', 'getRedirection'])
                        ->setConstructorArgs([$credentials, $client, $serializer])
                        ->disableOriginalClone()
                        ->getMock();

        $service->expects($this->once())
                ->method('post')
                ->with(PreApprovalService::ENDPOINT, $xmlSerialize)
                ->willReturn($response);

        $service->expects($this->once())
            ->method('getRedirection')
            ->with($response)
            ->willReturn($redirect);

        $this->assertEquals($redirect, $service->approve($request));
    }
}
