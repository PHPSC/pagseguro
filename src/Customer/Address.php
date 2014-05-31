<?php
namespace PHPSC\PagSeguro\Customer;

use InvalidArgumentException;
use PHPSC\PagSeguro\XmlSerializable;
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

        $this->setState($state);
        $this->setCity($city);
        $this->setPostalCode($postalCode);
        $this->setDistrict($district);
        $this->setStreet($street);
        $this->setNumber($number);

        if ($complement !== null) {
            $this->setComplement($complement);
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
     * @param string $state
     */
    protected function setState($state)
    {
        $this->state = substr((string) $state, 0, 2);
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    protected function setCity($city)
    {
        $this->city = substr((string) $city, 0, 60);
    }

    /**
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @param string $postalCode
     */
    protected function setPostalCode($postalCode)
    {
        $this->postalCode = substr(
            preg_replace('/[^0-9]/', '', (string) $postalCode),
            0,
            8
        );
    }

    /**
     * @return string
     */
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * @param string $district
     */
    protected function setDistrict($district)
    {
        $this->district = substr((string) $district, 0, 60);
    }

    /**
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param string $street
     */
    protected function setStreet($street)
    {
        $this->street = substr((string) $street, 0, 80);
    }

    /**
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param string $number
     */
    protected function setNumber($number)
    {
        $this->number = substr((string) $number, 0, 20);
    }

    /**
     * @return string
     */
    public function getComplement()
    {
        return $this->complement;
    }

    /**
     * @param string $complement
     */
    protected function setComplement($complement)
    {
        $this->complement = substr((string) $complement, 0, 40);
    }

    /**
     * {@inheritdoc}
     */
    public function xmlSerialize(SimpleXMLElement $parent = null)
    {
        if ($parent === null) {
            throw new InvalidArgumentException('Address must have a parent node');
        }

        $address = $parent->addChild('address');

        foreach ($this as $name => $value) {
            if ($value !== null) {
                $address->addChild($name, $value);
            }
        }

        return $address;
    }
}
