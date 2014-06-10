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
     * @param string $email
     * @param string $name
     * @param Phone $phone
     */
    public function __construct(
        $email,
        $name = null,
        Phone $phone = null
    ) {
        $this->email = $email;
        $this->phone = $phone;
        $this->name = $name;
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

        return $customer;
    }
}
