<?php
namespace PHPSC\PagSeguro\Http;

use PHPSC\PagSeguro\Error\ConnectionException;
use PHPSC\PagSeguro\Error\PagSeguroException;
use PHPSC\PagSeguro\Error\HttpException;
use Guzzle\Http\Client as HttpClient;
use Guzzle\Common\Event;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class Client
{
    /**
     * @var HttpClient
     */
    private $client;

    /**
     * @param int $timeout
     * @param boolean $verifySSL
     */
    public function __construct(
        $timeout = 10,
        $verifySSL = false,
        $charset = 'UTF-8'
    ) {
        $this->client = new HttpClient(
            '',
            array(
                'curl.options' => array(
                    CURLOPT_CONNECTTIMEOUT => $timeout,
                    CURLOPT_SSL_VERIFYPEER => $verifySSL,
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/x-www-form-urlencoded; charset=' . $charset
                    )
                )
            )
        );

        $this->client->getEventDispatcher()->addListener(
            'request.error',
            function (Event $event) {
                $response = $event['response'];

                if ($response->getStatusCode() == 400) {
                    $error = PagSeguroException::createFromXml(
                        $response->getBody(true)
                    );

                    throw new $error;
                }

                throw new HttpException(
                    '[' . $response->getStatusCode() . '] A HTTP error has occurred: '
                    . $response->getBody(true)
                );
            }
        );
    }

    /**
     * @param string $url
     * @param array $fields
     * @return string
     */
    public function post($url, array $fields = null)
    {
        $request = $this->client->post(
            $url,
            null,
            $fields ? http_build_query($fields, '', '&') : null
        );

        $response = $request->send();

        return $response->getBody(true);
    }

    /**
     * @param string $url
     * @return string
     */
    public function get($url)
    {
        $request = $this->client->get($url);
        $response = $request->send();

        return $response->getBody(true);
    }
}
