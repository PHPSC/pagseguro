<?php
namespace PHPSC\PagSeguro\Client;

use Guzzle\Common\Event;
use Guzzle\Http\Client as HttpClient;
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
        $this->client->getEventDispatcher()->addListener('request.error', array($this, 'handleError'));
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
     * @param string $resource
     * @param boolean $sandbox
     *
     * @return string
     */
    public function createUri($resource, $sandbox = false)
    {
        return Environment::createUri($resource, $sandbox);
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
            array('Content-Type' => 'application/xml; charset=UTF-8'),
            $body->asXML(),
            array('verify' => false)
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
        $request = $this->client->get($url, null, array('verify' => false));

        return $request->send()->xml();
    }
}
