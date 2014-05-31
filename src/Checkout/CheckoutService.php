<?php
namespace PHPSC\PagSeguro\Checkout;

use DateTime;
use PHPSC\PagSeguro\BaseService;
use PHPSC\PagSeguro\CheckoutService as CheckoutServiceInterface;
use SimpleXMLElement;

class CheckoutService extends BaseService implements CheckoutServiceInterface
{
    /**
     * @param Checkout $checkout
     *
     * @return Response
     */
    public function checkout(Checkout $checkout)
    {
        return $this->decode(
            $this->post(static::ENDPOINT, $checkout->xmlSerialize())
        );
    }

    /**
     * @param SimpleXMLElement $obj
     * @param boolean $sandbox
     *
     * @return Response
     */
    protected function decode(SimpleXMLElement $obj)
    {
        return new Response(
            (string) $obj->code,
            new DateTime((string) $obj->date),
            $this->isSandbox() ? static::SANDBOX_REDIRECT_TO : static::REDIRECT_TO
        );
    }
}
