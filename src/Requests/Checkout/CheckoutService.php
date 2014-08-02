<?php
namespace PHPSC\PagSeguro\Requests\Checkout;

use DateTime;
use PHPSC\PagSeguro\Requests\CheckoutService as CheckoutServiceInterface;
use PHPSC\PagSeguro\Requests\Redirection;
use PHPSC\PagSeguro\Service;
use SimpleXMLElement;

class CheckoutService extends Service implements CheckoutServiceInterface
{
    /**
     * {@inheritdoc}
     */
    public function checkout(Checkout $checkout)
    {
        $response = $this->post(static::ENDPOINT, $this->createRequest($checkout));

        return $this->getRedirection($response);
    }

    /**
     * @param Checkout $checkout
     *
     * @return SimpleXMLElement
     */
    protected function createRequest(Checkout $checkout)
    {
        $request = simplexml_load_string('<?xml version="1.0" encoding="UTF-8"?><checkout />');
        $checkout->xmlSerialize($request);

        return $request;
    }

    /**
     * @param SimpleXMLElement $obj
     *
     * @return Response
     */
    protected function getRedirection(SimpleXMLElement $obj)
    {
        return new Redirection(
            (string) $obj->code,
            new DateTime((string) $obj->date),
            $this->isSandbox() ? static::SANDBOX_REDIRECT_TO : static::REDIRECT_TO
        );
    }
}
