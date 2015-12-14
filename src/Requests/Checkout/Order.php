<?php
namespace PHPSC\PagSeguro\Requests\Checkout;

use JMS\Serializer\Annotation as JSA;
use PHPSC\PagSeguro\Requests\SerializerTrait;
use PHPSC\PagSeguro\Items\ItemCollection;
use PHPSC\PagSeguro\Shipping\Shipping;
use PHPSC\PagSeguro\Items\Items;

/**
 * @JSA\AccessType("public_method")
 * @JSA\ExclusionPolicy("all")
 * @JSA\ReadOnly
 * @JSA\XmlRoot("order")
 *
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class Order
{

    use SerializerTrait;
    /**
     * @JSA\Expose
     * @JSA\XmlElement(cdata=false)
     *
     * @var string
     */
    private $currency;

    /**
     * @JSA\Expose
     * @JSA\SerializedName("items")
     * @JSA\Type("ArrayCollection<PHPSC\PagSeguro\Items\Item>")
     * @JSA\XmlList(entry="item")
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
     * @JSA\Expose
     * @JSA\Type("PHPSC\PagSeguro\Shipping\Shipping")
     *
     * @var Shipping
     */
    private $shipping;

    /**
     * @JSA\Expose
     * @JSA\Type("double")
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
        return $this->extraAmount;
    }

    /**
     * @param float $extraAmount
     */
    public function setExtraAmount($extraAmount)
    {
        $this->extraAmount = $extraAmount;
    }
}
