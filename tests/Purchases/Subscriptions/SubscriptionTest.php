<?php
namespace PHPSC\PagSeguro\Purchases\Subscriptions;

use DateTime;
use PHPSC\PagSeguro\Purchases\Details;
use PHPSC\PagSeguro\Customer\Address;
use PHPSC\PagSeguro\Customer\Customer;
use PHPSC\PagSeguro\Customer\Phone;

/**
 * @author Renato Moura <moura137@gmail.com>
 */
class SubscriptionTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        $this->dDate = new DateTime('2011-11-23T13:40:00.000-02:00');
        $this->eventDate = new DateTime('2011-11-25T20:04:00.000-02:00');
        $this->detailsAddress = new Address('SP', 'SAO PAULO', '01421000', 'J Paulista', 'ALAMEDAITU', '78', 'ap.2601');
        $this->customer = new Customer('a@uol.com', 'Comprador', new Phone('11', '30389678'), $this->detailsAddress);
    }

    public function testConstructShouldReturnOfGetters()
    {
        $details = new Details('C89', 'R12', '', $this->dDate, $this->eventDate, $this->customer);
        $subscription = new Subscription('FooBar', $details, 'TRACKER-AAAA', '');

        $this->assertEquals('FooBar', $subscription->getName());
        $this->assertEquals($details, $subscription->getDetails());
        $this->assertEquals('TRACKER-AAAA', $subscription->getTracker());

        $this->assertFalse($subscription->isAutomatic());
        $this->assertFalse($subscription->isManual());
        $this->assertFalse($subscription->isInitiated());
        $this->assertFalse($subscription->isPending());
        $this->assertFalse($subscription->isActive());
        $this->assertFalse($subscription->isCancelledByAcquirer());
        $this->assertFalse($subscription->isCancelledByReceiver());
        $this->assertFalse($subscription->isCancelledByCustomer());
        $this->assertFalse($subscription->isExpired());
    }

    public function testIsAutomaticShouldReturnTrue()
    {
        $details = new Details('C89', 'R12', '', $this->dDate, $this->eventDate, $this->customer);
        $subscription = new Subscription('FooBar', $details, 'TRACKER-AAAA', 'auto');

        $this->assertTrue($subscription->isAutomatic());
        $this->assertFalse($subscription->isManual());
    }

    public function testIsManualShouldReturnTrue()
    {
        $details = new Details('C89', 'R12', '', $this->dDate, $this->eventDate, $this->customer);
        $subscription = new Subscription('FooBar', $details, 'TRACKER-AAAA', 'manual');

        $this->assertTrue($subscription->isManual());
        $this->assertFalse($subscription->isAutomatic());
    }

    public function testIsInitiatedShouldReturnTrue()
    {
        $details = new Details('C89', 'R12', 'INITIATED', $this->dDate, $this->eventDate, $this->customer);

        $subscription = new Subscription('FooBar', $details, 'TRACKER-AAAA', 'manual');

        $this->assertTrue($subscription->isInitiated());
    }

    public function testIsPendingShouldReturnTrue()
    {
        $details = new Details('C89', 'R12', 'PENDING', $this->dDate, $this->eventDate, $this->customer);

        $subscription = new Subscription('FooBar', $details, 'TRACKER-AAAA', 'manual');

        $this->assertTrue($subscription->isPending());
    }

    public function testIsActiveShouldReturnTrue()
    {
        $details = new Details('C89', 'R12', 'ACTIVE', $this->dDate, $this->eventDate, $this->customer);

        $subscription = new Subscription('FooBar', $details, 'TRACKER-AAAA', 'manual');

        $this->assertTrue($subscription->isActive());
    }

    public function testIsCancelledByAcquirerShouldReturnTrue()
    {
        $details = new Details('C89', 'R12', 'CANCELLED', $this->dDate, $this->eventDate, $this->customer);

        $subscription = new Subscription('FooBar', $details, 'TRACKER-AAAA', 'manual');

        $this->assertTrue($subscription->isCancelledByAcquirer());
    }

    public function testIsCancelledByReceiverShouldReturnTrue()
    {
        $details = new Details('C89', 'R12', 'CANCELLED_BY_RECEIVER', $this->dDate, $this->eventDate, $this->customer);

        $subscription = new Subscription('FooBar', $details, 'TRACKER-AAAA', 'manual');

        $this->assertTrue($subscription->isCancelledByReceiver());
    }

    public function testIsCancelledByCustomerShouldReturnTrue()
    {
        $details = new Details('C89', 'R12', 'CANCELLED_BY_SENDER', $this->dDate, $this->eventDate, $this->customer);

        $subscription = new Subscription('FooBar', $details, 'TRACKER-AAAA', 'manual');

        $this->assertTrue($subscription->isCancelledByCustomer());
    }

    public function testIsExpiredShouldReturnTrue()
    {
        $details = new Details('C89', 'R12', 'EXPIRED', $this->dDate, $this->eventDate, $this->customer);

        $subscription = new Subscription('FooBar', $details, 'TRACKER-AAAA', 'manual');

        $this->assertTrue($subscription->isExpired());
    }
}
