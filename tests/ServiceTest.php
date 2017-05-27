<?php
namespace PHPSC\PagSeguro;

use PHPSC\PagSeguro\Client\Client;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class ServiceTest extends \PHPUnit_Framework_TestCase
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
        $this->credentials = new Credentials('a@a.com', 't');
        $this->client = $this->createMock(Client::class);
    }

    /**
     * @test
     */
    public function constructorShouldConfigureAttributes()
    {
        $service = $this->getMockForAbstractClass(
            Service::class,
            [$this->credentials, $this->client]
        );

        $this->assertAttributeSame($this->credentials, 'credentials', $service);
        $this->assertAttributeSame($this->client, 'client', $service);
    }

    /**
     * @test
     */
    public function constructorShouldCreateAClientWhenItWasntInformed()
    {
        $service = $this->getMockForAbstractClass(
            Service::class,
            [$this->credentials]
        );

        $this->assertAttributeInstanceOf(Client::class, 'client', $service);
    }
}
