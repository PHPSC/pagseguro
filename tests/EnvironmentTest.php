<?php
namespace PHPSC\PagSeguro;

use PHPSC\PagSeguro\Environments\Production;
use PHPSC\PagSeguro\Environments\Sandbox;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class EnvironmentTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Environment
     */
    private $environment;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->environment = $this->getMockForAbstractClass(Environment::class);

        $this->environment->expects($this->any())
                          ->method('getHost')
                          ->willReturn('test.com');

        $this->environment->expects($this->any())
                          ->method('getWsHost')
                          ->willReturn('ws.test.com');
    }

    /**
     * @test
     */
    public function isValidShouldReturnTrueWhenHostIsProduction()
    {
        $this->assertTrue(Environment::isValid(Production::WS_HOST));
    }

    /**
     * @test
     */
    public function isValidShouldReturnFalseWhenHostIsSandbox()
    {
        $this->assertTrue(Environment::isValid(Sandbox::WS_HOST));
    }

    /**
     * @test
     */
    public function isValidShouldReturnFalseWhenHostNotProductionOrSandbox()
    {
        $this->assertFalse(Environment::isValid('example.org'));
    }

    /**
     * @test
     */
    public function getWsUrlShouldAppendProtocolAndWsHostToResource()
    {
        $this->assertEquals('https://ws.test.com/test', $this->environment->getWsUrl('/test'));
    }

    /**
     * @test
     */
    public function getUrlShouldAppendProtocolAndHostToResource()
    {
        $this->assertEquals('https://test.com/test', $this->environment->getUrl('/test'));
    }
}
