<?php
namespace PHPSC\PagSeguro\Error;

use \SimpleXMLElement;

class PagSeguroException extends \RuntimeException
{
    /**
     * @param string $xml
     * @return \PHPSC\PagSeguro\Error\PagSeguroException
     */
    public static function createFromXml($xml)
    {
        $message = 'Some errors occurred:';
        $obj = new SimpleXMLElement($xml);

        foreach ($obj->error as $erro) {
            $message .= PHP_EOL
                        . '[' . (string) $erro->code . '] '
                        . (string) $erro->message;
        }

        return new PagSeguroException($message);
    }
}