<?php
namespace PHPSC\PagSeguro\Requests\PreApprovals;

use PHPSC\PagSeguro\Customer\Customer;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class Request
{
    /**
     * @var PreApproval
     */
    private $preApproval;

    /**
     * @var string
     */
    private $reference;

    /**
     * @var Customer
     */
    private $customer;

    /**
     * @var string
     */
    private $redirectTo;

    /**
     * @var string
     */
    private $reviewOn;

    /**
     * @param PreApproval $preApproval
     */
    public function __construct(PreApproval $preApproval = null)
    {
        $this->preApproval = $preApproval ?: new PreApproval();
    }

    /**
     * @return PreApproval
     */
    public function getPreApproval()
    {
        return $this->preApproval;
    }

    /**
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
    }

    /**
     * @return Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @param Customer $customer
     */
    public function setCustomer(Customer $customer)
    {
        $this->customer = $customer;
    }

    /**
     * @return string
     */
    public function getRedirectTo()
    {
        return $this->redirectTo;
    }

    /**
     * @param string $redirectTo
     */
    public function setRedirectTo($redirectTo)
    {
        $this->redirectTo = $redirectTo;
    }

    /**
     * @return string
     */
    public function getReviewOn()
    {
        return $this->reviewOn;
    }

    /**
     * @param string $reviewOn
     */
    public function setReviewOn($reviewOn)
    {
        $this->reviewOn = $reviewOn;
    }
}
