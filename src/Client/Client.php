<?php
namespace PHPSC\PagSeguro\Client;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\RequestException;
use SimpleXMLElement;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 * @author Paulo Peixoto Filho <rfoxtrot@gmail.com>
 */

class Client {
	/**
	 * @var HttpClient
	 */
	private $client;
	private $handler;

	/**
	 * @param HttpClient $client
	 */
	public function __construct(HttpClient $client = null) {
		$this->client = $client ?: new HttpClient();
	}

	/**
	 * @param string $url
	 * @param SimpleXMLElement $body
	 *
	 * @return SimpleXMLElement
	 */
	public function post($url, SimpleXMLElement $body) {

		try {
			$response = $this->client->post($url, ['headers' => ['Content-Type' => 'application/xml; charset=UTF-8'], 'body' => $body->asXML(), 'verify' => false]);
		} catch (RequestException $e) {
			throw PagSeguroException::create($e->getMessage());
		}

		return (string) $response->getBody();
	}

	/**
	 * @param string $url
	 *
	 * @return SimpleXMLElement
	 */
	public function get($url) {
		try {
			$response = $this->client->get($url, ['verify' => false]);
		} catch (RequestException $e) {
			throw PagSeguroException::create($e->getMessage());
		}

		return (string) $response->getBody();
	}
}
