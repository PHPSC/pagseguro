<?php
namespace PHPSC\PagSeguro;

use PHPSC\PagSeguro\Environments\Production;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class CredentialsTest extends \PHPUnit_Framework_TestCase
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
    public function constructShouldConfigureTheAttributes()
    {
        $credentials = new Credentials('contato@phpsc.com.br', 'testing', $this->environment);

        $this->assertAttributeEquals('contato@phpsc.com.br', 'email', $credentials);
        $this->assertAttributeEquals('testing', 'token', $credentials);
        $this->assertAttributeSame($this->environment, 'environment', $credentials);
    }

    /**
     * @test
     */
    public function constructShouldTruncateEmailAndToken()
    {
        $credentials = new Credentials(str_repeat('a', 80), str_repeat('a', 40), $this->environment);

        $this->assertAttributeEquals(str_repeat('a', 60), 'email', $credentials);
        $this->assertAttributeEquals(str_repeat('a', 32), 'token', $credentials);
    }

    /**
     * @test
     */
    public function constructShouldUseProductionAsDefaultEnvironment()
    {
        $credentials = new Credentials('contato@phpsc.com.br', 'testing');

        $this->assertAttributeInstanceOf(Production::class, 'environment', $credentials);
    }

    /**
     * @test
     */
    public function getUrlShouldGetTheUrlFromTheEnvironment()
    {
        $credentials = new Credentials(
            'contato@phpsc.com.br',
            'testing',
            $this->environment
        );

        $this->assertEquals('https://test.com/test', $credentials->getUrl('/test'));
    }

    /**
     * @test
     */
    public function getWsUrlShouldGetTheWsUrlFromTheEnvironmentAppendingEmailAndTokenAsGetParams()
    {
        $credentials = new Credentials(
            'contato@phpsc.com.br',
            'testing',
            $this->environment
        );

        $this->assertEquals(
            'https://ws.test.com/test?page=1&email=contato%40phpsc.com.br&token=testing',
            $credentials->getWsUrl('/test', ['page' => '1'])
        );
    }
}
