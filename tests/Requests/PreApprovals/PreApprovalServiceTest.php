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
    /**
     * @test
     */
    public function createRequestBuilderShouldDoReturnObject()
    {
        $credentials = $this->createMock(Credentials::class);
        $client      = $this->createMock(Client::class);

        $service = new PreApprovalService($credentials, $client);

        $this->assertAttributeEquals($credentials, 'credentials', $service);
        $this->assertAttributeEquals($client, 'client', $service);

        $this->assertEquals(new RequestBuilder(true), $service->createRequestBuilder());
        $this->assertEquals(new RequestBuilder(false), $service->createRequestBuilder(false));
    }

    /**
     * @test
     */
    public function aproveShouldReturningTheRedirection()
    {
        $request = $this->createMock(Request::class);
        $response = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><response/>');
        $xmlSerialize = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><request/>');
        $redirect = $this->createMock(Redirection::class);

        $credentials = $this->createMock(Credentials::class);
        $client      = $this->createMock(Client::class);

        $request->expects($this->once())
                   ->method('xmlSerialize')
                   ->willReturn($xmlSerialize);

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
