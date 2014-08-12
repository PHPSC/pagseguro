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
    protected $client;

    /**
     * @var Credentials
     */
    protected $credentials;

    /**
     * @var CheckoutSerializer|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $serializer;

    protected function setUp()
    {
        $environment = $this->getMockForAbstractClass(Environment::class);

        $environment->expects($this->any())
                    ->method('getHost')
                    ->willReturn('test.com');

        $environment->expects($this->any())
                    ->method('getWsHost')
                    ->willReturn('ws.test.com');

        $this->client = $this->getMock(Client::class, [], [], '', false);
        $this->credentials = new Credentials('test@test.com', 'test', $environment);

        $this->serializer = $this->getMock(
            CheckoutSerializer::class,
            [],
            [],
            '',
            false
        );
    }

    /**
     * @test
     */
    public function checkoutShouldDoAPostRequestReturningTheRedirection()
    {
        $checkout = $this->getMock(Checkout::class, [], [], '', false);

        $wsUri = 'https://ws.test.com/v2/checkout?email=test%40test.com&token=test';
        $request = simplexml_load_string('<?xml version="1.0" encoding="UTF-8"?><checkout />');

        $response = simplexml_load_string(
            '<?xml version="1.0" encoding="UTF-8"?>'
            . '<checkout><code>123</code><date>2010-12-02T10:11:28.000-02:00</date></checkout>'
        );

        $this->serializer->expects($this->once())
                         ->method('serialize')
                         ->with($checkout)
                         ->willReturn($request);

        $this->client->expects($this->once())
                     ->method('post')
                     ->with($wsUri, $request)
                     ->willReturn($response);

        $service = new CheckoutService($this->credentials, $this->client, $this->serializer);
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
        $service = new CheckoutService($this->credentials, $this->client, $this->serializer);

        $this->assertInstanceOf(CheckoutBuilder::class, $service->createCheckoutBuilder());
    }
}
