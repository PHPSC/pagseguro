<?php
namespace PHPSC\PagSeguro\Requests\PreApprovals;

/**
 * @author Renato Moura <moura137@gmail.com>
 */
class ChargeTypeTest extends \PHPUnit_Framework_TestCase
{
    public function testValidShouldReturnTrue()
    {
        $this->assertTrue(ChargeType::isValid('auto'));
        $this->assertTrue(ChargeType::isValid('manual'));
    }

    public function testValuesInvalidShouldReturnFalse()
    {
        $this->assertFalse(ChargeType::isValid('AUTO'));
        $this->assertFalse(ChargeType::isValid('other'));
    }
}
