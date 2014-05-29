<?php
namespace PHPSC\PagSeguro\ValueObject;

class PaymentMethod
{
    /**
     * @var int
     */
    private $type;

    /**
     * @var int
     */
    private $code;

    /**
     * @param int $type
     * @param int $code
     */
    public function __construct($type, $code)
    {
        $this->type = $type;
        $this->code = $code;
    }

    /**
     * @return number
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return number
     */
    public function getCode()
    {
        return $this->code;
    }
}
