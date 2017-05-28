<?php
namespace PHPSC\PagSeguro\Requests\PreApprovals;

use PHPSC\PagSeguro\Requests\PreApprovalService as PreApprovalServiceInterface;
use PHPSC\PagSeguro\Requests\Service;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class PreApprovalService extends Service implements PreApprovalServiceInterface
{
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
            $request->xmlSerialize()
        );

        return $this->getRedirection($response);
    }
}
