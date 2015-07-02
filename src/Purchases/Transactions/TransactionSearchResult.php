<?php

namespace PHPSC\PagSeguro\Purchases\Transactions;

use DateTime;

class TransactionSearchResult
{

    /**
     * @var DateTime
     */
    protected $date;

    /**
     * @var TransactionSearchItem
     */
    protected $transactions;

    /**
     * @var int
     */
    protected $resultsInThisPage;

    /**
     * @var int
     */
    protected $currentPage;

    /**
     * @var int
     */
    protected $totalPages;

    /**
     * 
     * @param DateTime $date
     * @param array $transactions
     * @param int $resultsInThisPage
     * @param int $currentPage
     * @param int $totalPages
     */
    public function __construct(DateTime $date, array $transactions, $resultsInThisPage, $currentPage, $totalPages)
    {
        $this->date = $date;
        $this->transactions = $transactions;
        $this->resultsInThisPage = $resultsInThisPage;
        $this->currentPage = $currentPage;
        $this->totalPages = $totalPages;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getTransactions()
    {
        return $this->transactions;
    }

    public function getResultsInThisPage()
    {
        return $this->resultsInThisPage;
    }

    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    public function getTotalPages()
    {
        return $this->totalPages;
    }
}
