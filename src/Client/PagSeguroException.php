<?php
namespace PHPSC\PagSeguro\Client;

use Guzzle\Http\Message\Response;

class PagSeguroException extends \RuntimeException
{
    /**
     * @param Response $response
     *
     * @return PagSeguroException
     */
    public static function create(Response $response)
    {
        return new static(static::createMessage($response));
    }

    /**
     * @param Response $response
     *
     * @return string
     */
    protected static function createMessage(Response $response)
    {
        if ($response->getStatusCode() != 400) {
            return  '[' . $response->getStatusCode() . '] A HTTP error has occurred: ' . $response->getBody(true);
        }

        $message = 'Some errors occurred:';

        foreach ($response->xml()->error as $error) {
            $message .= PHP_EOL . '[' . (string) $error->code . '] ' . (string) $error->message;
        }

        return $message;
    }
}
