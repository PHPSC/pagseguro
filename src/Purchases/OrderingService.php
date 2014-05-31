<?php
namespace PHPSC\PagSeguro\Purchases;

use DateTime;
use PHPSC\PagSeguro\BaseService;
use PHPSC\PagSeguro\Customer;
use PHPSC\PagSeguro\OrderingService as OrderingServiceInterface;
use PHPSC\PagSeguro\Redirection;
use SimpleXMLElement;

class OrderingService extends BaseService implements OrderingServiceInterface
{
    /**
     * {@inheritdoc}
     */
    public function checkout(
        Order $order,
        Customer $customer = null,
        $redirectTo = null,
        $maxUses = null,
        $maxAge = null
    ) {
        return $this->decode(
            $this->post(
                static::ENDPOINT,
                $this->createRequest($order, $customer, $redirectTo, $maxUses, $maxAge)
            )
        );
    }

    /**
     * @param Order $order
     * @param Customer $customer
     * @param string $redirectTo
     * @param int $maxUses
     * @param int $maxAge
     *
     * @return SimpleXMLElement
     */
    protected function createRequest(
        Order $order,
        Customer $customer = null,
        $redirectTo = null,
        $maxUses = null,
        $maxAge = null
    ) {
        $request = simplexml_load_string('<?xml version="1.0" encoding="UTF-8"?><checkout />');
        $order->xmlSerialize($request);

        if ($customer !== null) {
            $customer->xmlSerialize($request);
        }

        if ($redirectTo !== null) {
            $request->addChild('redirectURL', $redirectTo);
        }

        if ($maxUses !== null) {
            $request->addChild('maxUses', $maxUses);
        }

        if ($maxAge !== null) {
            $request->addChild('maxAge', $maxAge);
        }

        return $request;
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
