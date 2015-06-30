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
    protected $transactions = array();

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
     * @param array | \PHPSC\PagSeguro\Purchases\Transactions\TransactionSearchItem $transactions
     * @param int $resultsInThisPage
     * @param int $currentPage
     * @param int $totalPages
     */
    public function __construct(DateTime $date, $transactions, $resultsInThisPage, $currentPage, $totalPages)
    {
        $this->date = $date;
        $this->transactions = is_array($transactions) ? $transactions : array($transactions);
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

    public function setDate(DateTime $date)
    {
        $this->date = $date;
        return $this;
    }

    public function setTransactions(TransactionSearchItem $transactions)
    {
        $this->transactions = $transactions;
        return $this;
    }

    public function setResultsInThisPage($resultsInThisPage)
    {
        $this->resultsInThisPage = $resultsInThisPage;
        return $this;
    }

    public function setCurrentPage($currentPage)
    {
        $this->currentPage = $currentPage;
        return $this;
    }

    public function setTotalPages($totalPages)
    {
        $this->totalPages = $totalPages;
        return $this;
    }

}
