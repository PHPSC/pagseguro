<?php
namespace PHPSC\PagSeguro\Requests\PreApprovals;

use DateTime;
use PHPSC\PagSeguro\Customer\Customer;
use PHPSC\PagSeguro\Requests\RequestBuilder as RequestBuilderInterface;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class RequestBuilder implements RequestBuilderInterface
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @param Request $request
     * @param boolean $manualCharge
     */
    public function __construct($manualCharge, Request $request = null)
    {
        $this->request = $request ?: new Request();

        $this->request->getPreApproval()->setChargeType(
            $manualCharge ? ChargeType::MANUAL : ChargeType::AUTOMATIC
        );
    }

    /**
     * {@inheritdoc}
     */
    public function setCustomer(Customer $customer)
    {
        $this->request->setCustomer($customer);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        $this->request->getPreApproval()->setName($name);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setDetails($details)
    {
        $this->request->getPreApproval()->setDetails($details);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setFinalDate(DateTime $finalDate)
    {
        $this->request->getPreApproval()->setFinalDate($finalDate);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setMaxTotalAmount($maxTotalAmount)
    {
        $this->request->getPreApproval()->setMaxTotalAmount($maxTotalAmount);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setPeriod($period)
    {
        $this->request->getPreApproval()->setPeriod($period);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setRedirectTo($redirectTo)
    {
        $this->request->setRedirectTo($redirectTo);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setReference($reference)
    {
        $this->request->setReference($reference);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setReviewOn($reviewOn)
    {
        $this->request->setReviewOn($reviewOn);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setAmountPerPayment($amountPerPayment)
    {
        $this->request->getPreApproval()->setAmountPerPayment($amountPerPayment);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setMaxAmountPerPayment($maxAmountPerPayment)
    {
        $this->request->getPreApproval()->setMaxAmountPerPayment($maxAmountPerPayment);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setMaxPaymentsPerPeriod($maxPaymentsPerPeriod)
    {
        $this->request->getPreApproval()->setMaxPaymentsPerPeriod($maxPaymentsPerPeriod);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setMaxAmountPerPeriod($maxAmountPerPeriod)
    {
        $this->request->getPreApproval()->setMaxAmountPerPeriod($maxAmountPerPeriod);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setInitialDate(DateTime $initialDate)
    {
        $this->request->getPreApproval()->setInitialDate($initialDate);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getRequest()
    {
        return $this->request;
    }
}
