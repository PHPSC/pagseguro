<?php
namespace PHPSC\PagSeguro\Purchases\Subscriptions;

use JMS\Serializer\Annotation as Serializer;
use PHPSC\PagSeguro\Items\ItemCollection;
use PHPSC\PagSeguro\Items\Items;
use PHPSC\PagSeguro\SerializerTrait;

/**
 * @Serializer\AccessType("public_method")
 * @Serializer\ReadOnly
 * @Serializer\XmlRoot("charge")
 *
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class Charge
{
    use SerializerTrait;

    /**
     * @Serializer\SerializedName("preApprovalCode")
     * @Serializer\XmlElement(cdata=false)
     *
     * @var string
     */
    private $subscriptionCode;

    /**
     * @Serializer\Type("ArrayCollection<PHPSC\PagSeguro\Items\Item>")
     * @Serializer\XmlList(entry="item")
     * @Serializer\SerializedName("items")
     *
     * @var ItemCollection
     */
    private $items;

    /**
     * @Serializer\XmlElement(cdata=false)
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
