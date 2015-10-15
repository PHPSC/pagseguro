<?php
namespace PHPSC\PagSeguro\Requests\PreApprovals;

use PHPSC\PagSeguro\Customer\Customer;

/**
 * @author Adelar Tiemann Junior <adelar@adelarcubs.com>
 */
class RequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Request
     */
    private $request;
    
    /**
     * @var PreApproval
     */
    private $preApproval;

    protected function setUp()
    {
        $this->preApproval = $this->getMock(PreApproval::class, [], [], '', false);
        $this->request = new Request($this->preApproval);
    }

    /**
     * @test
     */
    public function constructShouldConfigureTheAttributes()
    {
        $this->assertAttributeInstanceOf(PreApproval::class, 'preApproval', $this->request);
    }

    /**
     * @test
     */
    public function getPreApprovalShouldReturnConfiguredPreApproval()
    {
        $this->assertInstanceOf(PreApproval::class, $this->request->getPreApproval());
    }

    /**
     * @test
     */
    public function getReferenceShouldReturnConfiguredReference()
    {
        $this->request->setReference('someRef');
        
        $this->assertEquals('someRef', $this->request->getReference());
    }

    /**
     * @test
     */
    public function setReferenceShouldChangeTheAttribute()
    {
        $this->request->setReference('test');
        
        $this->assertAttributeEquals('test', 'reference', $this->request);
    }

    /**
     * @test
     */
    public function getRedirectToShouldReturnConfiguredRedirectTo()
    {
        $this->request->setRedirectTo('someRedirect');
        
        $this->assertEquals('someRedirect', $this->request->getRedirectTo());
    }

    /**
     * @test
     */
    public function setRedirectToShouldChangeTheAttribute()
    {
        $this->request->setRedirectTo('otherRedirect');
        
        $this->assertAttributeEquals('otherRedirect', 'redirectTo', $this->request);
    }

    /**
     * @test
     */
    public function getReviewOnShouldReturnConfiguredReviewOn()
    {
        $this->request->setReviewOn('someReview');
        
        $this->assertEquals('someReview', $this->request->getReviewOn());
    }

    /**
     * @test
     */
    public function setReviewOnToShouldChangeTheAttribute()
    {
        $this->request->setReviewOn('otherReview');
        
        $this->assertAttributeEquals('otherReview', 'reviewOn', $this->request);
    }

    /**
     * @test
     */
    public function getCustomerShouldReturnConfiguredCustomer()
    {
        $customer = $this->getMock(Customer::class, [], [], '', false);
        $this->request->setCustomer($customer);
        
        $this->assertSame($customer, $this->request->getCustomer());
    }

    /**
     * @test
     */
    public function setCustomerToShouldChangeTheAttribute()
    {
        $customer = $this->getMock(Customer::class, [], [], '', false);
        $this->request->setCustomer($customer);
        
        $this->assertAttributeSame($customer, 'customer', $this->request);
    }
}
