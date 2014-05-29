<?php
namespace PHPSC\PagSeguro\Checkout;

use DateTime;
use SimpleXMLElement;

class Decoder
{
    /**
     * @var string
     */
    const HOST = 'pagseguro.uol.com.br';

    /**
     * @var string
     */
    const SANDBOX_HOST = 'sandbox.pagseguro.uol.com.br';

    /**
     * @var string
     */
    const RESOURCE = '/v2/checkout/payment.html';

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
            $this->createUri($sandbox)
        );
    }

    /**
     * @param boolean $sandbox
     *
     * @return string
     */
    protected function createUri($sandbox)
    {
        $host = $sandbox ? static::SANDBOX_HOST : static::HOST;

        return 'https://' . $host . static::RESOURCE;
    }
}
