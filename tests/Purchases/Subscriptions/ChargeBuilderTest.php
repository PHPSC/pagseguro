<?php
namespace PHPSC\PagSeguro\Purchases\Subscriptions;

use PHPSC\PagSeguro\Purchases\ChargeBuilder as ChargeBuilderInterface;
use PHPSC\PagSeguro\Items\Item;
use PHPSC\PagSeguro\Items\Items;

/**
 * @author Renato Moura <moura137@gmail.com>
 */
class ChargeBuilderTest extends \PHPUnit_Framework_TestCase
{
    private $charge;

    protected function setUp()
    {
        $this->charge = $this->createMock(Charge::class);

        $this->charge->expects($this->once())
                         ->method('setSubscriptionCode')
                         ->with('123456');
    }

    public function testConstructShouldDoCallSetSubscription()
    {
        $builder = new ChargeBuilder('123456', $this->charge);

        $this->assertInstanceOf(ChargeBuilderInterface::class, $builder);
        $this->assertEquals($this->charge, $builder->getCharge());

    }

    public function testAddItemShouldDoCallAddInChargeAndReturnSelfObject()
    {
        $item = new Item(99, 'Produto 03', 1.77, 8, 12.9, 360);
        $items = $this->createMock(Items::class);
        $items->expects($this->once())->method('add')->with($item);
        $this->charge->expects($this->once())
                     ->method('getItems')
                     ->willReturn($items);

        $builder = new ChargeBuilder('123456', $this->charge);

        $this->assertEquals($builder, $builder->addItem($item));
    }

    public function testsetReferenceShouldDoCallInChargeAndReturnSelfObject()
    {
        $this->charge->expects($this->once())
                     ->method('setReference')
                     ->with('ABCDE');

        $builder = new ChargeBuilder('123456', $this->charge);

        $this->assertEquals($builder, $builder->setReference('ABCDE'));
    }
}
