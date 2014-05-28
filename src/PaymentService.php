<?php
namespace PHPSC\PagSeguro;

use PHPSC\PagSeguro\ValueObject\Payment\PaymentResponse;
use \PHPSC\PagSeguro\ValueObject\Payment\PaymentRequest;
use \PHPSC\PagSeguro\ValueObject\Credentials;
use \PHPSC\PagSeguro\Codec\PaymentEncoder;
use \PHPSC\PagSeguro\Codec\PaymentDecoder;
use \PHPSC\PagSeguro\Http\Client;

class PaymentService
{
    /**
     * @var string
     */
    const ENDPOINT = 'https://ws.pagseguro.uol.com.br/v2/checkout';

    /**
     * @var Credentials
     */
    private $credentials;

    /**
     * @var Client
     */
    private $client;

    /**
     * @var PaymentEncoder
     */
    private $encoder;

    /**
     * @var PaymentDecoder
     */
    private $decoder;

    /**
     * @param Credentials $credentials
     * @param Client $client
     * @param PaymentEncoder $encoder
     * @param PaymentDecoder $decoder
     */
    public function __construct(
        Credentials $credentials,
        Client $client = null,
        PaymentEncoder $encoder = null,
        PaymentDecoder $decoder = null
    ) {
        $this->credentials = $credentials;
        $this->client = $client ?: new Client();
        $this->encoder = $encoder ?: new PaymentEncoder();
        $this->decoder = $decoder ?: new PaymentDecoder();
    }

    /**
     * @param PaymentRequest $request
     * @return PaymentResponse
     */
    public function checkout(PaymentRequest $request)
    {
        $content = $this->client->post(
            static::ENDPOINT,
            $this->encoder->encode($this->credentials, $request)
        );

        return $this->decoder->decode($content);
    }
}
