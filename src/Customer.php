<?php
namespace PHPSC\PagSeguro;

use InvalidArgumentException;
use PHPSC\PagSeguro\XmlSerializable;
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
        $this->setEmail($email);

        $this->phone = $phone;

        if ($name !== null) {
            $this->setName($name);
        }
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    protected function setEmail($email)
    {
        $this->email = substr($email, 0, 60);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    protected function setName($name)
    {
        $this->name = substr($name, 0, 50);
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
    public function xmlSerialize(SimpleXMLElement $parent = null)
    {
        if ($parent === null) {
            throw new InvalidArgumentException('Customer must have a parent node');
        }

        $customer = $parent->addChild('sender');
        $customer->addChild('email', $this->email);

        if ($this->name !== null) {
            $customer->addChild('name', $this->name);
        }

        if ($this->phone !== null) {
            $this->phone->xmlSerialize($customer);
        }

        return $customer;
    }
}
