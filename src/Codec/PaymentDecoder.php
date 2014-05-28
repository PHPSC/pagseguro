<?php
namespace PHPSC\PagSeguro\Codec;

use PHPSC\PagSeguro\ValueObject\Payment\PaymentResponse;
use SimpleXMLElement;
use DateTime;

class PaymentDecoder
{
    /**
     * @param SimpleXMLElement $obj
     * @param boolean $sandbox
     *
     * @return PaymentResponse
     */
    public function decode(SimpleXMLElement $obj, $sandbox)
    {
        return new PaymentResponse(
            (string) $obj->code,
            new DateTime((string) $obj->date),
            $sandbox
        );
    }
}
