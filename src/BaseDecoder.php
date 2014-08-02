<?php
namespace PHPSC\PagSeguro;

use DateTime;
use PHPSC\PagSeguro\Customer\Address;
use PHPSC\PagSeguro\Customer\Customer;
use PHPSC\PagSeguro\Customer\Phone;
use SimpleXMLElement;

abstract class BaseDecoder
{
    /**
     * @param SimpleXMLElement $obj
     * @return TransactionDetails
     */
    protected function createDetails(SimpleXMLElement $obj)
    {
        return new TransactionDetails(
            (string) $obj->code,
            isset($obj->reference) ? (string) $obj->reference : null,
            (int) $obj->status,
            new DateTime((string) $obj->date),
            new DateTime((string) $obj->lastEventDate),
            $this->createCustomer($obj->sender)
        );
    }

    /**
     * @param SimpleXMLElement $address
     * @return Address
     */
    protected function createAddress(SimpleXMLElement $address)
    {
        return new Address(
            (string) $address->state,
            (string) $address->city,
            (string) $address->postalCode,
            (string) $address->district,
            (string) $address->street,
            (string) $address->number,
            (string) $address->complement
        );
    }

    /**
     * @param SimpleXMLElement $customer
     * @return Customer
     */
    protected function createCustomer(SimpleXMLElement $customer)
    {
        $phone = null;

        if (isset($customer->phone)) {
            $phone = new Phone(
                (string) $customer->phone->areaCode,
                (string) $customer->phone->number
            );
        }

        return new Customer(
            (string) $customer->email,
            isset($customer->name) ? (string) $customer->name : null,
            $phone
        );
    }
}
