<?php
namespace PHPSC\PagSeguro\Purchases\Subscriptions;

use PHPSC\PagSeguro\Items\ItemCollection;
use PHPSC\PagSeguro\Items\Items;
use JMS\Serializer\Annotation as JSA;
use PHPSC\PagSeguro\Requests\SerializerTrait;

/**
 * @JSA\AccessType("public_method")
 * @JSA\ExclusionPolicy("all")
 * @JSA\ReadOnly
 * @JSA\XmlRoot("charge")
 *
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class Charge
{
    use SerializerTrait;
    
    /**
     * @JSA\Expose
     * @JSA\SerializedName("preApprovalCode")
     * @JSA\XmlElement(cdata=false)
     *
     * @var string
     */
    private $subscriptionCode;

    /**
     * @JSA\Expose
     * @JSA\Type("ArrayCollection<PHPSC\PagSeguro\Items\Item>")
     * @JSA\XmlList(entry="item")
     * @JSA\SerializedName("items")
     *
     * @var ItemCollection
     */
    private $items;

    /**
     * @JSA\Expose
     * @JSA\XmlElement(cdata=false)
     *
     * @var string
     */
    private $reference;

    /**
     * @param ItemCollection $items
     */
    public function __construct(ItemCollection $items = null)
    {
        $this->items = $items ?: new Items();
    }

    /**
     * @return string
     */
    public function getSubscriptionCode()
    {
        return $this->subscriptionCode;
    }

    /**
     * @param string $subscriptionCode
     */
    public function setSubscriptionCode($subscriptionCode)
    {
        $this->subscriptionCode = $subscriptionCode;
    }

    /**
     * @return ItemCollection
     */
    public function getItems()
    {
        return $this->items;
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
}
