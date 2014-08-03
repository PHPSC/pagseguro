<?php
namespace PHPSC\PagSeguro\Requests;

use DateTime;

class RedirectionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Redirection
     */
    private $redirection;

    /**
     * @var DateTime
     */
    private $date;

    protected function setUp()
    {
        $this->date = new DateTime('2014-05-30');
        $this->redirection = new Redirection(1, $this->date, 'http://example.org');
    }

    /**
     * @test
     */
    public function constructShouldConfigureTheAttributes()
    {
        $this->assertAttributeEquals(1, 'code', $this->redirection);
        $this->assertAttributeSame($this->date, 'date', $this->redirection);
        $this->assertAttributeEquals('http://example.org', 'uri', $this->redirection);
    }

    /**
     * @test
     * @depends constructShouldConfigureTheAttributes
     */
    public function getCodeShouldReturnTheConfiguredCode()
    {
        $this->assertEquals(1, $this->redirection->getCode());
    }

    /**
     * @test
     * @depends constructShouldConfigureTheAttributes
     */
    public function getDateShouldReturnTheConfiredDate()
    {
        $this->assertSame($this->date, $this->redirection->getDate());
    }

    /**
     * @test
     * @depends constructShouldConfigureTheAttributes
     */
    public function getRedirectionUrlShouldReturnTheUriWithCodeAsQueryString()
    {
        $this->assertSame('http://example.org?code=1', $this->redirection->getRedirectionUrl());
    }
}
