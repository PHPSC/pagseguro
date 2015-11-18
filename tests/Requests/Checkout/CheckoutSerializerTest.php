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
 * @author Renato Moura <moura137@gmail.com>
 */
class CheckoutSerializerTest extends \PHPUnit_Framework_TestCase
{
    public function testSerializeShouldXMLEmpty()
    {
        $serializer = new CheckoutSerializer;
        $xml = $serializer->serialize(new Checkout);

        $this->assertInstanceOf(SimpleXMLElement::class, $xml);

        $expected = simplexml_load_file(__DIR__.'/xml/checkoutEmpty.xml');
        $this->assertEquals($expected, $xml);
    }

    /**
     * @test
     */
    public function testSerializeShouldReturnXMLCustomer()
    {
        $customer = new Customer('usuario@site.com');

        $checkout = new Checkout;
        $checkout->setCustomer($customer);

        $serializer = new CheckoutSerializer;
        $xml = $serializer->serialize($checkout);

        $this->assertInstanceOf(SimpleXMLElement::class, $xml);
        $expected = simplexml_load_file(__DIR__.'/xml/checkoutCustomer.xml');
        $this->assertEquals($expected, $xml);
    }

    /**
     * @test
     */
    public function testSerializeShouldReturnXMLFull()
    {
        $items = new Items;
        $items->add(new Item(77, 'Produto 01', 2.5, 4, 20, 300));
        $items->add(new Item(88, 'Produto 02', 342.51, 3, 134.98, 1000));

        $shippingAddress = new Address('CE', 'Ortega do Norte', '40610-912', 'Ipe', 'R. Regina Salas', '3601', 'Bl.A');
        $shipping = new Shipping(1, $shippingAddress, 23.45);

        $order = new Order($items);
        $order->setReference('REF1234');
        $order->setExtraAmount(1.01);
        $order->setShipping($shipping);

        $customerAddress = new Address('AC', 'Sao Maite', '99500-079', 'Centro', 'Rua David Delgado', '55', 'Fundos');
        $customerPhone = new Phone('11', '99999999');
        $customer = new Customer('usuario@site.com', 'FooBar', $customerPhone, $customerAddress);

        $checkout = new Checkout($order);
        $checkout->setCustomer($customer);
        $checkout->setRedirectTo('http://localhost/return.php');
        $checkout->setMaxUses(5);
        $checkout->setMaxAge(60);

        $serializer = new CheckoutSerializer;
        $xml = $serializer->serialize($checkout);

        $this->assertInstanceOf(SimpleXMLElement::class, $xml);
        $expected = simplexml_load_file(__DIR__.'/xml/checkoutFull.xml');
        $this->assertEquals($expected, $xml);
    }
}
