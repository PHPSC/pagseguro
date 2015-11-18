<?php
namespace PHPSC\PagSeguro\Purchases\Subscriptions;

use DateTime;
use PHPSC\PagSeguro\Purchases\Details;
use PHPSC\PagSeguro\Customer\Address;
use PHPSC\PagSeguro\Customer\Customer;
use PHPSC\PagSeguro\Customer\Phone;

/**
 * @author Renato Moura <moura137@gmail.com>
 */
class DecoderTest extends \PHPUnit_Framework_TestCase
{
    public function testDecodeShouldDoReturningObjectSubscription()
    {
        $detailsDate = new DateTime('2011-11-23T13:40:00.000-02:00');
        $detailsLastEventDate = new DateTime('2011-11-25T20:04:00.000-02:00');
        $detailsAddress = new Address('SP', 'SAO PAULO', '01421000', 'J Paulista', 'ALAMEDAITU', '78', 'ap.2601');
        $customer = new Customer('comprador@uol.com', 'Nome Comprador', new Phone('11', '30389678'), $detailsAddress);
        $details = new Details('C08984', 'REF1234', 'CANCELLED', $detailsDate, $detailsLastEventDate, $customer);

        $subscription = new Subscription('Seguro Notebook', $details, '538C53', 'auto');

        $obj = simplexml_load_file(__DIR__.'/xml/preApproval.xml');

        $decoder = new Decoder;
        $this->assertEquals($subscription, $decoder->decode($obj));
    }
}
