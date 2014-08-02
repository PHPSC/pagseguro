<?php
namespace PHPSC\PagSeguro\Subscriptions;

use PHPSC\PagSeguro\Service\BaseService;
use PHPSC\PagSeguro\SubscriptionService as SubscriptionServiceInterface;
use PHPSC\PagSeguro\Customer\Customer;

class SubscriptionService extends BaseService implements SubscriptionServiceInterface
{
    /**
     * {@inheritdoc}
     */
    public function subscribe(
        SubscriptionRequest $request,
        Customer $customer = null,
        $redirectTo = null,
        $reviewUrl = null
    ) {
    }

    /**
     * {@inheritdoc}
     */
    public function cancel($code)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function pay($code, array $items, $reference = null)
    {
    }
}
