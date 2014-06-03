<?php
namespace PHPSC\PagSeguro;

use SimpleXMLElement;

class Address implements XmlSerializable
{
    /**
     * @var string
     */
    private $country;

    /**
     * @var string
     */
    private $state;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $postalCode;

    /**
     * @var string
     */
    private $district;

    /**
     * @var string
     */
    private $street;

    /**
     * @var string
     */
    private $number;

    /**
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

    /**
     * {@inheritdoc}
     */
    public function xmlSerialize(SimpleXMLElement $parent)
    {
        $address = $parent->addChild('address');

        $address->addChild('country', $this->country);
        $address->addChild('state', strtoupper(substr($this->state, 0, 2)));
        $address->addChild('city', substr($this->city, 0, 60));
        $address->addChild('postalCode', substr($this->postalCode, 0, 8));
        $address->addChild('district', substr($this->district, 0, 60));
        $address->addChild('street', substr($this->street, 0, 80));
        $address->addChild('number', substr($this->number, 0, 20));

        if ($this->complement !== null) {
            $address->addChild('complement', substr($this->complement, 0, 40));
        }

        return $address;
    }
}
