<?php
namespace PHPSC\PagSeguro\Items;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @author Renato Moura <moura137@gmail.com>
 */
class ItemsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function constructorShouldInstanceOf()
    {
        $items = new Items;

        $this->assertInstanceOf(ArrayCollection::class, $items);
        $this->assertInstanceOf(ItemCollection::class, $items);
    }
}
