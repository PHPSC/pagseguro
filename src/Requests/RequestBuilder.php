<?php
namespace PHPSC\PagSeguro\Requests;

use DateTime;
use PHPSC\PagSeguro\Customer\Customer;
use PHPSC\PagSeguro\Requests\PreApprovals\Request;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
interface RequestBuilder
{
    /**
     * @param string $reference
     *
     * @return self
     */
    public function setReference($reference);

    /**
     * @param Customer $customer
     *
     * @return self
     */
    public function setCustomer(Customer $customer);

    /**
     * @param string $redirectTo
     *
     * @return self
     */
    public function setRedirectTo($redirectTo);

    /**
     * @param string $reviewOn
     *
     * @return self
     */
    public function setReviewOn($reviewOn);

    /**
     * @param string $name
     *
     * @return self
     */
    public function setName($name);

    /**
     * @param string $details
     *
     * @return self
     */
    public function setDetails($details);

    /**
     * @param string $period
     *
     * @return self
     */
    public function setPeriod($period);

    /**
     * @param DateTime $finalDate
     *
     * @return self
     */
    public function setFinalDate(DateTime $finalDate);

    /**
     * @param float $maxTotalAmount
     *
     * @return self
     */
    public function setMaxTotalAmount($maxTotalAmount);

    /**
     * @param float $amountPerPayment
     *
     * @return self
     */
    public function setAmountPerPayment($amountPerPayment);

    /**
     * @param float $maxAmountPerPayment
     *
     * @return self
     */
    public function setMaxAmountPerPayment($maxAmountPerPayment);

    /**
     * @param int $maxPaymentsPerPeriod
     *
     * @return self
     */
    public function setMaxPaymentsPerPeriod($maxPaymentsPerPeriod);

    /**
     * @param float $maxAmountPerPeriod
     *
     * @return self
     */
    public function setMaxAmountPerPeriod($maxAmountPerPeriod);

    /**
     * @param DateTime $initialDate
     *
     * @return self
     */
    public function setInitialDate(DateTime $initialDate);

    /**
     * @return Request
     */
    public function getRequest();
}
