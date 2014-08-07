<?php
namespace PHPSC\PagSeguro\Requests\PreApprovals;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmai.com>
 */
class ChargeType
{
    /**
     * @var string
     */
    const AUTOMATIC = 'auto';

    /**
     * @var string
     */
    const MANUAL = 'manual';

    /**
     * @param string $type
     *
     * @return boolean
     */
    public static function isValid($type)
    {
        return in_array($type, [static::AUTOMATIC, static::MANUAL]);
    }
}
