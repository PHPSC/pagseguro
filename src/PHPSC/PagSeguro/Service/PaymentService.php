<?php

namespace PHPSC\PagSeguro\Service;

use PHPSC\PagSeguro\ValueObject\Payment\PaymentResponse;
use PHPSC\PagSeguro\ValueObject\Payment\PaymentRequest;
use PHPSC\PagSeguro\ValueObject\Credentials;
use PHPSC\PagSeguro\Codec\PaymentEncoder;
use PHPSC\PagSeguro\Codec\PaymentDecoder;
use PHPSC\PagSeguro\Http\Client;

class PaymentService
{
    /**
     * @var string
     */
    const ENDPOINT = 'https://ws.pagseguro.uol.com.br/v2/checkout';

    /**
     * @var \PHPSC\PagSeguro\ValueObject\Credentials
     */
    private $credentials;

    /**
     * @var \PHPSC\PagSeguro\Http\Client
     */
    private $client;

    /**
     * @var \PHPSC\PagSeguro\Codec\PaymentEncoder
     */
    private $encoder;

    /**
     * @var \PHPSC\PagSeguro\Codec\PaymentDecoder
     */
    private $decoder;

    /**
     * @param \PHPSC\PagSeguro\ValueObject\Credentials $credentials
     * @param \PHPSC\PagSeguro\Http\Client $client
     * @param \PHPSC\PagSeguro\Codec\PaymentEncoder $encoder
     * @param \PHPSC\PagSeguro\Codec\PaymentDecoder $decoder
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
     * @param \PHPSC\PagSeguro\ValueObject\Payment\PaymentRequest $request
     * @return \PHPSC\PagSeguro\ValueObject\Payment\PaymentResponse
     */
    public function send(PaymentRequest $request)
    {
        $content = $this->client->post(
            static::ENDPOINT,
            $this->encoder->encode($this->credentials, $request)
        );

        return $this->decoder->decode($content);
    }
}
