<?php
namespace PHPSC\PagSeguro\Requests\PreApprovals;

use PHPSC\PagSeguro\Client\Client;
use PHPSC\PagSeguro\Credentials;
use PHPSC\PagSeguro\Requests\PreApprovalService as PreApprovalServiceInterface;
use PHPSC\PagSeguro\Requests\Service;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class PreApprovalService extends Service implements PreApprovalServiceInterface
{
    /**
     * @var RequestSerializer
     */
    private $serializer;

    /**
     * @param Credentials $credentials
     * @param Client $client
     * @param RequestSerializer $serializer
     */
    public function __construct(
        Credentials $credentials,
        Client $client = null,
        RequestSerializer $serializer = null
    ) {
        parent::__construct($credentials, $client);

        $this->serializer = $serializer ?: new RequestSerializer();
    }

    /**
     * {@inheritdoc}
     */
    public function createRequestBuilder($manualCharge = true)
    {
        return new RequestBuilder($manualCharge);
    }

    /**
     * {@inheritdoc}
     */
    public function approve(Request $request)
    {
        $response = $this->post(
            static::ENDPOINT,
            $this->serializer->serialize($request)
        );

        return $this->getRedirection($response);
    }
}
