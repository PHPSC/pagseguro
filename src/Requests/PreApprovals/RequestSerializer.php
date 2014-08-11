<?php
namespace PHPSC\PagSeguro\Requests\PreApprovals;

use DateTime;
use PHPSC\PagSeguro\Requests\Serializer;
use SimpleXMLElement;

/**
 * @author Luís Otávio Cobucci Oblonczyk Oblonczyk <lcobucci@gmail.com>
 */
class RequestSerializer extends Serializer
{
    /**
     * @param Request $request
     *
     * @return SimpleXMLElement
     */
    public function serialize(Request $request)
    {
        $xml = simplexml_load_string('<?xml version="1.0" encoding="UTF-8"?><preApprovalRequest />');

        $this->appendRequest($xml, $request);

        return $xml;
    }

    /**
     * @param SimpleXMLElement $xml
     * @param Request $request
     */
    private function appendRequest(SimpleXMLElement $xml, Request $request)
    {
        $this->appendCustomer($xml, $request->getCustomer());
        $this->appendPreApproval($xml, $request->getPreApproval());

        if ($reference = $request->getReference()) {
            $xml->addChild('reference', $reference);
        }

        if ($reviewOn = $request->getReviewOn()) {
            $xml->addChild('reviewURL', $reviewOn);
        }

        if ($redirectTo = $request->getRedirectTo()) {
            $xml->addChild('redirectURL', $redirectTo);
        }
    }

    /**
     * @param SimpleXMLElement $xml
     * @param PreApproval $approval
     */
    private function appendPreApproval(SimpleXMLElement $xml, PreApproval $approval)
    {
        $child = $xml->addChild('preApproval');
        $child->addChild('charge', $approval->getChargeType());
        $child->addChild('name', substr($approval->getName(), 0, 100));
        $child->addChild('period', $approval->getPeriod());
        $child->addChild('finalDate', $approval->getFinalDate()->format(DateTime::W3C));
        $child->addChild('maxTotalAmount', number_format($approval->getMaxTotalAmount(), 2, '.', ''));

        if ($details = $approval->getDetails()) {
            $child->addChild('details', substr($details, 0, 255));
        }

        if ($amountPerPayment = $approval->getAmountPerPayment()) {
            $child->addChild('amountPerPayment', number_format($amountPerPayment, 2, '.', ''));
        }

        if ($maxAmountPerPayment = $approval->getMaxAmountPerPayment()) {
            $child->addChild('maxAmountPerPayment', number_format($maxAmountPerPayment, 2, '.', ''));
        }

        if ($initialDate = $approval->getInitialDate()) {
            $child->addChild('initialDate', $initialDate->format(DateTime::W3C));
        }

        if ($maxPaymentsPerPeriod = $approval->getMaxPaymentsPerPeriod()) {
            $child->addChild('maxPaymentsPerPeriod', (int) $maxPaymentsPerPeriod);
        }

        if ($maxAmountPerPeriod = $approval->getMaxAmountPerPeriod()) {
            $child->addChild('maxAmountPerPeriod', number_format($maxAmountPerPeriod, 2, '.', ''));
        }
    }
}
