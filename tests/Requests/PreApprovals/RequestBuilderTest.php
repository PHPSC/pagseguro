<?php
namespace PHPSC\PagSeguro\Requests\PreApprovals;

use DateTime;
use PHPSC\PagSeguro\Customer\Customer;
use PHPSC\PagSeguro\Requests\RequestBuilder as RequestBuilderInterface;

/**
 * @author Renato Moura <moura137@gmail.com>
 */
class RequestBuilderTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        $this->mockApproval = $this->getMock(preApproval::class, [], [], '', false);
        $this->mockApproval->expects($this->once())->method('setChargeType')->with(ChargeType::AUTOMATIC);

        $this->mockRequest = $this->getMock(Request::class, [], [], '', false);
    }

    public function testContructShouldSetterChargeTypeAndInstanceofInterface()
    {
        $this->mockRequest->expects($this->once())->method('getPreApproval')->willReturn($this->mockApproval);

        $builder = new RequestBuilder(false, $this->mockRequest);

        $this->assertInstanceOf(RequestBuilderInterface::class, $builder);
        $this->assertAttributeEquals($this->mockRequest, 'request', $builder);
        $this->assertEquals($this->mockRequest, $builder->getRequest());
    }

    public function testSetterRequestShouldReturnSelfObject()
    {
        $this->mockRequest->expects($this->once())->method('getPreApproval')->willReturn($this->mockApproval);

        $customer = $this->getMock(Customer::class, [], [], '', false);
        $this->mockRequest->expects($this->once())->method('setCustomer')->with($customer);
        $this->mockRequest->expects($this->once())->method('setRedirectTo')->with('http://redirect');
        $this->mockRequest->expects($this->once())->method('setReference')->with('ABCDEF');
        $this->mockRequest->expects($this->once())->method('setReviewOn')->with('http://review');

        $builder = new RequestBuilder(false, $this->mockRequest);

        $this->assertEquals($builder, $builder->setCustomer($customer));
        $this->assertEquals($builder, $builder->setRedirectTo('http://redirect'));
        $this->assertEquals($builder, $builder->setReference('ABCDEF'));
        $this->assertEquals($builder, $builder->setReviewOn('http://review'));
    }

    public function testSetterPreApprovalShouldReturnSelfObject()
    {
        $this->mockRequest->expects($this->exactly(11))->method('getPreApproval')->willReturn($this->mockApproval);

        $this->mockApproval->expects($this->once())->method('setName')->with('FooBar');
        $this->mockApproval->expects($this->once())->method('setDetails')->with('Details Foo Bar');
        $this->mockApproval->expects($this->once())->method('setFinalDate')->with(new DateTime('2016-11-18'));
        $this->mockApproval->expects($this->once())->method('setMaxTotalAmount')->with(2000);
        $this->mockApproval->expects($this->once())->method('setPeriod')->with('WEEKLY');
        $this->mockApproval->expects($this->once())->method('setAmountPerPayment')->with(123.56);
        $this->mockApproval->expects($this->once())->method('setMaxAmountPerPayment')->with(97);
        $this->mockApproval->expects($this->once())->method('setMaxPaymentsPerPeriod')->with(544.87);
        $this->mockApproval->expects($this->once())->method('setMaxAmountPerPeriod')->with(5432.90);
        $this->mockApproval->expects($this->once())->method('setInitialDate')->with(new DateTime('2015-11-18'));

        $builder = new RequestBuilder(false, $this->mockRequest);

        $this->assertEquals($builder, $builder->setName('FooBar'));
        $this->assertEquals($builder, $builder->setDetails('Details Foo Bar'));
        $this->assertEquals($builder, $builder->setFinalDate(new DateTime('2016-11-18')));
        $this->assertEquals($builder, $builder->setMaxTotalAmount(2000));
        $this->assertEquals($builder, $builder->setPeriod('WEEKLY'));
        $this->assertEquals($builder, $builder->setAmountPerPayment(123.56));
        $this->assertEquals($builder, $builder->setMaxAmountPerPayment(97));
        $this->assertEquals($builder, $builder->setMaxPaymentsPerPeriod(544.87));
        $this->assertEquals($builder, $builder->setMaxAmountPerPeriod(5432.90));
        $this->assertEquals($builder, $builder->setInitialDate(new DateTime('2015-11-18')));
    }
}
