<?php
namespace PHPSC\PagSeguro\Requests;

use PHPSC\PagSeguro\Requests\PreApprovals\Request;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
interface PreApprovalService
{
    /**
     * @var string
     */
    const ENDPOINT = '/v2/pre-approvals/request';

    /**
     * @var string
     */
    const REDIRECT_TO = '/v2/pre-approvals/request.html';

    /**
     * @param boolean $manualCharge
     *
     * @return RequestBuilder
     */
    public function createRequestBuilder($manualCharge = true);

    /**
     * @param Request $request
     *
     * @return Redirection
     */
    public function approve(Request $request);
}
