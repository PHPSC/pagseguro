<?php
namespace PHPSC\PagSeguro\Test\Service;

use PHPSC\PagSeguro\Service\Credentials;

class BaseServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Client|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $client;

    protected function setUp()
    {
        $this->client = $this->getMock('PHPSC\PagSeguro\Service\Client', array(), array(), '', false);
    }

    /**
     * @test
     * @dataProvider credentials
     */
    public function isSandboxMustReturnCredentialsConfiguration(Credentials $credentials)
    {
        $service = $this->getMockForAbstractClass(
            'PHPSC\PagSeguro\Service\BaseService',
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
     * @dataProvider uris
     */
    public function buildUriMustCreateAnUriWithCredentialsAndParametersAsQueryString(
        $expectedUri,
        $resource,
        Credentials $credentials,
        array $params
    ) {
        $service = $this->getMockForAbstractClass(
            'PHPSC\PagSeguro\Service\BaseService',
            array($credentials, $this->client)
        );

        $this->assertEquals($expectedUri, $service->buildUri($resource, $params));
    }

    public function uris()
    {
        return array(
            array(
                'https://ws.pagseguro.uol.com.br/1?email=a%40a.com&token=t',
                '/1',
                new Credentials('a@a.com', 't'),
                array()
            ),
            array(
                'https://ws.sandbox.pagseguro.uol.com.br/1?email=a%40a.com&token=t',
                '/1',
                new Credentials('a@a.com', 't', true),
                array()
            ),
            array(
                'https://ws.pagseguro.uol.com.br/1?test=123&email=a%40a.com&token=t',
                '/1',
                new Credentials('a@a.com', 't'),
                array('test' => '123', 'email' => 'blabla')
            )
        );
    }
}
