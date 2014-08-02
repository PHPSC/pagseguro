<?php
namespace PHPSC\PagSeguro\Purchases;

use PHPSC\PagSeguro\Purchases\Transactions\Transaction;
use PHPSC\PagSeguro\Purchases\Subscriptions\Subscription;

interface NotificationService
{
    /**
     * @param string $code
     *
     * @return Transaction|Subscription
     */
    public function getByNotification($code);
}
