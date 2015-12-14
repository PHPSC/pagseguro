<?php
namespace PHPSC\PagSeguro\Requests\PreApprovals;

use JMS\Serializer\Annotation as JSA;
use PHPSC\PagSeguro\Requests\SerializerTrait;
use PHPSC\PagSeguro\Customer\Customer;

/**
 * @JSA\AccessType("public_method")
 * @JSA\ExclusionPolicy("all")
 * @JSA\ReadOnly
 * @JSA\XmlRoot("preApprovalRequest")
 *
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class Request
{
    use SerializerTrait;
    
    /**
     * @JSA\Expose
     * @JSA\Type("PHPSC\PagSeguro\Requests\PreApprovals\PreApproval")
     *
     * @var PreApproval
     */
    private $preApproval;

    /**
     * @JSA\Expose
     * @JSA\XmlElement(cdata=false)
     *
     * @var string
     */
    private $reference;

    /**
     * @JSA\Expose
     * @JSA\Type("PHPSC\PagSeguro\Customer\Customer")
     * @JSA\SerializedName("sender")
     *
     * @var Customer
     */
    private $customer;

    /**
     * @JSA\Expose
     * @JSA\XmlElement(cdata=false)
     * @JSA\SerializedName("redirectURL")
     *
     * @var string
     */
    private $redirectTo;

    /**
     * @JSA\Expose
     * @JSA\XmlElement(cdata=false)
     * @JSA\SerializedName("reviewURL")
     *
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
