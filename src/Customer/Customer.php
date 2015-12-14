<?php
namespace PHPSC\PagSeguro\Customer;

use JMS\Serializer\Annotation as Serializer;
use PHPSC\PagSeguro\SerializerTrait;

/**
 * @Serializer\AccessType("public_method")
 * @Serializer\ReadOnly
 * @Serializer\XmlRoot("sender")
 *
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class Customer
{
    use SerializerTrait;

    /**
     * @Serializer\XmlElement(cdata=false)
     *
     * @var string
     */
    private $email;

    /**
     * @Serializer\XmlElement(cdata=false)
     *
     * @var string
     */
    private $name;

    /**
     * @Serializer\Type("PHPSC\PagSeguro\Customer\Phone")
     *
     * @var Phone
     */
    private $phone;

    /**
     * @Serializer\Type("PHPSC\PagSeguro\Customer\Address")
     *
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
