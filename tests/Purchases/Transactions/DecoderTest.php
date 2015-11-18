<?php
namespace PHPSC\PagSeguro\Purchases\Transactions;

use DateTime;
use PHPSC\PagSeguro\Purchases\Details;
use PHPSC\PagSeguro\Customer\Address;
use PHPSC\PagSeguro\Customer\Customer;
use PHPSC\PagSeguro\Customer\Phone;
use PHPSC\PagSeguro\Items\Item;
use PHPSC\PagSeguro\Items\Items;
use PHPSC\PagSeguro\Shipping\Shipping;

/**
 * @author Renato Moura <moura137@gmail.com>
 */
class DecoderTest extends \PHPUnit_Framework_TestCase
{
    public function testDecodeShouldDoReturningObjectTransaction()
    {
        $detailsDate = new DateTime('2011-02-10T16:13:41.000-03:00');
        $detailsLastEventDate = new DateTime('2011-02-10T19:15:11.000-03:00');
        $detailsAddress = new Address('AC', 'Sao Maite', '99500079', 'Centro', 'R Delgado', '55', 'Fundos');
        $customer = new Customer('usuario@site.com', 'FooBar', new Phone('11', '99999999'), $detailsAddress);
        $details = new Details('9E884542', 'REF1234', '6', $detailsDate, $detailsLastEventDate, $customer);

        $paymentMethod = new PaymentMethod(1, 101);
        $escrowEndDate = new DateTime('2011-03-10T08:00:00.000-03:00');
        $payment = new Payment($paymentMethod, 49900.00, 0.01, 0.04, 49900.03, 0.02, 1, $escrowEndDate);

        $shippingAddress = new Address('CE', 'Ortega', '40610912', 'Ipe', 'R. Regina', '36', 'Bl.A');
        $shipping = new Shipping(2, $shippingAddress, 23.45);

        $items = new Items;
        $items->add(new Item(77, 'Produto 01', 2.5, 4, 20, 300));
        $items->add(new Item(88, 'Produto 02', 342.51, 3, 134.98, 1000));

        $transaction = new Transaction($details, $payment, 2, $items, $shipping);

        $obj = simplexml_load_file(__DIR__.'/xml/transactionFull.xml');
        $decoder = new Decoder;
        $this->assertEquals($transaction, $decoder->decode($obj));
    }
}
