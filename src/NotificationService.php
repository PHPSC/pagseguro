<?php
namespace PHPSC\PagSeguro;

interface NotificationService
{
    const TYPE_TRANSACTION = 'transaction';

    /**
     * @param string $type
     * @param string $code
     *
     * @return Transaction
     */
    public function getByNotification($type, $code);
}
