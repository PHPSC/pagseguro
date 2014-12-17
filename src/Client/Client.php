<?php
namespace PHPSC\PagSeguro\Client;

use GuzzleHttp\Event\ErrorEvent as Event;
use GuzzleHttp\Client as HttpClient;
use PHPSC\PagSeguro\Environment;
use SimpleXMLElement;

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
     */
    public function __construct(HttpClient $client = null)
    {
        $this->client = $client ?: new HttpClient();
        $this->client->getEmitter()->on('error', [$this, 'handleError']);
    }

    /**
     * @param Event $event
     *
     * @throws PagSeguroException
     */
    public function handleError(Event $event)
    {
        if (!Environment::isValid($event->getRequest()->getHost())) {
            return ;
        }

        throw PagSeguroException::create($event->getResponse());
    }

    /**
     * @param string $url
     * @param SimpleXMLElement $body
     *
     * @return SimpleXMLElement
     */
    public function post($url, SimpleXMLElement $body)
    {
        $response = $this->client->post(
            $url,
            [
                'headers' => ['Content-Type' => 'application/xml; charset=UTF-8'],
                'body' => $body->asXML(),
                'verify' => false
            ]
        );

        return $response->xml();
    }

    /**
     * @param string $url
     *
     * @return SimpleXMLElement
     */
    public function get($url)
    {
        $response = $this->client->get($url, ['verify' => false]);

        return $response->xml();
    }
}
