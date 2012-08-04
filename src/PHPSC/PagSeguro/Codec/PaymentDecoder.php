<?php
namespace PHPSC\PagSeguro\Codec;

use \PHPSC\PagSeguro\ValueObject\Payment\PaymentResponse;
use \SimpleXMLElement;
use \DateTime;

class PaymentDecoder
{
    /**
     * @param string $xml
     * @return \PHPSC\PagSeguro\ValueObject\Payment\PaymentResponse
     */
    public function decode($xml)
    {
        $obj = new SimpleXMLElement($xml);

        return new PaymentResponse(
            (string) $obj->code,
            new DateTime((string) $obj->date)
        );
    }
}