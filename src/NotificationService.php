<?php
namespace PHPSC\PagSeguro;

interface NotificationService
{
    const TYPE_TRANSACTION = 'transaction';

    /**
     * @var string
     */
    const TRANSACTION = '/v2/transactions/notifications';

    /**
     * @param string $type
     * @param string $code
     *
     * @return Charge
     */
    public function getByCode($type, $code);
}
