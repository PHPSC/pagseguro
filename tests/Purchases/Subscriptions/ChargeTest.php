<?php
namespace PHPSC\PagSeguro\Purchases\Subscriptions;

use SimpleXMLElement;
use PHPSC\PagSeguro\Items\Items;
use PHPSC\PagSeguro\Items\Item;
use PHPSC\PagSeguro\Items\ItemCollection;

/**
 * @author Adelar Tiemann Junior <adelar@adelarcubs.com>
 */
class ChargeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Charge
     */
    private $charge;

    protected function setUp()
    {
        $this->charge = new Charge();
    }

    /**
     * @test
     */
    public function constructShouldConfigureTheAttributes()
    {
        $this->assertInstanceOf(ItemCollection::class, $this->charge->getItems());
    }

    /**
     * @test
     */
    public function setReferenceShouldConfigureTheReference()
    {
        $charge = new Charge();
        $charge->setReference('SomeRef');
        
        $this->assertAttributeEquals('SomeRef', 'reference', $charge);
        $this->assertEquals('SomeRef', $charge->getReference());
    }

    /**
     * @test
     */
    public function setSubscriptionCodeShouldConfigureTheSubscriptionCode()
    {
        $charge = new Charge();
        $charge->setSubscriptionCode('SomeSubscription');
        
        $this->assertAttributeEquals('SomeSubscription', 'subscriptionCode', $charge);
        $this->assertEquals('SomeSubscription', $charge->getSubscriptionCode());
    }

    public function testSerializeShouldXMLFull()
    {
        $items = new Items;
        $items->add(new Item(99, 'Produto 03', 1.77, 8, 12.9, 360));
        $items->add(new Item(97, 'Produto 04', 43.67, 3, 134.98, 1100));

        $charge = new Charge($items);
        $charge->setSubscriptionCode(4556788);
        $charge->setReference('abcdef');

        $xml = $charge->xmlSerialize();

        $this->assertInstanceOf(SimpleXMLElement::class, $xml);
        $expected = simplexml_load_file(__DIR__.'/xml/chargeFull.xml');
        $this->assertEquals($expected, $xml);
    }
}
