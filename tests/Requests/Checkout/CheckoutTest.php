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
            'PHPSC\PagSeguro\Requests\Checkout\Order',
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
}
