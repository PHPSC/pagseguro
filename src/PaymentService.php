<?php
namespace PHPSC\PagSeguro;

use PHPSC\PagSeguro\ValueObject\Payment\PaymentResponse;
use \PHPSC\PagSeguro\ValueObject\Payment\PaymentRequest;
use \PHPSC\PagSeguro\ValueObject\Credentials;
use \PHPSC\PagSeguro\Codec\PaymentEncoder;
use \PHPSC\PagSeguro\Codec\PaymentDecoder;
use \PHPSC\PagSeguro\Http\Client;

class PaymentService extends BaseService
{
    /**
     * @var string
     */
    const ENDPOINT = '/v2/checkout';

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
        parent::__construct($credentials, $client);

        $this->encoder = $encoder ?: new PaymentEncoder();
        $this->decoder = $decoder ?: new PaymentDecoder();
    }

    /**
     * @param PaymentRequest $request
     * @return PaymentResponse
     */
    public function checkout(PaymentRequest $request)
    {
        return $this->decoder->decode(
            $this->post(static::ENDPOINT, $this->encoder->encode($request)),
            $this->isSandbox()
        );
    }
}
