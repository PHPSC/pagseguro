<?php
namespace PHPSC\PagSeguro\Purchases\Subscriptions;

use PHPSC\PagSeguro\Items\ItemCollection;

/**
 * @author Adelar Tiemann Junior <adelar@adelarcubs.com>       
 */
class ChargeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Charge
     */
    private $charge;

    protected function setUp()
    {
        $this->charge = new Charge();
    }

    /**
     * @test
     */
    public function constructShouldConfigureTheAttributes()
    {
        $this->assertInstanceOf(ItemCollection::class, $this->charge->getItems());
    }

    /**
     * @test
     */
    public function setReferenceShouldConfigureTheReference()
    {
        $charge = new Charge();
        $charge->setReference('SomeRef');
        
        $this->assertAttributeEquals('SomeRef', 'reference', $charge);
        $this->assertEquals('SomeRef', $charge->getReference());
    }

    /**
     * @test
     */
    public function setSubscriptionCodeShouldConfigureTheSubscriptionCode()
    {
        $charge = new Charge();
        $charge->setSubscriptionCode('SomeSubscription');
        
        $this->assertAttributeEquals('SomeSubscription', 'subscriptionCode', $charge);
        $this->assertEquals('SomeSubscription', $charge->getSubscriptionCode());
    }
}
