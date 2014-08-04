<?php
namespace PHPSC\PagSeguro\Purchases\Subscriptions;

use PHPSC\PagSeguro\Purchases\Decoder as BaseDecoder;
use SimpleXMLElement;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class Decoder extends BaseDecoder
{
    /**
     * @param SimpleXMLElement $obj
     *
     * @return Transaction
     */
    public function decode(SimpleXMLElement $obj)
    {
        return new Subscription(
            (string) $obj->name,
            $this->createDetails($obj),
            (string) $obj->tracker,
            (string) $obj->charge
        );
    }
}
