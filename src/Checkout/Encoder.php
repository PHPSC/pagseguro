<?php
namespace PHPSC\PagSeguro\Checkout;

use PHPSC\PagSeguro\Customer\Address;
use PHPSC\PagSeguro\Item;

class Encoder
{
    /**
     * @param Checkout $checkout
     *
     * @return string
     */
    public function encode(Checkout $checkout)
    {
        $data = array();

        $this->appendCurrency($data, $checkout);
        $this->appendItems($data, $checkout);
        $this->appendReference($data, $checkout);
        $this->appendSender($data, $checkout);
        $this->appendShipping($data, $checkout);
        $this->appendExtraAmount($data, $checkout);
        $this->appendRedirectUrl($data, $checkout);
        $this->appendMaxUses($data, $checkout);
        $this->appendMaxAge($data, $checkout);

        return $data;
    }

    /**
     * @param array $data
     * @param Checkout $checkout
     */
    protected function appendCurrency(array &$data, Checkout $checkout)
    {
        $data['currency'] = $checkout->getCurrency();
    }

    /**
     * @param array $data
     * @param Checkout $checkout
     */
    protected function appendItems(array &$data, Checkout $checkout)
    {
        foreach ($checkout->getItems() as $index => $item) {
            $this->appendItem($data, $index + 1, $item);
        }
    }

    /**
     * @param array $data
     * @param Item $item
     */
    protected function appendItem(array &$data, $index, Item $item)
    {
        $data['itemId' . $index] = $item->getId();
        $data['itemDescription' . $index] = $item->getDescription();
        $data['itemAmount' . $index] = number_format($item->getAmount(), 2, '.', '');
        $data['itemQuantity' . $index] = $item->getQuantity();

        if ($item->getShippingCost()) {
            $data['itemShippingCost' . $index] = $item->getShippingCost();
        }

        if ($item->getWeight()) {
            $data['itemWeight' . $index] = $item->getWeight();
        }
    }

    /**
     * @param array $data
     * @param Checkout $checkout
     */
    protected function appendReference(array &$data, Checkout $checkout)
    {
        if ($checkout->getReference()) {
            $data['reference'] = $checkout->getReference();
        }
    }

    /**
     * @param array $data
     * @param Checkout $checkout
     */
    protected function appendSender(array &$data, Checkout $checkout)
    {
        if (!$checkout->getSender()) {
            return ;
        }

        $data['senderEmail'] = $checkout->getSender()->getEmail();

        if ($checkout->getSender()->getName()) {
            $data['senderName'] = $checkout->getSender()->getName();
        }

        if ($checkout->getSender()->getPhone()) {
            $data['senderAreaCode'] = $checkout->getSender()->getPhone()->getAreaCode();
            $data['senderPhone'] = $checkout->getSender()->getPhone()->getNumber();
        }
    }

    /**
     * @param array $data
     * @param Checkout $checkout
     */
    protected function appendShipping(array &$data, Checkout $checkout)
    {
        if (!$checkout->getShipping()) {
            return ;
        }

        $data['shippingType'] = $checkout->getShipping()->getType();
        $data['shippingCost'] = $checkout->getShipping()->getCost();

        if ($checkout->getShipping()->getAddress()) {
            $this->appendAddress($data, $checkout->getShipping()->getAddress());
        }
    }

    /**
     * @param array $data
     * @param Address $address
     */
    protected function appendAddress(array &$data, Address $address)
    {
        $data['shippingAddressCountry'] = $address->getCountry();

        if ($address->getState()) {
            $data['shippingAddressState'] = $address->getState();
        }

        if ($address->getCity()) {
            $data['shippingAddressCity'] = $address->getCity();
        }

        if ($address->getPostalCode()) {
            $data['shippingAddressPostalCode'] = $address->getPostalCode();
        }

        if ($address->getDistrict()) {
            $data['shippingAddressDistrict'] = $address->getDistrict();
        }

        if ($address->getStreet()) {
            $data['shippingAddressStreet'] = $address->getStreet();
        }

        if ($address->getNumber()) {
            $data['shippingAddressNumber'] = $address->getNumber();
        }

        if ($address->getComplement()) {
            $data['shippingAddressComplement'] = $address->getComplement();
        }
    }

    /**
     * @param array $data
     * @param Checkout $checkout
     */
    protected function appendExtraAmount(array &$data, Checkout $checkout)
    {
        if ($checkout->getExtraAmount()) {
            $data['extraAmount'] = number_format($checkout->getExtraAmount(), 2, '.', '');
        }
    }

    /**
     * @param array $data
     * @param Checkout $checkout
     */
    protected function appendRedirectUrl(array &$data, Checkout $checkout)
    {
        if ($checkout->getRedirectUrl()) {
            $data['redirectURL'] = $checkout->getRedirectUrl();
        }
    }

    /**
     * @param array $data
     * @param Checkout $checkout
     */
    protected function appendMaxUses(array &$data, Checkout $checkout)
    {
        if ($checkout->getMaxUses()) {
            $data['maxUses'] = $checkout->getMaxUses();
        }
    }

    /**
     * @param array $data
     * @param Checkout $checkout
     */
    protected function appendMaxAge(array &$data, Checkout $checkout)
    {
        if ($checkout->getMaxAge()) {
            $data['maxAge'] = $checkout->getMaxAge();
        }
    }
}
