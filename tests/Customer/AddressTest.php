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
        $this->markTestSkipped();

        $data = simplexml_load_string('<?xml version="1.0" encoding="UTF-8"?><data />');
        $xml = $this->address->xmlSerialize($data);

        $this->assertNotSame($data, $xml);
        $this->assertEquals('BRA', (string) $xml->country);
        $this->assertEquals('SC', (string) $xml->state);
        $this->assertEquals('Florianopolis', (string) $xml->city);
        $this->assertEquals('12345123', (string) $xml->postalCode);
        $this->assertEquals('Centro', (string) $xml->district);
        $this->assertEquals('123', (string) $xml->number);
        $this->assertEquals('Apto 200', (string) $xml->complement);

        $this->assertEquals(
            'Avenida Mauro Ramos Euripedes da Silva Santos Oliveira Carlos Henrique Salvador ',
            (string) $xml->street
        );
    }

    /**
     * @test
     */
    public function xmlSerializeShouldNotAppendComplementIfItWasntInformed()
    {
        $this->markTestSkipped();

        $address = new Address(
            'sca',
            'Florianopolis',
            '12345-1231',
            'Centro',
            'Avenida Mauro Ramos Euripedes da Silva Santos Oliveira Carlos Henrique Salvador das Palmeiras',
            123
        );

        $data = simplexml_load_string('<?xml version="1.0" encoding="UTF-8"?><data />');
        $xml = $address->xmlSerialize($data);

        $this->assertNotSame($data, $xml);
        $this->assertEquals('BRA', (string) $xml->country);
        $this->assertEquals('SC', (string) $xml->state);
        $this->assertEquals('Florianopolis', (string) $xml->city);
        $this->assertEquals('12345123', (string) $xml->postalCode);
        $this->assertEquals('Centro', (string) $xml->district);
        $this->assertEquals('123', (string) $xml->number);
        $this->assertEmpty($xml->xpath('//complement'));


        $this->assertEquals(
            'Avenida Mauro Ramos Euripedes da Silva Santos Oliveira Carlos Henrique Salvador ',
            (string) $xml->street
        );
    }
}
