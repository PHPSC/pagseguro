<?php
namespace PHPSC\PagSeguro;

use PHPSC\PagSeguro\ValueObject\Credentials;

class BaseServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Credentials
     */
    protected $credentials;

    /**
     * @var Client|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $client;

    protected function setUp()
    {
        $this->credentials = new Credentials('a@a.com', 't', 'st');
        $this->client = $this->getMock('PHPSC\PagSeguro\Http\Client', array(), array(), '', false);
    }

    /**
     * @test
     */
    public function constructMustSetSandboxAsFalse()
    {
        $service = $this->getMockForAbstractClass(
            'PHPSC\PagSeguro\BaseService',
            array($this->credentials, $this->client)
        );

        $this->assertAttributeEquals(false, 'sandbox', $service);
    }

    /**
     * @test
     */
    public function setSandboxMustChangeTheAttribute()
    {
        $service = $this->getMockForAbstractClass(
            'PHPSC\PagSeguro\BaseService',
            array($this->credentials, $this->client)
        );

        $service->setSandbox(true);

        $this->assertAttributeEquals(true, 'sandbox', $service);
    }

    /**
     * @test
     */
    public function useSandboxMustReturnAttributeValue()
    {
        $service = $this->getMockForAbstractClass(
            'PHPSC\PagSeguro\BaseService',
            array($this->credentials, $this->client)
        );

        $this->assertFalse($service->useSandbox());
    }

    /**
     * @test
     */
    public function buildUriMustReturnProdutionUriWhenNotUsingSandbox()
    {
        $service = $this->getMockForAbstractClass(
            'PHPSC\PagSeguro\BaseService',
            array($this->credentials, $this->client)
        );

        $this->assertEquals('https://ws.pagseguro.uol.com.br/1', $service->buildUri('/1'));
    }

    /**
     * @test
     */
    public function buildUriMustReturnTestUriWhenUsingSandbox()
    {
        $service = $this->getMockForAbstractClass(
            'PHPSC\PagSeguro\BaseService',
            array($this->credentials, $this->client)
        );

        $service->setSandbox(true);

        $this->assertEquals('https://ws.sandbox.pagseguro.uol.com.br/1', $service->buildUri('/1'));
    }

    /**
     * @test
     */
    public function getCredentialsMustReturnProdutionDataWhenNotUsingSandbox()
    {
        $service = $this->getMockForAbstractClass(
            'PHPSC\PagSeguro\BaseService',
            array($this->credentials, $this->client)
        );

        $this->assertEquals(array('email' => 'a@a.com', 'token' => 't'), $service->getCredentials());
    }

    /**
     * @test
     */
    public function getCredentialsMustReturnTestDataWhenUsingSandbox()
    {
        $service = $this->getMockForAbstractClass(
            'PHPSC\PagSeguro\BaseService',
            array($this->credentials, $this->client)
        );

        $service->setSandbox(true);

        $this->assertEquals(array('email' => 'a@a.com', 'token' => 'st'), $service->getCredentials());
    }
}
