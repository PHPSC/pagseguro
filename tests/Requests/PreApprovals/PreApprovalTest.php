<?php
namespace PHPSC\PagSeguro\Requests\PreApprovals;

use DateTime;

/**
 * @author Renato Moura <moura137@gmail.com>
 */
class PreApprovalTest extends \PHPUnit_Framework_TestCase
{
    public function testAttributesShouldValuesEmpty()
    {
        $preApproval = new PreApproval;

        $this->assertAttributeEmpty('name', $preApproval);
        $this->assertAttributeEmpty('chargeType', $preApproval);
        $this->assertAttributeEmpty('details', $preApproval);
        $this->assertAttributeEmpty('period', $preApproval);
        $this->assertAttributeEmpty('finalDate', $preApproval);
        $this->assertAttributeEmpty('maxTotalAmount', $preApproval);
        $this->assertAttributeEmpty('amountPerPayment', $preApproval);
        $this->assertAttributeEmpty('maxAmountPerPayment', $preApproval);
        $this->assertAttributeEmpty('maxPaymentsPerPeriod', $preApproval);
        $this->assertAttributeEmpty('maxAmountPerPeriod', $preApproval);
        $this->assertAttributeEmpty('initialDate', $preApproval);
    }

    public function testSetChargeTypeShouldThrowInvalidArgumentException()
    {
        $this->setExpectedException('InvalidArgumentException', 'You should inform a valid charge type');

        $preApproval = new PreApproval;
        $preApproval->setChargeType('other');
    }

    public function testSetPeriodShouldThrowInvalidArgumentException()
    {
        $this->setExpectedException('InvalidArgumentException', 'You should inform a valid period');

        $preApproval = new PreApproval;
        $preApproval->setPeriod('other');
    }

    public function testSettersAndGettersAttributes()
    {
        $preApproval = new PreApproval;

        $preApproval->setName('Name Assinatura');
        $preApproval->setChargeType('auto');
        $preApproval->setDetails('Cobranca Mensal');
        $preApproval->setPeriod('MONTHLY');
        $preApproval->setFinalDate(new DateTime('2016-11-18'));
        $preApproval->setMaxTotalAmount(3000.50);
        $preApproval->setAmountPerPayment(100.50);
        $preApproval->setMaxAmountPerPayment(150.50);
        $preApproval->setMaxPaymentsPerPeriod(12);
        $preApproval->setMaxAmountPerPeriod(1200.50);
        $preApproval->setInitialDate(new DateTime('2015-11-18'));

        $this->assertAttributeEquals('Name Assinatura', 'name', $preApproval);
        $this->assertAttributeEquals('auto', 'chargeType', $preApproval);
        $this->assertAttributeEquals('Cobranca Mensal', 'details', $preApproval);
        $this->assertAttributeEquals('MONTHLY', 'period', $preApproval);
        $this->assertAttributeEquals(new DateTime('2016-11-18'), 'finalDate', $preApproval);
        $this->assertAttributeSame(3000.50, 'maxTotalAmount', $preApproval);
        $this->assertAttributeSame(100.50, 'amountPerPayment', $preApproval);
        $this->assertAttributeSame(150.50, 'maxAmountPerPayment', $preApproval);
        $this->assertAttributeSame(12, 'maxPaymentsPerPeriod', $preApproval);
        $this->assertAttributeSame(1200.50, 'maxAmountPerPeriod', $preApproval);
        $this->assertAttributeEquals(new DateTime('2015-11-18'), 'initialDate', $preApproval);

        $this->assertEquals('Name Assinatura', $preApproval->getName());
        $this->assertEquals('auto', $preApproval->getChargeType());
        $this->assertEquals('Cobranca Mensal', $preApproval->getDetails());
        $this->assertEquals('MONTHLY', $preApproval->getPeriod());
        $this->assertEquals(new DateTime('2016-11-18'), $preApproval->getFinalDate());
        $this->assertSame('3000.50', $preApproval->getMaxTotalAmount());
        $this->assertSame('100.50', $preApproval->getAmountPerPayment());
        $this->assertSame('150.50', $preApproval->getMaxAmountPerPayment());
        $this->assertSame(12, $preApproval->getMaxPaymentsPerPeriod());
        $this->assertSame('1200.50', $preApproval->getMaxAmountPerPeriod());
        $this->assertEquals(new DateTime('2015-11-18'), $preApproval->getInitialDate());
    }
}
