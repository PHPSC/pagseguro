<?php
namespace PHPSC\PagSeguro\Purchases\Subscriptions;

use PHPSC\PagSeguro\Requests\Serializer;
use SimpleXMLElement;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class ChargeSerializer extends Serializer
{
    /**
     * @param Charge $charge
     * @return SimpleXMLElement
     */
    public function serialize(Charge $charge)
    {
        $request = simplexml_load_string('<?xml version="1.0" encoding="UTF-8"?><payment />');
        $request->addChild('preApprovalCode', $charge->getSubscriptionCode());

        $items = $request->addChild('items');

        foreach ($charge->getItems() as $item) {
            $this->appendItem($items, $item);
        }

        if ($reference = $charge->getReference()) {
            $request->addChild('reference', $reference);
        }

        return $request;
    }
}
