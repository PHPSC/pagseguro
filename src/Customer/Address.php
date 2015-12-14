<?php
namespace PHPSC\PagSeguro\Customer;

use JMS\Serializer\Annotation as JSA;
use PHPSC\PagSeguro\Requests\SerializerTrait;

/**
 * @JSA\AccessType("public_method")
 * @JSA\ExclusionPolicy("all")
 * @JSA\ReadOnly
 * @JSA\XmlRoot("address")
 *
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class Address
{
    use SerializerTrait;

    /**
     * @JSA\Expose
     *
     * @var string
     */
    private $country;

    /**
     * @JSA\Expose
     *
     * @var string
     */
    private $state;

    /**
     * @JSA\Expose
     *
     * @var string
     */
    private $city;

    /**
     * @JSA\Expose
     *
     * @var string
     */
    private $postalCode;

    /**
     * @JSA\Expose
     *
     * @var string
     */
    private $district;

    /**
     * @JSA\Expose
     *
     * @var string
     */
    private $street;

    /**
     * @JSA\Expose
     *
     * @var string
     */
    private $number;

    /**
     * @JSA\Expose
     *
     * @var string
     */
    private $complement;

    /**
     * @param string $state
     * @param string $city
     * @param string $postalCode
     * @param string $district
     * @param string $street
     * @param string $number
     * @param string $complement
     */
    public function __construct($state, $city, $postalCode, $district, $street, $number, $complement = null)
    {
        $this->country = 'BRA';
        $this->state = (string) $state;
        $this->city = (string) $city;
        $this->postalCode = preg_replace('/[^0-9]/', '', (string) $postalCode);
        $this->district = (string) $district;
        $this->street = (string) $street;
        $this->number = (string) $number;

        if (!empty($complement)) {
            $this->complement = (string) $complement;
        }
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @return string
     */
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @return string
     */
    public function getComplement()
    {
        return $this->complement;
    }
}
