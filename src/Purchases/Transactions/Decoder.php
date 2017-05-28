<?php
namespace PHPSC\PagSeguro\Purchases\Transactions;

use DateTime;
use PHPSC\PagSeguro\Items\Item;
use PHPSC\PagSeguro\Items\Items;
use PHPSC\PagSeguro\Purchases\Decoder as BaseDecoder;
use PHPSC\PagSeguro\Shipping\Shipping;
use SimpleXMLElement;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class Decoder extends BaseDecoder
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
     * @return Payment
     */
    protected function createPayment(SimpleXMLElement $obj)
    {
        return new Payment(
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
     *
     * @return Items
     */
    protected function createItems(SimpleXMLElement $itemsNode)
    {
        $items = new Items();

        foreach ($itemsNode->item as $item) {
            $items->add(
                new Item(
                    (string) $item->id,
                    (string) $item->description,
                    (float) $item->amount,
                    (int) $item->quantity,
                    isset($item->shippingCost) ? (float) $item->shippingCost : null,
                    isset($item->weight) ? (int) $item->weight : null
                )
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
