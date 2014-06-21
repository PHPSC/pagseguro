<?php
namespace PHPSC\PagSeguro\Purchases;

use DateTime;
use PHPSC\PagSeguro\Item;
use PHPSC\PagSeguro\BaseDecoder;
use PHPSC\PagSeguro\Shipping;
use SimpleXMLElement;

class TransactionDecoder extends BaseDecoder
{
    /**
     * @param SimpleXMLElement $obj
     *
     * @return Transaction
     */
    public function decode(SimpleXMLElement $obj)
    {
        return new Transaction(
            $this->createDetails($obj),
            $this->createPayment($obj),
            (int) $obj->type,
            $this->createItems($obj->items),
            $this->createShipping($obj->shipping)
        );
    }

    /**
     * @param SimpleXMLElement $obj
     * @return PaymentDetails
     */
    protected function createPayment(SimpleXMLElement $obj)
    {
        return new PaymentDetails(
            new PaymentMethod(
                (int) $obj->paymentMethod->type,
                (int) $obj->paymentMethod->code
            ),
            (float) $obj->grossAmount,
            (float) $obj->discountAmount,
            (float) $obj->feeAmount,
            (float) $obj->netAmount,
            (float) $obj->extraAmount,
            (int) $obj->installmentCount,
            isset($obj->escrowEndDate) ? new DateTime((string) $obj->escrowEndDate) : null
        );
    }

    /**
     * @param SimpleXMLElement $itemsNode
     * @return array
     */
    protected function createItems(SimpleXMLElement $itemsNode)
    {
        $items = array();

        foreach ($itemsNode->item as $item) {
            $items[] = new Item(
                (string) $item->id,
                (string) $item->description,
                (float) $item->amount,
                (int) $item->quantity,
                isset($item->shippingCost) ? (float) $item->shippingCost : null,
                isset($item->weight) ? (int) $item->weight : null
            );
        }

        return $items;
    }

    /**
     * @param SimpleXMLElement $shipping
     * @return Shipping
     */
    protected function createShipping(SimpleXMLElement $shipping)
    {
        return new Shipping(
            (int) $shipping->type,
            isset($shipping->address) ? $this->createAddress($shipping->address) : null,
            isset($shipping->cost) ? (float) $shipping->cost : null
        );
    }
}
