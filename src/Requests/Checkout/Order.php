<?php
namespace PHPSC\PagSeguro\Requests\Checkout;

use JMS\Serializer\Annotation as Serializer;
use PHPSC\PagSeguro\Items\ItemCollection;
use PHPSC\PagSeguro\Items\Items;
use PHPSC\PagSeguro\SerializerTrait;
use PHPSC\PagSeguro\Shipping\Shipping;

/**
 * @Serializer\AccessType("public_method")
 * @Serializer\ReadOnly
 * @Serializer\XmlRoot("order")
 *
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class Order
{
    use SerializerTrait;

    /**
     * @Serializer\XmlElement(cdata=false)
     *
     * @var string
     */
    private $currency;

    /**
     * @Serializer\SerializedName("items")
     * @Serializer\Type("ArrayCollection<PHPSC\PagSeguro\Items\Item>")
     * @Serializer\XmlList(entry="item")
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
     * @Serializer\Type("PHPSC\PagSeguro\Shipping\Shipping")
     *
     * @var Shipping
     */
    private $shipping;

    /**
     * @Serializer\XmlElement(cdata=false)
     *
     * @var float
     */
    private $extraAmount;

    /**
     * @param ItemCollection $items
     */
    public function __construct(ItemCollection $items = null)
    {
        $this->items    = $items ? : new Items();
        $this->currency = 'BRL';
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
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

    /**
     * @return Shipping
     */
    public function getShipping()
    {
        return $this->shipping;
    }

    /**
     * @param Shipping $shipping
     */
    public function setShipping(Shipping $shipping)
    {
        $this->shipping = $shipping;
    }

    /**
     * @return float
     */
    public function getExtraAmount()
    {
        return $this->formatAmount($this->extraAmount);
    }

    /**
     * @param float $extraAmount
     */
    public function setExtraAmount($extraAmount)
    {
        $this->extraAmount = $extraAmount;
    }
}
