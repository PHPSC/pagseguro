<?php
namespace PHPSC\PagSeguro;

use PHPSC\PagSeguro\Subscriptions\Subscription;
use PHPSC\PagSeguro\Purchases\Transaction;

interface NotificationService
{
    /**
     * @param string $code
     *
     * @return Transaction|Subscription
     */
    public function getByNotification($code);
}
