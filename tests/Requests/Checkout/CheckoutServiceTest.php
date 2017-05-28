<?php
namespace PHPSC\PagSeguro\Requests\Checkout;

use DateTime;
use PHPSC\PagSeguro\Client\Client;
use PHPSC\PagSeguro\Credentials;
use PHPSC\PagSeguro\Environment;
use PHPSC\PagSeguro\Requests\Redirection;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class CheckoutServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Client|\PHPUnit_Framework_MockObject_MockObject
     */
    private $client;

    /**
     * @var Credentials
     */
    private $credentials;

    protected function setUp()
    {
        $environment = $this->getMockForAbstractClass(Environment::class);

        $environment->expects($this->any())
                    ->method('getHost')
                    ->willReturn('test.com');

        $environment->expects($this->any())
                    ->method('getWsHost')
                    ->willReturn('ws.test.com');

        $this->credentials = new Credentials('test@test.com', 'test', $environment);
        $this->client      = $this->createMock(Client::class);
    }

    /**
     * @test
     */
    public function checkoutShouldDoAPostRequestReturningTheRedirection()
    {
        $checkout = new Checkout();

        $wsUri = 'https://ws.test.com/v2/checkout?email=test%40test.com&token=test';
        $request = simplexml_load_string(
            '<?xml version="1.0" encoding="UTF-8"?>'
            . '<checkout><currency>BRL</currency></checkout>'
        );

        $response = simplexml_load_string(
            '<?xml version="1.0" encoding="UTF-8"?>'
            . '<checkout><code>123</code><date>2010-12-02T10:11:28.000-02:00</date></checkout>'
        );

        $this->client->expects($this->once())
                     ->method('post')
                     ->with($wsUri, $request)
                     ->willReturn($response);

        $service = new CheckoutService($this->credentials, $this->client);
        $redirection = $service->checkout($checkout);

        $redirectUri = 'https://test.com/v2/checkout/payment.html';

        $this->assertInstanceOf(Redirection::class, $redirection);
        $this->assertAttributeEquals($redirectUri, 'uri', $redirection);
        $this->assertAttributeEquals('123', 'code', $redirection);
        $this->assertAttributeEquals(new DateTime('2010-12-02T10:11:28.000-02:00'), 'date', $redirection);
    }

    /**
     * @test
     */
    public function createCheckoutBuilderShouldReturnANewBuilderInstance()
    {
        $service = new CheckoutService($this->credentials, $this->client);

        $this->assertInstanceOf(CheckoutBuilder::class, $service->createCheckoutBuilder());
    }
}
