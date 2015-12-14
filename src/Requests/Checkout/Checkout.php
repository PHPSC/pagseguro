<?php
namespace PHPSC\PagSeguro\Requests\Checkout;

use JMS\Serializer\Annotation as JSA;
use PHPSC\PagSeguro\Customer\Customer;
use PHPSC\PagSeguro\Requests\SerializerTrait;

/**
 * @JSA\AccessType("public_method")
 * @JSA\ExclusionPolicy("all")
 * @JSA\ReadOnly
 * @JSA\XmlRoot("checkout")
 *
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class Checkout
{
    use SerializerTrait;

    /**
     * @JSA\Expose
     * @JSA\Inline
     * @JSA\Type("PHPSC\PagSeguro\Requests\Checkout\Order")
     *
     * @var Order
     */
    private $order;

    /**
     * @JSA\Expose
     * @JSA\SerializedName("sender")
     * @JSA\Type("PHPSC\PagSeguro\Customer\Customer")
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
     * @JSA\Type("integer")
     * @JSA\Expose
     *
     * @var int
     */
    private $maxUses;

    /**
     * @JSA\Type("integer")
     * @JSA\Expose
     *
     * @var int
     */
    private $maxAge;

    /**
     * @param Order $order
     * @param Customer $customer
     * @param string $redirectTo
     * @param string $maxUses
     * @param string $maxAge
     */
    public function __construct(Order $order = null)
    {
        $this->order = $order ?: new Order();
    }

    /**
     * @return Order
     */
    public function getOrder()
    {
        return $this->order;
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
     * @return int
     */
    public function getMaxUses()
    {
        return $this->maxUses;
    }

    /**
     * @param int $maxUses
     */
    public function setMaxUses($maxUses)
    {
        $this->maxUses = $maxUses;
    }

    /**
     * @return int
     */
    public function getMaxAge()
    {
        return $this->maxAge;
    }

    /**
     * @param int $maxAge
     */
    public function setMaxAge($maxAge)
    {
        $this->maxAge = $maxAge;
    }
}
