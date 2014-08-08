<?php
namespace PHPSC\PagSeguro\Shipping;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class Type
{
    /**
     * @var int
     */
    const TYPE_PAC = 1;

    /**
     * @var int
     */
    const TYPE_SEDEX = 2;

    /**
     * @var int
     */
    const TYPE_UNKNOWN = 3;

    /**
     * @return array
     */
    public static function getTypes()
    {
        return [static::TYPE_PAC, static::TYPE_SEDEX, static::TYPE_UNKNOWN];
    }

    /**
     * @param int $type
     * @return boolean
     */
    public static function isValid($type)
    {
        return in_array($type, static::getTypes());
    }
}
