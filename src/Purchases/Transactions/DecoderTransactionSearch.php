<?php

namespace PHPSC\PagSeguro\Purchases\Transactions;

use DateTime;
use SimpleXMLElement;

class DecoderTransactionSearch
{

    public function decode(SimpleXMLElement $obj)
    {
        //criar transações
        $transactions = array();
        foreach ($obj->transactions->transaction as $transaction) {
            $transactions[] = $this->createTransaction($transaction);
        }
        return new TransactionSearchResult(
                new DateTime((string) $obj->date), 
                $transactions, 
                $obj->resultsInThisPage, 
                $obj->currentPage, 
                $obj->totalPages
                );
    }

    public function createTransaction($transaction)
    {
        return new TransactionSearchItem(
                new DateTime((string) $transaction->date), 
                new DateTime((string) $transaction->lastEventDate), 
                (string) $transaction->code, 
                (string) $transaction->reference, 
                (int) $transaction->type, 
                (int) $transaction->status, 
                (string) $transaction->cancellationSource, 
                new PaymentMethod(
                    (int) $transaction->paymentMethod->type, 
                    (int) $transaction->paymentMethod->code
                ), 
                (float) $transaction->grossAmount, 
                (float) $transaction->discountAmount, 
                (float) $transaction->feeAmount, 
                (float) $transaction->netAmount,
                (float) $transaction->extraAmount
        );
    }

}
