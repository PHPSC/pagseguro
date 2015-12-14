<?php
namespace PHPSC\PagSeguro\Requests\PreApprovals;

use SimpleXMLElement;
use DateTime;
use PHPSC\PagSeguro\Customer\Customer;
use PHPSC\PagSeguro\Customer\Phone;
use PHPSC\PagSeguro\Customer\Address;

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
        $this->preApproval = $this->createMock(PreApproval::class);
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
        $customer = $this->createMock(Customer::class);
        $this->request->setCustomer($customer);

        $this->assertSame($customer, $this->request->getCustomer());
    }

    /**
     * @test
     */
    public function setCustomerToShouldChangeTheAttribute()
    {
        $customer = $this->createMock(Customer::class);
        $this->request->setCustomer($customer);

        $this->assertAttributeSame($customer, 'customer', $this->request);
    }

    public function testSerializeShouldXMLFull()
    {
        $preApproval = new PreApproval();
        $preApproval->setChargeType('auto');
        $preApproval->setName('Assinatura Revista');
        $preApproval->setPeriod('MONTHLY');
        $preApproval->setFinalDate(new DateTime('2016-11-18', new \DateTimeZone('UTC')));
        $preApproval->setMaxTotalAmount(3000);
        $preApproval->setDetails('Cobranca Mensal da Revista');
        $preApproval->setAmountPerPayment(100);
        $preApproval->setMaxAmountPerPayment(150);
        $preApproval->setInitialDate(new DateTime('2015-11-18', new \DateTimeZone('UTC')));
        $preApproval->setMaxPaymentsPerPeriod(12);
        $preApproval->setMaxAmountPerPeriod(1200);

        $customerAddress = new Address('AC', 'Sao Maite', '99500-079', 'Centro', 'Rua David Delgado', '55', 'Fundos');
        $customerPhone = new Phone('11', '99999999');
        $customer = new Customer('usuario@site.com', 'FooBar', $customerPhone, $customerAddress);

        $request = new Request($preApproval);
        $request->setCustomer($customer);
        $request->setReference('abcdef');
        $request->setReviewOn('http://localhost/return.php');
        $request->setRedirectTo('http://localhost/success.php');

        $xml = $request->xmlSerialize();

        $this->assertInstanceOf(SimpleXMLElement::class, $xml);
        $expected = simplexml_load_file(__DIR__ . '/xml/preAprovalsRequestFull.xml');
        $this->assertEquals($expected, $xml);
    }
}
