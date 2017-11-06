<?php
namespace PHPSC\PagSeguro\Items;

use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;

/**
 * @author Renato Moura <moura137@gmail.com>
 */
class ItemsTest extends TestCase
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
