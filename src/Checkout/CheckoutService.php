<?php
namespace PHPSC\PagSeguro\Checkout;

use DateTime;
use PHPSC\PagSeguro\BaseService;
use PHPSC\PagSeguro\CheckoutService as CheckoutServiceInterface;
use PHPSC\PagSeguro\Redirection;
use SimpleXMLElement;

class CheckoutService extends BaseService implements CheckoutServiceInterface
{
    /**
     * @param Checkout $checkout
     *
     * @return Redirection
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
        return new Redirection(
            (string) $obj->code,
            new DateTime((string) $obj->date),
            $this->isSandbox() ? static::SANDBOX_REDIRECT_TO : static::REDIRECT_TO
        );
    }
}
