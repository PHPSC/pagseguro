<?php
namespace PHPSC\PagSeguro\Client;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use SimpleXMLElement;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class Client
{
    private $client;

    /**
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client = null)
    {
        $this->client = $client ?: new HttpClient();
    }

    /**
     * @param string $url
     * @param SimpleXMLElement $body
     *
     * @return SimpleXMLElement
     */
    public function post($url, SimpleXMLElement $body)
    {
        try {
            $response = $this->client->request(
                'POST',
                $url,
                [
                    'headers' => ['Content-Type' => 'application/xml; charset=UTF-8'],
                    'body'    => $body->asXML(),
                    'verify'  => false
                ]
            );

            return new SimpleXMLElement($response->getBody());
        } catch (RequestException $e) {
            throw PagSeguroException::create($e->getResponse(), $e);
        }
    }

    /**
     * @param string $url
     *
     * @return SimpleXMLElement
     */
    public function get($url)
    {
        try {
            $response = $this->client->request('GET', $url, ['verify' => false]);

            return new SimpleXMLElement($response->getBody());
        } catch (RequestException $e) {
            throw PagSeguroException::create($e->getResponse(), $e);
        }
    }
}
