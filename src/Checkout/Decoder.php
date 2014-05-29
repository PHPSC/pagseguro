<?php
namespace PHPSC\PagSeguro\Checkout;

use DateTime;
use SimpleXMLElement;

class Decoder
{
    /**
     * @param SimpleXMLElement $obj
     * @param boolean $sandbox
     *
     * @return Response
     */
    public function decode(SimpleXMLElement $obj, $sandbox)
    {
        return new Response(
            (string) $obj->code,
            new DateTime((string) $obj->date),
            $sandbox
        );
    }
}
