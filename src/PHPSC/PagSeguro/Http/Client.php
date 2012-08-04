<?php
namespace PHPSC\PagSeguro\Http;

use \PHPSC\PagSeguro\Error\HttpException;
use \PHPSC\PagSeguro\Error\PagSeguroException;
use \PHPSC\PagSeguro\Error\ConnectionException;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class Client
{
    /**
     * @var int
     */
    private $timeout;

    /**
     * @var boolean
     */
    private $verifySSL;

    /**
     * @var string
     */
    private $charset;

    /**
     * @param int $timeout
     * @param boolean $verifySSL
     */
    public function __construct(
        $timeout = 10,
        $verifySSL = false,
        $charset = 'UTF-8'
    ) {
        $this->timeout = $timeout;
        $this->verifySSL = $verifySSL;
        $this->charset = $charset;
    }

    /**
     * @param string $url
     * @param array $fields
     * @return string
     */
    public function post($url, array $fields = null)
    {
        $params = $this->getDefaultParameters();
        $params[CURLOPT_URL] = $url;
        $params[CURLOPT_POST] = true;

        if ($fields) {
            $params[CURLOPT_POSTFIELDS] = http_build_query($fields, '', '&');
        }

        return $this->sendRequest($params);
    }

    /**
     * @param string $url
     * @return string
     */
    public function get($url)
    {
        $params = $this->getDefaultParameters();
        $params[CURLOPT_URL] = $url;
        $params[CURLOPT_HTTPGET] = true;

        return $this->sendRequest($params);
    }

    /**
     * @return array
     */
    protected function getDefaultParameters()
    {
        return array(
            CURLOPT_SSL_VERIFYPEER => $this->verifySSL,
            CURLOPT_CONNECTTIMEOUT => $this->timeout,
            CURLOPT_HEADER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded; charset='
                . $this->charset
            )
        );
    }

    /**
     * @param array $options
     * @return array
     * @throws \PHPSC\PagSeguro\Error\ConnectionException
     */
    protected function sendRequest(array $options)
    {
        $handler = curl_init();

        curl_setopt_array($handler, $options);
        $response = curl_exec($handler);

        if ($response === false) {
            $error = new ConnectionException(
                curl_error($handler),
                curl_errno($handler)
            );
        } else {
            $error = $this->parseHttpErrors($handler, $response);
        }

        curl_close($handler);

        if (isset($error)) {
            throw $error;
        }

        return $response;
    }

    /**
     * @param resource $handler
     * @param string $response
     * @return \PHPSC\PagSeguro\Error\PagSeguroException|\PHPSC\PagSeguro\Error\HttpException
     */
    protected function parseHttpErrors($handler, $response)
    {
        $httpCode = curl_getinfo($handler, CURLINFO_HTTP_CODE);

        if ($httpCode == 200) {
            return null;
        }

        if ($httpCode == 400) {
            return PagSeguroException::createFromXml($response);
        }

        return new HttpException(
            '[' . $httpCode . '] A HTTP error has occurred: ' . $response
        );
    }
}