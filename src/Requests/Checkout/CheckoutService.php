<?php
namespace PHPSC\PagSeguro\Requests\Checkout;

use DateTime;
use PHPSC\PagSeguro\Requests\CheckoutService as CheckoutServiceInterface;
use PHPSC\PagSeguro\Requests\Redirection;
use PHPSC\PagSeguro\Service;
use SimpleXMLElement;
use PHPSC\PagSeguro\Credentials;
use PHPSC\PagSeguro\Client\Client;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class CheckoutService extends Service implements CheckoutServiceInterface
{
    /**
     * @var CheckoutSerializer
     */
    private $serializer;

    /**
     * @param Credentials $credentials
     * @param Client $client
     * @param CheckoutSerializer $serializer
     */
    public function __construct(
        Credentials $credentials,
        Client $client = null,
        CheckoutSerializer $serializer = null
    ) {
        parent::__construct($credentials, $client);

        $this->serializer = $serializer ?: new CheckoutSerializer();
    }

    /**
     * {@inheritdoc}
     */
    public function createCheckoutBuilder()
    {
        return new CheckoutBuilder();
    }

    /**
     * {@inheritdoc}
     */
    public function checkout(Checkout $checkout)
    {
        $response = $this->post(
            static::ENDPOINT,
            $this->serializer->serialize($checkout)
        );

        return $this->getRedirection($response);
    }

    /**
     * @param SimpleXMLElement $obj
     *
     * @return Response
     */
    protected function getRedirection(SimpleXMLElement $obj)
    {
        return new Redirection(
            (string) $obj->code,
            new DateTime((string) $obj->date),
            $this->credentials->getUrl(static::REDIRECT_TO)
        );
    }
}
