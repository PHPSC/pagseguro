<?php

namespace PHPSC\PagSeguro\Requests\Checkout;

use SimpleXMLElement;
use PHPSC\PagSeguro\Items\Items;
use PHPSC\PagSeguro\Items\Item;
use PHPSC\PagSeguro\Shipping\Shipping;
use PHPSC\PagSeguro\Customer\Customer;
use PHPSC\PagSeguro\Customer\Phone;
use PHPSC\PagSeguro\Customer\Address;

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
        $this->order    = new Order();
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
        $customer = $this->createMock(Customer::class);
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

    /**
     * @test
     */
    public function serializeShouldXMLEmpty()
    {
        $checkout = new Checkout;
        $xml      = $checkout->xmlSerialize();

        $this->assertInstanceOf(SimpleXMLElement::class, $xml);

        $expected = simplexml_load_file(__DIR__.'/xml/checkoutEmpty.xml');
        $this->assertEquals($expected, $xml);
    }

    /**
     * @test
     */
    public function serializeShouldReturnXMLCustomer()
    {
        $customer = new Customer('usuario@site.com');
        $checkout = new Checkout;
        $checkout->setCustomer($customer);

        $xml = $checkout->xmlSerialize();

        $this->assertInstanceOf(SimpleXMLElement::class, $xml);
        $expected = simplexml_load_file(__DIR__.'/xml/checkoutCustomer.xml');
        $this->assertEquals($expected, $xml);
    }

    /**
     * @test
     */
    public function serializeShouldReturnXMLFull()
    {
        $items = new Items;
        $items->add(new Item(77, 'Produto 01', 2.5, 4, 20, 300));
        $items->add(new Item(88, 'Produto 02', 342.51, 3, 134.98, 1000));

        $shippingAddress = new Address('CE', 'Ortega do Norte', '40610-912', 'Ipe', 'R. Regina Salas', '3601', 'Bl.A');
        $shipping        = new Shipping(1, $shippingAddress, 23.45);

        $order = new Order($items);
        $order->setReference('REF1234');
        $order->setExtraAmount(-10.30);
        $order->setShipping($shipping);

        $customerAddress = new Address('AC', 'Sao Maite', '99500-079', 'Centro', 'Rua David Delgado', '55', 'Fundos');
        $customerPhone   = new Phone('11', '99999999');
        $customer        = new Customer('usuario@site.com', 'FooBar', $customerPhone, $customerAddress);

        $checkout = new Checkout($order);
        $checkout->setCustomer($customer);
        $checkout->setRedirectTo('http://localhost/return.php');
        $checkout->setMaxUses(5);
        $checkout->setMaxAge(60);

        $xml = $checkout->xmlSerialize();

        $this->assertInstanceOf(SimpleXMLElement::class, $xml);
        $expected = simplexml_load_file(__DIR__ . '/xml/checkoutFull.xml');
        $this->assertEquals($expected, $xml);
    }
}
