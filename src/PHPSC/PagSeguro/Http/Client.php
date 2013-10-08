<?php
namespace PHPSC\PagSeguro\Http;

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
     * @param HttpClient $client
     * @param array $clientConfig
     */
    public function __construct(
        HttpClient $client = null,
        array $clientConfig = array()
    ) {
        $this->client = $client ?: new HttpClient();

        $this->configureClient($clientConfig);
    }

    /**
     * @param array $config
     * @throws HttpException
     */
    protected function configureClient(array $config)
    {
        $this->client->getConfig()->merge($this->getDefaultConfiguration());
        $this->client->getConfig()->merge($config);

        $this->client->getEventDispatcher()->addListener(
            'request.error',
            function (Event $event) {
                $response = $event['response'];

                if ($response->getStatusCode() == 400) {
                    throw PagSeguroException::createFromXml($response->xml());
                }

                throw new HttpException(
                    '[' . $response->getStatusCode() . '] A HTTP error has occurred: '
                    . $response->getBody(true)
                );
            }
        );
    }

    /**
     * @return array
     */
    protected function getDefaultConfiguration()
    {
        return array(
            'curl.options' => array(
                CURLOPT_CONNECTTIMEOUT => 10,
                CURLOPT_SSL_VERIFYPEER => false,
            )
        );
    }

    /**
     * @param string $url
     * @param array $fields
     * @return SimpleXMLElement
     */
    public function post($url, array $fields = null)
    {
        $request = $this->client->post(
            $url,
            null,
            $fields ? http_build_query($fields, '', '&') : null,
            array(
                'headers' => array(
                    'Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8'
                )
            )
        );

        $response = $request->send();

        return $response->xml();
    }

    /**
     * @param string $url
     * @return SimpleXMLElement
     */
    public function get($url)
    {
        $request = $this->client->get($url);
        $response = $request->send();

        return $response->xml();
    }
}
