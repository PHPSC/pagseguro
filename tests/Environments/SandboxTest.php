<?php
namespace PHPSC\PagSeguro\Environments;

use PHPUnit\Framework\TestCase;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class SandboxTest extends TestCase
{
    /**
     * @test
     */
    public function getHostShouldReturnTheConstantValue()
    {
        $env = new Sandbox();

        $this->assertEquals(Sandbox::HOST, $env->getHost());
    }

    /**
     * @test
     */
    public function getWsHostShouldReturnTheConstantValue()
    {
        $env = new Sandbox();

        $this->assertEquals(Sandbox::WS_HOST, $env->getWsHost());
    }
}
