<?php
namespace PHPSC\PagSeguro\Purchases\Subscriptions;

use SimpleXMLElement;
use PHPSC\PagSeguro\Items\Items;
use PHPSC\PagSeguro\Items\Item;

/**
 * @author Renato Moura <moura137@gmail.com>
 */
class ChargeSerializerTest extends \PHPUnit_Framework_TestCase
{
    public function testSerializeShouldXMLFull()
    {
        $items = new Items;
        $items->add(new Item(99, 'Produto 03', 1.77, 8, 12.9, 360));
        $items->add(new Item(97, 'Produto 04', 43.67, 3, 134.98, 1100));

        $charge = new Charge($items);
        $charge->setSubscriptionCode(4556788);
        $charge->setReference('abcdef');

        $serializer = new ChargeSerializer;
        $xml = $serializer->serialize($charge);

        $this->assertInstanceOf(SimpleXMLElement::class, $xml);
        $expected = simplexml_load_file(__DIR__.'/xml/chargeFull.xml');
        $this->assertEquals($expected, $xml);
    }
}
