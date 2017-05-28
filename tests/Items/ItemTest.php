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
        $this->assertAttributeSame(str_repeat('01', 51), 'id', $this->item);
        $this->assertAttributeSame(str_repeat('a very long description', 100), 'description', $this->item);
        $this->assertAttributeSame(150.23, 'amount', $this->item);
        $this->assertAttributeSame(3, 'quantity', $this->item);
        $this->assertAttributeSame(10.30, 'shippingCost', $this->item);
        $this->assertAttributeSame(123, 'weight', $this->item);
    }

    /**
     * @test
     */
    public function gettersShouldReturnTheAttributeValue()
    {
        $this->assertAttributeSame($this->item->getId(), 'id', $this->item);
        $this->assertAttributeSame($this->item->getDescription(), 'description', $this->item);
        $this->assertAttributeEquals($this->item->getAmount(), 'amount', $this->item);
        $this->assertAttributeSame($this->item->getQuantity(), 'quantity', $this->item);
        $this->assertAttributeEquals($this->item->getShippingCost(), 'shippingCost', $this->item);
        $this->assertAttributeSame($this->item->getWeight(), 'weight', $this->item);
    }

    /**
     * @test
     */
    public function xmlSerializeMustAppendFormattedItemData()
    {
        $data = simplexml_load_string('<?xml version="1.0" encoding="UTF-8"?><data />');
        $xml = $this->item->xmlSerialize($data);

        $this->assertEquals(str_repeat('01', 51), (string) $xml->item->id);
        $this->assertEquals(str_repeat('a very long description', 100), (string) $xml->item->description);
        $this->assertEquals(150.23, (string) $xml->item->amount);
        $this->assertEquals(3, (string) $xml->item->quantity);
        $this->assertEquals(10.30, (string) $xml->item->shippingCost);
        $this->assertEquals('123', (string) $xml->item->weight);
    }
}
