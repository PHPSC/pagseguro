<?php
namespace PHPSC\PagSeguro\Requests;

use PHPSC\PagSeguro\Requests\PreApprovals\PreApproval;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
interface PreApprovalService
{
    /**
     * @var string
     */
    const REDIRECT_TO = 'https://pagseguro.uol.com.br/v2/pre-approvals/request.html';

    /**
     * @var string
     */
    const SANDBOX_REDIRECT_TO = 'https://sandbox.pagseguro.uol.com.br/v2/pre-approvals/request.html';

    /**
     * @param PreApproval $approval
     *
     * @return Redirection
     */
    public function approve(PreApproval $approval);
}
