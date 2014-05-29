<?php
namespace PHPSC\PagSeguro\Test\Checkout;

use DateTime;
use PHPSC\PagSeguro\Checkout\Decoder;

class DecoderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \SimpleXMLElement
     */
    private $xml;

    protected function setUp()
    {
        $xml = <<<'XML'
<?xml version="1.0" encoding="UTF-8"?>
<checkout>
    <code>8CF4BE7DCECEF0F004A6DFA0A8243412</code>
    <date>2014-05-29T03:11:28.000-03:00</date>
</checkout>
XML;

        $this->xml = simplexml_load_string($xml);
    }

    /**
     * @test
     * @dataProvider decoderUris
     */
    public function decodeShouldReturnAResponseAccordingWithTheXmlAndIfIsInSandbox($sandbox, $uri)
    {
        $decoder = new Decoder();
        $response = $decoder->decode($this->xml, $sandbox);

        $this->assertInstanceOf('PHPSC\PagSeguro\Checkout\Response', $response);
        $this->assertAttributeEquals('8CF4BE7DCECEF0F004A6DFA0A8243412', 'code', $response);
        $this->assertAttributeEquals(new DateTime('2014-05-29T03:11:28.000-03:00'), 'date', $response);
        $this->assertAttributeEquals($uri, 'uri', $response);
    }

    public function decoderUris()
    {
        return array(
            array(false, 'https://pagseguro.uol.com.br/v2/checkout/payment.html'),
            array(true, 'https://sandbox.pagseguro.uol.com.br/v2/checkout/payment.html')
        );
    }
}
