<?php
namespace PHPSC\PagSeguro\Requests\PreApprovals;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class Period
{
    /**
     * @var string
     */
    const WEEKLY = 'WEEKLY';

    /**
     * @var string
     */
    const MONTHLY = 'MONTHLY';

    /**
     * @var string
     */
    const BIMONTHLY = 'BIMONTHLY';

    /**
     * @var string
     */
    const TRIMONTHLY = 'TRIMONTHLY';

    /**
     * @var string
     */
    const SEMESTRALLY = 'SEMIANNUALLY';

    /**
     * @var string
     */
    const YEARLY = 'YEARLY';

    /**
     * @return array
     */
    protected static function getPeriods()
    {
        return [
            static::WEEKLY,
            static::MONTHLY,
            static::BIMONTHLY,
            static::TRIMONTHLY,
            static::SEMESTRALLY,
            static::YEARLY
        ];
    }

    /**
     * @param string $period
     *
     * @return boolean
     */
    public static function isValid($period)
    {
        return in_array($period, static::getPeriods());
    }
}
