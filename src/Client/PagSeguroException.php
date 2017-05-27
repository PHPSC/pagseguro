<?php

namespace PHPSC\PagSeguro\Client;

use Psr\Http\Message\ResponseInterface;

class PagSeguroException extends \RuntimeException
{
    /**
     * @param ResponseInterface $response
     *
     * @return PagSeguroException
     */
    public static function create(ResponseInterface $response)
    {
        return new static(static::createMessage($response));
    }

    /**
     * @param ResponseInterface $response
     *
     * @return string
     */
    protected static function createMessage(ResponseInterface $response)
    {
        if ($response->getStatusCode() != 400) {
            return  '[' . $response->getStatusCode() . '] A HTTP error has occurred: ' . $response->getBody(true);
        }

        $message = 'Some errors occurred:';
        $content = new \SimpleXMLElement($response->getBody()->getContents());

        foreach ($content->error as $error) {
            $message .= PHP_EOL . '[' . (string) $error->code . '] ' . (string) $error->message;
        }

        return $message;
    }
}
