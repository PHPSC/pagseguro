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
        $credentials = $this->getMock(Credentials::class, [], [], '', false);
        $client = $this->getMock(Client::class, [], [], '', false);

        $service = new PreApprovalService($credentials, $client);

        $this->assertAttributeEquals($credentials, 'credentials', $service);
        $this->assertAttributeEquals($client, 'client', $service);

        $this->assertEquals(new RequestBuilder(true), $service->createRequestBuilder());
        $this->assertEquals(new RequestBuilder(false), $service->createRequestBuilder(false));
    }

    public function testAproveShouldReturningTheRedirection()
    {
        $request = $this->getMock(Request::class, [], [], '', false);
        $response = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><response/>');
        $redirect = $this->getMock(Redirection::class, [], [], '', false);
        $xmlSerialize = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><request/>');

        $credentials = $this->getMock(Credentials::class, [], [], '', false);
        $client = $this->getMock(Client::class, [], [], '', false);

        $request->expects($this->once())->method('xmlSerialize')->willReturn($xmlSerialize);

        $service = $this->getMockBuilder(PreApprovalService::class)
            ->setMethods(['post', 'getRedirection'])
            ->setConstructorArgs([$credentials, $client])
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
