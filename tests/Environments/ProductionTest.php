<?php
namespace PHPSC\PagSeguro\Environments;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class ProductionTest extends \PHPUnit_Framework_TestCase
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
