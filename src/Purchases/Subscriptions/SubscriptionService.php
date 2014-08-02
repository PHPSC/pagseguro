<?php
namespace PHPSC\PagSeguro\Purchases\Subscriptions;

use PHPSC\PagSeguro\Purchases\SubscriptionService as SubscriptionServiceInterface;
use PHPSC\PagSeguro\Service;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class SubscriptionService extends Service implements SubscriptionServiceInterface
{
    /**
     * {@inheritdoc}
     */
    public function cancel($code)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function pay(Charge $charge)
    {
    }
}
