<?php
namespace PHPSC\PagSeguro\Purchases\Transactions;

use PHPSC\PagSeguro\Purchases\Transactions\Decoder;
use DateTime;

/**
 * @author Fábio Paiva <fabio@paiva.info>
 */
class TransactionSearchTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function testDecoderTransactionSearch()
    {
        $decoder = new Decoder();
        $xml = simplexml_load_file(__DIR__ . '/TransactionSearchData.xml');
        $transactionSearchResult = $decoder->decodeTransactionSearch($xml);
        
        $date = new DateTime('2011-02-16T20:14:35.000-02:00');
        $this->assertEquals($transactionSearchResult->getDate(), $date);
        $this->assertEquals($transactionSearchResult->getCurrentPage(), '1');
        $this->assertEquals($transactionSearchResult->getResultsInThisPage(), '10');
        $this->assertEquals($transactionSearchResult->getTotalPages(), '1');
        $this->assertEquals(count($transactionSearchResult->getTransactions()), 2);

        $transaction = array_shift($transactionSearchResult->getTransactions());
        $this->assertEquals($transaction->getDetails()->getCode(), '9E884542-81B3-4419-9A75-BCC6FB495EF1');
        $this->assertEquals($transaction->getDetails()->getReference(), 'REF1234');
        $this->assertEquals($transaction->getDetails()->getStatus(), '3');
        $transactionDate = new DateTime('2011-02-05T15:46:12.000-02:00');
        $this->assertEquals($transaction->getDetails()->getDate(), $transactionDate);
        $transactionLastEventDate = new DateTime('2011-02-15T17:39:14.000-03:00');
        $this->assertEquals($transaction->getDetails()->getLastEventDate(), $transactionLastEventDate);
        $this->assertSame($transaction->getDetails()->getCustomer(), null);
        $this->assertEquals($transaction->getType(), 1);
        $this->assertEquals($transaction->getCancellationSource(), '');

        $this->assertSame($transaction->getPayment()->getEscrowEndDate(), null);
        $this->assertEquals($transaction->getPayment()->getPaymentMethod()->getType(), 1);
        $this->assertEquals($transaction->getPayment()->getPaymentMethod()->getCode(), 0);
        $this->assertEquals($transaction->getPayment()->getGrossAmount(), 49900);
        $this->assertEquals($transaction->getPayment()->getDiscountAmount(), 0);
        $this->assertEquals($transaction->getPayment()->getFeeAmount(), 0);
        $this->assertEquals($transaction->getPayment()->getNetAmount(), 49900);
        $this->assertEquals($transaction->getPayment()->getExtraAmount(), 0);
        $this->assertEquals($transaction->getPayment()->getInstallmentCount(), 0);
    }
}
