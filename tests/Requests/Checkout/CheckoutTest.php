<?php
namespace PHPSC\PagSeguro\Requests\Checkout;

use PHPSC\PagSeguro\Customer\Customer;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class CheckoutTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Checkout
     */
    private $checkout;

    /**
     * @var Order
     */
    private $order;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->order = new Order();
        $this->checkout = new Checkout($this->order);
    }

    /**
     * @test
     */
    public function constructShouldConfigureAttributes()
    {
        $this->assertAttributeSame($this->order, 'order', $this->checkout);
    }

    /**
     * @test
     */
    public function constructShouldCreateANewOrderWhenItWasntInformed()
    {
        $this->assertAttributeInstanceOf(
            Order::class,
            'order',
            new Checkout()
        );
    }

    public function getOrderShouldReturnConfiguredOrder()
    {
        $this->assertSame($this->order, $this->checkout->getOrder());
    }

    /**
     * @test
     */
    public function setCustomerShouldConfigureTheReference()
    {
        $customer = new Customer('test@test.com');
        $this->checkout->setCustomer($customer);

        $this->assertAttributeSame($customer, 'customer', $this->checkout);
    }

    /**
     * @test
     */
    public function setRedirectToShouldConfigureTheRedirectionUri()
    {
        $this->checkout->setRedirectTo('http://test.com');

        $this->assertAttributeEquals('http://test.com', 'redirectTo', $this->checkout);
    }

    /**
     * @test
     */
    public function setMaxAgeShouldConfigureTheMaximumAge()
    {
        $this->checkout->setMaxAge(1);

        $this->assertAttributeEquals(1, 'maxAge', $this->checkout);
    }

    /**
     * @test
     */
    public function setMaxUsesShouldTheNumberOfUses()
    {
        $this->checkout->setMaxUses(1);

        $this->assertAttributeEquals(1, 'maxUses', $this->checkout);
    }

    /**
     * @test
     */
    public function getMaxAgeShouldReturnConfiguredMaxAge()
    {
        $this->checkout->setMaxAge(12);

        $this->assertEquals(12, $this->checkout->getMaxAge());
    }

    /**
     * @test
     */
    public function getMaxUsesShouldReturnConfiguredMaxUses()
    {
        $this->checkout->setMaxUses(7);

        $this->assertEquals(7, $this->checkout->getMaxUses());
    }

    /**
     * @test
     */
    public function getRedirectToShouldReturnConfiguredRedirectTo()
    {
        $this->checkout->setRedirectTo('someRedirect');

        $this->assertEquals('someRedirect', $this->checkout->getRedirectTo());
    }

    /**
     * @test
     */
    public function getCustomerShouldReturnConfiguredCustomer()
    {
        $customer = $this->getMock(Customer::class, [], [], '', false);
        $this->checkout->setCustomer($customer);

        $this->assertSame($customer, $this->checkout->getCustomer());
    }

    /**
     * @test
     */
    public function setNotificationURLShouldConfigureTheNotificationUri()
    {
        $uri = 'http://chibungo.com';

        $this->checkout->setNotificationURL($uri);

        $this->assertAttributeEquals($uri, 'notificationURL', $this->checkout);
    }

}
