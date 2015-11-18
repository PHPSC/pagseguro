<?php
namespace PHPSC\PagSeguro\Requests\PreApprovals;

use SimpleXMLElement;
use DateTime;
use PHPSC\PagSeguro\Customer\Customer;
use PHPSC\PagSeguro\Customer\Phone;
use PHPSC\PagSeguro\Customer\Address;

/**
 * @author Renato Moura <moura137@gmail.com>
 */
class RequestSerializerTest extends \PHPUnit_Framework_TestCase
{
    public function testSerializeShouldXMLFull()
    {
        $preApproval = new PreApproval;
        $preApproval->setChargeType('auto');
        $preApproval->setName('Assinatura Revista');
        $preApproval->setPeriod('MONTHLY');
        $preApproval->setFinalDate(new DateTime('2016-11-18'));
        $preApproval->setMaxTotalAmount(3000);
        $preApproval->setDetails('Cobranca Mensal da Revista');
        $preApproval->setAmountPerPayment(100);
        $preApproval->setMaxAmountPerPayment(150);
        $preApproval->setInitialDate(new DateTime('2015-11-18'));
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

        $serializer = new RequestSerializer;
        $xml = $serializer->serialize($request);

        $this->assertInstanceOf(SimpleXMLElement::class, $xml);
        $expected = simplexml_load_file(__DIR__.'/xml/preAprovalsRequestFull.xml');
        $this->assertEquals($expected, $xml);
    }
}
