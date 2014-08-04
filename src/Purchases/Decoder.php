<?php
namespace PHPSC\PagSeguro\Purchases;

use DateTime;
use PHPSC\PagSeguro\Customer\Address;
use PHPSC\PagSeguro\Customer\Customer;
use PHPSC\PagSeguro\Customer\Phone;
use SimpleXMLElement;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
abstract class Decoder
{
    /**
     * @param SimpleXMLElement $obj
     *
     * @return Details
     */
    protected function createDetails(SimpleXMLElement $obj)
    {
        return new Details(
            (string) $obj->code,
            isset($obj->reference) ? (string) $obj->reference : null,
            (string) $obj->status,
            new DateTime((string) $obj->date),
            new DateTime((string) $obj->lastEventDate),
            $this->createCustomer($obj->sender)
        );
    }

    /**
     * @param SimpleXMLElement $address
     *
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
     *
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
            $phone,
            isset($customer->address) ? $this->createAddress($customer->address) : null
        );
    }
}
