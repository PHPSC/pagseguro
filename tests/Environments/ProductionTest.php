<?php
namespace PHPSC\PagSeguro\Environments;

use PHPUnit\Framework\TestCase;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class ProductionTest extends TestCase
{
    /**
     * @test
     */
    public function getHostShouldReturnTheConstantValue()
    {
        $env = new Production();

        $this->assertEquals(Production::HOST, $env->getHost());
    }

    /**
     * @test
     */
    public function getWsHostShouldReturnTheConstantValue()
    {
        $env = new Production();

        $this->assertEquals(Production::WS_HOST, $env->getWsHost());
    }
}
