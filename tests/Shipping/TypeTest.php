<?php
namespace PHPSC\PagSeguro\Shipping;

/**
 * @author Renato Moura <moura137@gmail.com>
 */
class TypeTest extends \PHPUnit_Framework_TestCase
{
    public function testGetTypesShouldDoReturnArray()
    {
        $expected = [1, 2, 3];
        $this->assertEquals($expected, Type::getTypes());
    }

    public function testValidShouldReturnTrue()
    {
        $this->assertTrue(Type::isValid(1));
        $this->assertTrue(Type::isValid(2));
        $this->assertTrue(Type::isValid(3));
    }

    public function testValuesInvalidShouldReturnFalse()
    {
        $this->assertFalse(Type::isValid(0));
        $this->assertFalse(Type::isValid(4));
    }
}
