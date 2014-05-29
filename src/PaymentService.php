<?php
namespace PHPSC\PagSeguro;

use PHPSC\PagSeguro\Checkout\Response;
use PHPSC\PagSeguro\Checkout\Checkout;
use PHPSC\PagSeguro\Credentials;
use PHPSC\PagSeguro\Checkout\Encoder;
use PHPSC\PagSeguro\Checkout\Decoder;
use PHPSC\PagSeguro\Http\Client;

class PaymentService extends BaseService
{
    /**
     * @var string
     */
    const ENDPOINT = '/v2/checkout';

    /**
     * @var Encoder
     */
    private $encoder;

    /**
     * @var Decoder
     */
    private $decoder;

    /**
     * @param Credentials $credentials
     * @param Client $client
     * @param Encoder $encoder
     * @param Decoder $decoder
     */
    public function __construct(
        Credentials $credentials,
        Client $client = null,
        Encoder $encoder = null,
        Decoder $decoder = null
    ) {
        parent::__construct($credentials, $client);

        $this->encoder = $encoder ?: new Encoder();
        $this->decoder = $decoder ?: new Decoder();
    }

    /**
     * @param Checkout $checkout
     *
     * @return Response
     */
    public function checkout(Checkout $checkout)
    {
        return $this->decoder->decode(
            $this->post(static::ENDPOINT, $this->encoder->encode($checkout)),
            $this->isSandbox()
        );
    }
}
