<?php
namespace PHPSC\PagSeguro\Codec;

use PHPSC\PagSeguro\ValueObject\Payment\PaymentResponse;
use SimpleXMLElement;
use DateTime;

class PaymentDecoder
{
    /**
     * @param SimpleXMLElement $obj
     * @return PaymentResponse
     */
    public function decode(SimpleXMLElement $obj)
    {
        return new PaymentResponse(
            (string) $obj->code,
            new DateTime((string) $obj->date)
        );
    }
}
