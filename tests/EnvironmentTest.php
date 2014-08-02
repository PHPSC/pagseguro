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
     * @param string $host
     *
     * @return Environment
     */
    protected function createEnvironment($host)
    {
        $environment = $this->getMockForAbstractClass('PHPSC\PagSeguro\Environment');

        $environment->expects($this->any())
                    ->method('getHost')
                    ->willReturn($host);

        $environment->expects($this->any())
                    ->method('getWsHost')
                    ->willReturn('ws.' . $host);

        return $environment;
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
        $environment = $this->createEnvironment('test.com');

        $this->assertEquals('https://ws.test.com/test', $environment->getWsUrl('/test'));
    }

    /**
     * @test
     */
    public function getUrlShouldAppendProtocolAndHostToResource()
    {
        $environment = $this->createEnvironment('test.com');

        $this->assertEquals('https://test.com/test', $environment->getUrl('/test'));
    }
}
