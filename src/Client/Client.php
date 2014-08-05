<?php
namespace PHPSC\PagSeguro\Client;

use Guzzle\Common\Event;
use Guzzle\Http\Client as HttpClient;
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
        $this->client->getEventDispatcher()->addListener('request.error', [$this, 'handleError']);
    }

    /**
     * @param Event $event
     *
     * @throws PagSeguroException
     */
    public function handleError(Event $event)
    {
        if (!Environment::isValid($event['request']->getHost())) {
            return ;
        }

        throw PagSeguroException::create($event['response']);
    }

    /**
     * @param string $url
     * @param SimpleXMLElement $body
     *
     * @return SimpleXMLElement
     */
    public function post($url, SimpleXMLElement $body)
    {
        $request = $this->client->post(
            $url,
            ['Content-Type' => 'application/xml; charset=UTF-8'],
            $body->asXML(),
            ['verify' => false]
        );

        return $request->send()->xml();
    }

    /**
     * @param string $url
     *
     * @return SimpleXMLElement
     */
    public function get($url)
    {
        $request = $this->client->get($url, null, ['verify' => false]);

        return $request->send()->xml();
    }
}
