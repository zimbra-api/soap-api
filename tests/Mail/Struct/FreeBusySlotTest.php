<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\FreeBusySlot;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for FreeBusySlot.
 */
class FreeBusySlotTest extends ZimbraTestCase
{
    public function testFreeBusySlot()
    {
        $startTime = $this->faker->unixTime;
        $endTime = $this->faker->unixTime;
        $id = $this->faker->uuid;
        $subject = $this->faker->text;
        $location = $this->faker->text;

        $slot = new FreeBusySlot(
            $startTime, $endTime, $id, $subject, $location, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE
        );
        $this->assertSame($startTime, $slot->getStartTime());
        $this->assertSame($endTime, $slot->getEndTime());
        $this->assertSame($id, $slot->getId());
        $this->assertSame($subject, $slot->getSubject());
        $this->assertSame($location, $slot->getLocation());
        $this->assertFalse($slot->isMeeting());
        $this->assertFalse($slot->isRecurring());
        $this->assertFalse($slot->isException());
        $this->assertFalse($slot->isReminderSet());
        $this->assertFalse($slot->isPrivate());
        $this->assertFalse($slot->hasPermission());

        $slot = new FreeBusySlot(0, 0);
        $slot->setStartTime($startTime)
            ->setEndTime($endTime)
            ->setId($id)
            ->setSubject($subject)
            ->setLocation($location)
            ->setMeeting(TRUE)
            ->setRecurring(TRUE)
            ->setException(TRUE)
            ->setReminderSet(TRUE)
            ->setPrivate(TRUE)
            ->setHasPermission(TRUE);
        $this->assertSame($startTime, $slot->getStartTime());
        $this->assertSame($endTime, $slot->getEndTime());
        $this->assertSame($id, $slot->getId());
        $this->assertSame($subject, $slot->getSubject());
        $this->assertSame($location, $slot->getLocation());
        $this->assertTrue($slot->isMeeting());
        $this->assertTrue($slot->isRecurring());
        $this->assertTrue($slot->isException());
        $this->assertTrue($slot->isReminderSet());
        $this->assertTrue($slot->isPrivate());
        $this->assertTrue($slot->hasPermission());

        $xml = <<<EOT
<?xml version="1.0"?>
<result s="$startTime" e="$endTime" eventId="$id" subject="$subject" location="$location" isMeeting="true" isRecurring="true" isException="true" isReminderSet="true" isPrivate="true" hasPermission="true" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($slot, 'xml'));
        $this->assertEquals($slot, $this->serializer->deserialize($xml, FreeBusySlot::class, 'xml'));
    }
}
