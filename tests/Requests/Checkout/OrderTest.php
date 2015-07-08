<?php

namespace PHPSC\PagSeguro\Requests\Checkout;

use PHPSC\PagSeguro\Items\ItemCollection;
use PHPSC\PagSeguro\Shipping\Shipping;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class OrderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ItemCollection
     */
    private $items;

    /**
     * @var Order
     */
    private $order;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->items = $this->getMock(ItemCollection::class);
        $this->order = new Order($this->items);
    }

    /**
     * @test
     */
    public function constructShouldConfigureItemsAndCurrency()
    {
        $this->assertAttributeSame($this->items, 'items', $this->order);
        $this->assertAttributeEquals('BRL', 'currency', $this->order);
    }

    /**
     * @test
     */
    public function constructShouldCreateAnItemCollectionWhenItWasntInformed()
    {
        $this->assertAttributeInstanceOf(ItemCollection::class, 'items', new Order());
    }

    /**
     * @test
     */
    public function getItemsShouldReturnConfiguredItemCollection()
    {
        $this->assertSame($this->items, $this->order->getItems());
    }

    /**
     * @test
     */
    public function setReferenceShouldChangeTheAttribute()
    {
        $this->order->setReference('test');

        $this->assertAttributeEquals('test', 'reference', $this->order);
    }

    /**
     * @test
     */
    public function setShippingShouldChangeTheAttribute()
    {
        $shipping = new Shipping(1);
        $this->order->setShipping($shipping);

        $this->assertAttributeSame($shipping, 'shipping', $this->order);
    }

    /**
     * @test
     */
    public function setExtraAmountShouldChangeTheAttribute()
    {
        $this->order->setExtraAmount(10);

        $this->assertAttributeEquals(10, 'extraAmount', $this->order);
    }
}
