<?php
namespace PHPSC\PagSeguro\Requests\Checkout;

use PHPSC\PagSeguro\Customer\Customer;
use PHPSC\PagSeguro\Items\Item;
use PHPSC\PagSeguro\Shipping\Shipping;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class CheckoutBuilderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Checkout
     */
    private $checkout;

    /**
     * @var CheckoutBuilder
     */
    private $builder;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->checkout = new Checkout();
        $this->builder = new CheckoutBuilder($this->checkout);
    }

    /**
     * @test
     */
    public function constructShouldConfigureAttributes()
    {
        $this->assertAttributeSame($this->checkout, 'checkout', $this->builder);
    }

    /**
     * @test
     */
    public function constructShouldCreateANewCheckoutWhenItWasntInformed()
    {
        $this->assertAttributeInstanceOf(
            Checkout::class,
            'checkout',
            new CheckoutBuilder()
        );
    }

    /**
     * @test
     */
    public function addItemShouldAppendTheGivenItem()
    {
        $item = new Item(1, 'testing', 10);
        $this->builder->addItem($item);

        $this->assertTrue($this->checkout->getOrder()->getItems()->contains($item));
    }

    /**
     * @test
     */
    public function setShippingShouldConfigureTheShipping()
    {
        $shipping = new Shipping(1);
        $this->builder->setShipping($shipping);

        $this->assertAttributeSame($shipping, 'shipping', $this->checkout->getOrder());
    }

    /**
     * @test
     */
    public function setReferenceShouldConfigureTheReference()
    {
        $this->builder->setReference('testing');

        $this->assertAttributeEquals('testing', 'reference', $this->checkout->getOrder());
    }

    /**
     * @test
     */
    public function setCustomerShouldConfigureTheReference()
    {
        $customer = new Customer('test@test.com');
        $this->builder->setCustomer($customer);

        $this->assertAttributeSame($customer, 'customer', $this->checkout);
    }

    /**
     * @test
     */
    public function setRedirectToShouldConfigureTheRedirectionUri()
    {
        $this->builder->setRedirectTo('http://test.com');

        $this->assertAttributeEquals('http://test.com', 'redirectTo', $this->checkout);
    }

    /**
     * @test
     */
    public function setMaxAgeShouldConfigureTheMaximumAge()
    {
        $this->builder->setMaxAge(1);

        $this->assertAttributeEquals(1, 'maxAge', $this->checkout);
    }

    /**
     * @test
     */
    public function setMaxUsesShouldTheNumberOfUses()
    {
        $this->builder->setMaxUses(1);

        $this->assertAttributeEquals(1, 'maxUses', $this->checkout);
    }

    /**
     * @test
     */
    public function getCheckoutShouldReturnTheConfiguredCheckout()
    {
        $this->assertSame($this->checkout, $this->builder->getCheckout());
    }
}
