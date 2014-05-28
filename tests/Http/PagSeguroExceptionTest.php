<?php
namespace PHPSC\PagSeguro\Test\Http;

use PHPSC\PagSeguro\Http\PagSeguroException;
use SimpleXMLElement;

class PagSeguroExceptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function createFromXmlShouldFormatTheErrorList()
    {
        $xml = <<<'XML'
<?xml version="1.0" encoding="UTF-8"?>
<errors>
    <error>
        <code>11004</code>
        <message>Currency is required.</message>
    </error>
    <error>
        <code>11005</code>
        <message>Currency invalid value: 100</message>
    </error>
</errors>
XML;

        $message = <<<'MESSAGE'
Some errors occurred:
[11004] Currency is required.
[11005] Currency invalid value: 100
MESSAGE;

        $exception = PagSeguroException::createFromXml(simplexml_load_string($xml));

        $this->assertInstanceOf('PHPSC\PagSeguro\Http\PagSeguroException', $exception);
        $this->assertEquals($message, $exception->getMessage());
    }
}
