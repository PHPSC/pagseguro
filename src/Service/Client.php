<?php
namespace PHPSC\PagSeguro\Service;

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
        if (!in_array($event['request']->getHost(), array(BaseService::HOST, BaseService::SANDBOX_HOST))) {
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
