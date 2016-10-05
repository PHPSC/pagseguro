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
    /**
     * @var PreApproval|\PHPUnit_Framework_MockObject_MockObject
     */
    private $approval;

    protected function setUp()
    {
        $this->approval = $this->createMock(PreApproval::class);

        $this->approval->expects($this->once())
                       ->method('setChargeType')
                       ->with(ChargeType::AUTOMATIC);

        $this->mockRequest = $this->createMock(Request::class);
    }

    public function testContructShouldSetterChargeTypeAndInstanceofInterface()
    {
        $this->mockRequest->expects($this->once())->method('getPreApproval')->willReturn($this->approval);

        $builder = new RequestBuilder(false, $this->mockRequest);

        $this->assertInstanceOf(RequestBuilderInterface::class, $builder);
        $this->assertAttributeEquals($this->mockRequest, 'request', $builder);
        $this->assertEquals($this->mockRequest, $builder->getRequest());
    }

    public function testSetterRequestShouldReturnSelfObject()
    {
        $customer = $this->createMock(Customer::class);

        $this->mockRequest->expects($this->once())->method('getPreApproval')->willReturn($this->approval);
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
        $this->mockRequest->expects($this->exactly(11))->method('getPreApproval')->willReturn($this->approval);

        $this->approval->expects($this->once())->method('setName')->with('FooBar');
        $this->approval->expects($this->once())->method('setDetails')->with('Details Foo Bar');
        $this->approval->expects($this->once())->method('setFinalDate')->with(new DateTime('2016-11-18'));
        $this->approval->expects($this->once())->method('setMaxTotalAmount')->with(2000);
        $this->approval->expects($this->once())->method('setPeriod')->with('WEEKLY');
        $this->approval->expects($this->once())->method('setAmountPerPayment')->with(123.56);
        $this->approval->expects($this->once())->method('setMaxAmountPerPayment')->with(97);
        $this->approval->expects($this->once())->method('setMaxPaymentsPerPeriod')->with(544.87);
        $this->approval->expects($this->once())->method('setMaxAmountPerPeriod')->with(5432.90);
        $this->approval->expects($this->once())->method('setInitialDate')->with(new DateTime('2015-11-18'));

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
