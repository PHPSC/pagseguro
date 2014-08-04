<?php
namespace PHPSC\PagSeguro\Purchases;

use PHPSC\PagSeguro\Purchases\Transactions\Transaction;
use PHPSC\PagSeguro\Purchases\Subscriptions\Subscription;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
interface NotificationService
{
    /**
     * @param string $code
     *
     * @return Transaction|Subscription
     */
    public function getByNotification($code);
}
