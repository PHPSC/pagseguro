<?php
namespace PHPSC\PagSeguro\Items;

class ItemTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Item
     */
    protected $item;

    protected function setUp()
    {
        $this->item = new Item(
            str_repeat('01', 51),
            str_repeat('a very long description', 100),
            150.23,
            3,
            10.30,
            123
        );
    }

    /**
     * @test
     */
    public function constructorShouldConfigureTheAttributes()
    {
        $this->assertAttributeEquals(str_repeat('01', 51), 'id', $this->item);
        $this->assertAttributeEquals(str_repeat('a very long description', 100), 'description', $this->item);
        $this->assertAttributeEquals(150.23, 'amount', $this->item);
        $this->assertAttributeEquals(3, 'quantity', $this->item);
        $this->assertAttributeEquals(10.30, 'shippingCost', $this->item);
        $this->assertAttributeEquals('123', 'weight', $this->item);
    }

    /**
     * @test
     */
    public function gettersShouldReturnTheAttributeValue()
    {
        $this->assertAttributeEquals($this->item->getId(), 'id', $this->item);
        $this->assertAttributeEquals($this->item->getDescription(), 'description', $this->item);
        $this->assertAttributeEquals($this->item->getAmount(), 'amount', $this->item);
        $this->assertAttributeEquals($this->item->getQuantity(), 'quantity', $this->item);
        $this->assertAttributeEquals($this->item->getShippingCost(), 'shippingCost', $this->item);
        $this->assertAttributeEquals($this->item->getWeight(), 'weight', $this->item);
    }

    /**
     * @testAppendFormattedValuesOnAChildNode
     */
    public function xmlSerializeShouldAppendFormattedValuesOnAChildNode()
    {
        $this->markTestSkipped();

        $data = simplexml_load_string('<?xml version="1.0" encoding="UTF-8"?><data />');
        $xml = $this->item->xmlSerialize($data);

        $this->assertEquals(str_repeat('01', 50), (string) $xml->id);
        $this->assertEquals(substr(str_repeat('a very long description', 100), 0, 100), (string) $xml->description);
        $this->assertEquals('150.23', (string) $xml->amount);
        $this->assertEquals('3', (string) $xml->quantity);
        $this->assertEquals('10.30', (string) $xml->shippingCost);
        $this->assertEquals('123', (string) $xml->weight);
    }
}
