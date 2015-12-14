<?php
namespace PHPSC\PagSeguro\Customer;

use JMS\Serializer\Annotation as JSA;
use PHPSC\PagSeguro\Requests\SerializerTrait;

/**
 * @JSA\AccessType("public_method")
 * @JSA\ExclusionPolicy("all")
 * @JSA\ReadOnly
 * @JSA\XmlRoot("sender")
 *
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class Customer
{
    use SerializerTrait;

    /**
     * @JSA\Expose
     * @JSA\XmlElement(cdata=false)
     *
     * @var string
     */
    private $email;

    /**
     * @JSA\Expose
     * @JSA\XmlElement(cdata=false)
     *
     * @var string
     */
    private $name;

    /**
     * @JSA\Type("PHPSC\PagSeguro\Customer\Phone")
     * @JSA\Expose
     *
     * @var Phone
     */
    private $phone;

    /**
     * @JSA\Type("PHPSC\PagSeguro\Customer\Address")
     * @JSA\Expose
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
