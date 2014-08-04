<?php
namespace PHPSC\PagSeguro\Requests\Checkout;

use PHPSC\PagSeguro\Requests\Checkout\Checkout;
use PHPSC\PagSeguro\Requests\Serializer;
use SimpleXMLElement;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class CheckoutSerializer extends Serializer
{
    /**
     * @param Checkout $checkout
     *
     * @return SimpleXMLElement
     */
    public function serialize(Checkout $checkout)
    {
        $xml = simplexml_load_string('<?xml version="1.0" encoding="UTF-8"?><checkout />');

        $this->appendCheckoutData($xml, $checkout);

        return $xml;
    }

    /**
     * @param SimpleXMLElement $xml
     * @param Checkout $checkout
     */
    private function appendCheckoutData(SimpleXMLElement $xml, Checkout $checkout)
    {
        $this->appendOrder($xml, $checkout->getOrder());
        $this->appendCustomer($xml, $checkout->getCustomer());

        if ($redirectTo = $checkout->getRedirectTo()) {
            $xml->addChild('redirectURL', $redirectTo);
        }

        if ($maxUses = $checkout->getMaxUses()) {
            $xml->addChild('maxUses', $maxUses);
        }

        if ($maxAge = $checkout->getMaxAge()) {
            $xml->addChild('maxAge', $maxAge);
        }
    }

    /**
     * @param SimpleXMLElement $xml
     * @param Order $order
     */
    private function appendOrder(SimpleXMLElement $xml, Order $order)
    {
        $xml->addChild('currency', $order->getCurrency());

        $items = $xml->addChild('items');

        foreach ($order->getItems() as $item) {
            $this->appendItem($items, $item);
        }

        if ($reference = $order->getReference()) {
            $xml->addChild('reference', $reference);
        }

        if ($extraAmount = $order->getExtraAmount()) {
            $xml->addChild('extraAmount', $extraAmount);
        }

        $this->appendShipping($xml, $order->getShipping());
    }
}
