<?php
namespace PHPSC\PagSeguro\Requests\Checkout;

use PHPSC\PagSeguro\Requests\CheckoutService as CheckoutServiceInterface;
use PHPSC\PagSeguro\Requests\Service;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class CheckoutService extends Service implements CheckoutServiceInterface
{
    /**
     * {@inheritdoc}
     */
    public function createCheckoutBuilder()
    {
        return new CheckoutBuilder();
    }

    /**
     * {@inheritdoc}
     */
    public function checkout(Checkout $checkout)
    {
        $response = $this->post(
            static::ENDPOINT,
            $checkout->xmlSerialize()
        );

        return $this->getRedirection($response);
    }
}
