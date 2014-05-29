<?php
namespace PHPSC\PagSeguro;

use PHPSC\PagSeguro\Credentials;

class BaseServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Client|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $client;

    protected function setUp()
    {
        $this->client = $this->getMock('PHPSC\PagSeguro\Client', array(), array(), '', false);
    }

    /**
     * @test
     * @dataProvider credentials
     */
    public function isSandboxMustReturnCredentialsConfiguration(Credentials $credentials)
    {
        $service = $this->getMockForAbstractClass(
            'PHPSC\PagSeguro\BaseService',
            array($credentials, $this->client)
        );

        $this->assertEquals($credentials->isSandbox(), $service->isSandbox());
    }

    public function credentials()
    {
        return array(
            array(new Credentials('a@a.com', 't')),
            array(new Credentials('a@a.com', 't', true))
        );
    }

    /**
     * @test
     */
    public function buildUriMustReturnProdutionUriWhenNotUsingSandbox()
    {
        $service = $this->getMockForAbstractClass(
            'PHPSC\PagSeguro\BaseService',
            array(new Credentials('a@a.com', 't'), $this->client)
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
            array(new Credentials('a@a.com', 't', true), $this->client)
        );

        $this->assertEquals('https://ws.sandbox.pagseguro.uol.com.br/1', $service->buildUri('/1'));
    }

    /**
     * @test
     */
    public function getCredentialsMustReturnAnArrayWithCredentialsData()
    {
        $service = $this->getMockForAbstractClass(
            'PHPSC\PagSeguro\BaseService',
            array(new Credentials('a@a.com', 't'), $this->client)
        );

        $this->assertEquals(array('email' => 'a@a.com', 'token' => 't'), $service->getCredentials());
    }
}
