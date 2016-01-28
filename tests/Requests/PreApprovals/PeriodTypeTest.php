<?php
namespace PHPSC\PagSeguro\Requests\PreApprovals;

/**
 * @author Renato Moura <moura137@gmail.com>
 */
class PeriodTest extends \PHPUnit_Framework_TestCase
{
    public function testValidShouldReturnTrue()
    {
        $this->assertTrue(Period::isValid('WEEKLY'));
        $this->assertTrue(Period::isValid('MONTHLY'));
        $this->assertTrue(Period::isValid('BIMONTHLY'));
        $this->assertTrue(Period::isValid('TRIMONTHLY'));
        $this->assertTrue(Period::isValid('SEMIANNUALLY'));
        $this->assertTrue(Period::isValid('YEARLY'));
    }

    public function testValuesInvalidShouldReturnFalse()
    {
        $this->assertFalse(Period::isValid('Weekly'));
        $this->assertFalse(Period::isValid('other'));
    }
}
