<?php
namespace PHPSC\PagSeguro;

use PHPSC\PagSeguro\Subscriptions\SubscriptionRequest;

interface SubscriptionService
{
    /**
     * @var string
     */
    const REDIRECT_TO = 'https://pagseguro.uol.com.br/v2/pre-approvals/request.html';

    /**
     * @var string
     */
    const SANDBOX_REDIRECT_TO = 'https://sandbox.pagseguro.uol.com.br/v2/pre-approvals/request.html';

    /**
     * @var string
     */
    const ENDPOINT = '/v2/pre-approvals';

    /**
     * @param SubscriptionRequest $request
     * @param Customer $customer
     * @param string $redirectTo
     * @param string $reviewUrl
     *
     * @return Redirection
     */
    public function subscribe(
        SubscriptionRequest $request,
        Customer $customer = null,
        $redirectTo = null,
        $reviewUrl = null
    );

    /**
     * @param string $code
     */
    public function cancel($code);

    /**
     * @param string $code
     * @param array $items
     * @param string $reference
     */
    public function pay($code, array $items, $reference = null);
}
