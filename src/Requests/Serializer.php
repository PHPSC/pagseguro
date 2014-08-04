<?php
namespace PHPSC\PagSeguro\Requests;

use PHPSC\PagSeguro\Customer\Address;
use PHPSC\PagSeguro\Customer\Customer;
use PHPSC\PagSeguro\Customer\Phone;
use PHPSC\PagSeguro\Items\Item;
use PHPSC\PagSeguro\Shipping\Shipping;
use SimpleXMLElement;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
abstract class Serializer
{
    /**
     * @param SimpleXMLElement $xml
     * @param Item $item
     */
    protected function appendItem(SimpleXMLElement $xml, Item $item)
    {
        $child = $xml->addChild('item');
        $child->addChild('id', substr($item->getId(), 0, 100));
        $child->addChild('description', substr($item->getDescription(), 0, 100));
        $child->addChild('amount', number_format($item->getAmount(), 2, '.', ''));
        $child->addChild('quantity', (int) $item->getQuantity());

        if ($weight = $item->getWeight()) {
            $child->addChild('weight', (int) $weight);
        }

        if ($shippingCost = $item->getShippingCost()) {
            $child->addChild('shippingCost', number_format($shippingCost, 2, '.', ''));
        }
    }

    /**
     * @param SimpleXMLElement $xml
     * @param Shipping $shipping
     */
    protected function appendShipping(SimpleXMLElement $xml, Shipping $shipping = null)
    {
        if ($shipping === null) {
            return;
        }

        $child = $xml->addChild('shipping');
        $child->addChild('type', $shipping->getType());

        $this->appendAddress($child, $shipping->getAddress());

        if ($cost = $shipping->getCost()) {
            $child->addChild('cost', $cost);
        }
    }

    /**
     * @param SimpleXMLElement $xml
     * @param Customer $customer
     */
    protected function appendCustomer(SimpleXMLElement $xml, Customer $customer = null)
    {
        if ($customer === null) {
            return;
        }

        $child = $xml->addChild('sender');
        $child->addChild('email', substr($customer->getEmail(), 0, 60));

        if ($name = $customer->getName()) {
            $child->addChild('name', substr($name, 0, 50));
        }

        $this->appendPhone($child, $customer->getPhone());
        $this->appendAddress($child, $customer->getAddress());
    }

    /**
     * @param SimpleXMLElement $xml
     * @param Phone $phone
     */
    protected function appendPhone(SimpleXMLElement $xml, Phone $phone = null)
    {
        if ($phone === null) {
            return;
        }

        $child = $xml->addChild('phone');
        $child->addChild('areaCode', substr($phone->getAreaCode(), 0, 2));
        $child->addChild('number', substr($phone->getNumber(), 0, 9));
    }

    /**
     * @param SimpleXMLElement $xml
     * @param Address $address
     */
    protected function appendAddress(SimpleXMLElement $xml, Address $address = null)
    {
        if ($address === null) {
            return;
        }

        $child = $xml->addChild('address');
        $child->addChild('country', $address->getCountry());
        $child->addChild('state', strtoupper(substr($address->getState(), 0, 2)));
        $child->addChild('city', substr($address->getCity(), 0, 60));
        $child->addChild('postalCode', substr($address->getPostalCode(), 0, 8));
        $child->addChild('district', substr($address->getDistrict(), 0, 60));
        $child->addChild('street', substr($address->getStreet(), 0, 80));
        $child->addChild('number', substr($address->getNumber(), 0, 20));

        if ($complement = $address->getComplement()) {
            $child->addChild('complement', substr($complement, 0, 40));
        }
    }
}
