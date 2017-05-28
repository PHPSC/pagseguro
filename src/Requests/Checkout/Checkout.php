<?php
namespace PHPSC\PagSeguro\Requests\Checkout;

use JMS\Serializer\Annotation as Serializer;
use PHPSC\PagSeguro\Customer\Customer;
use PHPSC\PagSeguro\SerializerTrait;

/**
 * @Serializer\AccessType("public_method")
 * @Serializer\ReadOnly
 * @Serializer\XmlRoot("checkout")
 *
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class Checkout
{
    use SerializerTrait;

    /**
     * @Serializer\Inline
     * @Serializer\Type("PHPSC\PagSeguro\Requests\Checkout\Order")
     *
     * @var Order
     */
    private $order;

    /**
     * @Serializer\SerializedName("sender")
     * @Serializer\Type("PHPSC\PagSeguro\Customer\Customer")
     *
     * @var Customer
     */
    private $customer;

    /**
     * @Serializer\XmlElement(cdata=false)
     * @Serializer\SerializedName("redirectURL")
     *
     * @var string
     */
    private $redirectTo;

    /**
     * @Serializer\Type("integer")
     *
     * @var int
     */
    private $maxUses;

    /**
     * @Serializer\Type("integer")
     *
     * @var int
     */
    private $maxAge;

    /**
     * @Serializer\XmlElement(cdata=false)
     *
     * @var string
    */
    private $notificationURL;

    /**
     * @param Order $order
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

    /**
    * @return string
    */
    public function getNotificationURL()
    {
        return $this->notificationURL;
    }

    /**
    * @param string $notificationURL
    */
    public function setNotificationURL($notificationURL)
    {
        $this->notificationURL = $notificationURL;
    }
}
