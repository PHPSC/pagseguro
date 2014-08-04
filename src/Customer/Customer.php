<?php
namespace PHPSC\PagSeguro\Customer;

class Customer
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
}
