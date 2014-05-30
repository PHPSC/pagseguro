<?php
namespace PHPSC\PagSeguro\Checkout;

use DateTime;
use PHPSC\PagSeguro\BaseService;
use PHPSC\PagSeguro\CheckoutService as CheckoutServiceInterface;
use PHPSC\PagSeguro\Client;
use PHPSC\PagSeguro\Credentials;
use SimpleXMLElement;

class CheckoutService extends BaseService implements CheckoutServiceInterface
{
    /**
     * @var Encoder
     */
    private $encoder;

    /**
     * @param Credentials $credentials
     * @param Client $client
     * @param Encoder $encoder
     */
    public function __construct(
        Credentials $credentials,
        Client $client = null,
        Encoder $encoder = null
    ) {
        parent::__construct($credentials, $client);

        $this->encoder = $encoder ?: new Encoder();
    }

    /**
     * @param Checkout $checkout
     *
     * @return Response
     */
    public function checkout(Checkout $checkout)
    {
        return $this->decode(
            $this->post(static::ENDPOINT, $this->encoder->encode($checkout)),
            $this->isSandbox()
        );
    }

    /**
     * @param SimpleXMLElement $obj
     * @param boolean $sandbox
     *
     * @return Response
     */
    protected function decode(SimpleXMLElement $obj)
    {
        return new Response(
            (string) $obj->code,
            new DateTime((string) $obj->date),
            $this->isSandbox() ? static::SANDBOX_REDIRECT_TO : static::REDIRECT_TO
        );
    }
}
