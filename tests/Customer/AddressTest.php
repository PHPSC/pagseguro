<?php
namespace PHPSC\PagSeguro\Customer;

class AddressTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Address
     */
    protected $address;

    protected function setUp()
    {
        $this->address = new Address(
            'sca',
            'Florianopolis',
            '12345-1231',
            'Centro',
            'Avenida Mauro Ramos Euripedes da Silva Santos Oliveira Carlos Henrique Salvador das Palmeiras',
            123,
            'Apto 200'
        );
    }

    /**
     * @test
     */
    public function constructorShouldConfigureTheAttributes()
    {
        $this->assertAttributeEquals('BRA', 'country', $this->address);
        $this->assertAttributeEquals('sca', 'state', $this->address);
        $this->assertAttributeEquals('Florianopolis', 'city', $this->address);
        $this->assertAttributeEquals('123451231', 'postalCode', $this->address);
        $this->assertAttributeEquals('Centro', 'district', $this->address);
        $this->assertAttributeEquals('123', 'number', $this->address);
        $this->assertAttributeEquals('Apto 200', 'complement', $this->address);

        $this->assertAttributeEquals(
            'Avenida Mauro Ramos Euripedes da Silva Santos Oliveira Carlos Henrique Salvador das Palmeiras',
            'street',
            $this->address
        );
    }

    /**
     * @test
     */
    public function gettersShouldReturnTheAttributeValue()
    {
        $this->assertAttributeEquals($this->address->getCountry(), 'country', $this->address);
        $this->assertAttributeEquals($this->address->getState(), 'state', $this->address);
        $this->assertAttributeEquals($this->address->getCity(), 'city', $this->address);
        $this->assertAttributeEquals($this->address->getPostalCode(), 'postalCode', $this->address);
        $this->assertAttributeEquals($this->address->getDistrict(), 'district', $this->address);
        $this->assertAttributeEquals($this->address->getStreet(), 'street', $this->address);
        $this->assertAttributeEquals($this->address->getNumber(), 'number', $this->address);
        $this->assertAttributeEquals($this->address->getComplement(), 'complement', $this->address);
    }

    /**
     * @testAppendFormattedValuesOnAChildNode
     */
    public function xmlSerializeShouldAppendFormattedValuesOnAChildNode()
    {
        $data = simplexml_load_string('<?xml version="1.0" encoding="UTF-8"?><data />');
        $xml = $this->address->xmlSerialize($data);

        $this->assertSame($data, $xml);
        $this->assertEquals('BRA', (string) $xml->address->country);
        $this->assertEquals('sca', (string) $xml->address->state);
        $this->assertEquals('Florianopolis', (string) $xml->address->city);
        $this->assertEquals('123451231', (string) $xml->address->postalCode);
        $this->assertEquals('Centro', (string) $xml->address->district);
        $this->assertEquals('123', (string) $xml->address->number);
        $this->assertEquals('Apto 200', (string) $xml->address->complement);

        $this->assertEquals(
            'Avenida Mauro Ramos Euripedes da Silva Santos Oliveira Carlos Henrique Salvador das Palmeiras',
            (string) $xml->address->street
        );
    }

    /**
     * @test
     */
    public function xmlSerializeShouldNotAppendComplementIfItWasntInformed()
    {
        $address = new Address(
            'SC',
            'Florianopolis',
            '12345-1231',
            'Centro',
            'Avenida Mauro Ramos Euripedes da Silva Santos Oliveira Carlos Henrique Salvador',
            123
        );

        $data = simplexml_load_string('<?xml version="1.0" encoding="UTF-8"?><data />');
        $xml = $address->xmlSerialize($data);

        $this->assertSame($data, $xml);
        $this->assertEquals('BRA', (string) $xml->address->country);
        $this->assertEquals('SC', (string) $xml->address->state);
        $this->assertEquals('Florianopolis', (string) $xml->address->city);
        $this->assertEquals('123451231', (string) $xml->address->postalCode);
        $this->assertEquals('Centro', (string) $xml->address->district);
        $this->assertEquals('123', (string) $xml->address->number);
        $this->assertEmpty($xml->xpath('//address/complement'));


        $this->assertEquals(
            'Avenida Mauro Ramos Euripedes da Silva Santos Oliveira Carlos Henrique Salvador',
            (string) $xml->address->street
        );
    }
}
