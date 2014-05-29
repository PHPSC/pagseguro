<?php
namespace PHPSC\PagSeguro\Checkout;

use PHPSC\PagSeguro\BaseService;
use PHPSC\PagSeguro\CheckoutService as CheckoutServiceInterface;
use PHPSC\PagSeguro\Client;
use PHPSC\PagSeguro\Credentials;

class CheckoutService extends BaseService implements CheckoutServiceInterface
{
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
