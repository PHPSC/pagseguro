<?php
namespace PHPSC\PagSeguro;

use SimpleXMLElement;

class Customer implements XmlSerializable
{
    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $name;

    /**
     * @var Phone
     */
    private $phone;

    /**
     * @var Address
     */
    private $address;

    /**
     * @param string $email
     * @param string $name
     * @param Phone $phone
     * @param Address $address
     */
    public function __construct(
        $email,
        $name = null,
        Phone $phone = null,
        Address $address = null
    ) {
        $this->email = $email;
        $this->name = $name;
        $this->phone = $phone;
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return Phone
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * {@inheritdoc}
     */
    public function xmlSerialize(SimpleXMLElement $parent)
    {
        $customer = $parent->addChild('sender');
        $customer->addChild('email', substr($this->email, 0, 60));

        if ($this->name !== null) {
            $customer->addChild('name', substr($this->name, 0, 50));
        }

        if ($this->phone !== null) {
            $this->phone->xmlSerialize($customer);
        }

        if ($this->address !== null) {
            $this->address->xmlSerialize($customer);
        }

        return $customer;
    }
}
