<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Mail\Struct\FreeBusyUserInfo;
use Zimbra\Mail\Struct\FreeBusyFREEslot;
use Zimbra\Mail\Struct\FreeBusyBUSYslot;
use Zimbra\Mail\Struct\FreeBusyBUSYTENTATIVEslot;
use Zimbra\Mail\Struct\FreeBusyBUSYUNAVAILABLEslot;
use Zimbra\Mail\Struct\FreeBusyNODATAslot;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for FreeBusyUserInfo.
 */
class FreeBusyUserInfoTest extends ZimbraTestCase
{
    public function testFreeBusyUserInfo()
    {
        $id = $this->faker->uuid;
        $startTime = $this->faker->unixTime;
        $endTime = $this->faker->unixTime;
        $subject = $this->faker->text;
        $location = $this->faker->text;

        $freeSlot = new FreeBusyFREEslot(
            $startTime, $endTime, $id, $subject, $location, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE
        );
        $busySlot = new FreeBusyBUSYslot(
            $startTime, $endTime, $id, $subject, $location, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE
        );
        $tentativeSlot = new FreeBusyBUSYTENTATIVEslot(
            $startTime, $endTime, $id, $subject, $location, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE
        );
        $unavailableSlot = new FreeBusyBUSYUNAVAILABLEslot(
            $startTime, $endTime, $id, $subject, $location, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE
        );
        $nodataSlot = new FreeBusyNODATAslot(
            $startTime, $endTime, $id, $subject, $location, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE
        );

        $usr = new StubFreeBusyUserInfo($id, [
            $freeSlot,
            $busySlot,
            $tentativeSlot,
            $unavailableSlot,
            $nodataSlot,
        ]);
        $this->assertSame($id, $usr->getId());
        $this->assertSame([
            $freeSlot,
            $busySlot,
            $tentativeSlot,
            $unavailableSlot,
            $nodataSlot,
        ], $usr->getElements());

        $usr = new StubFreeBusyUserInfo();
        $usr->setId($id)
            ->setFreeSlots([
                $freeSlot,
            ])
            ->setBusySlots([
                $busySlot,
            ])
            ->setTentativeSlots([
                $tentativeSlot,
            ])
            ->setUnavailableSlots([
                $unavailableSlot,
            ])
            ->setNodataSlots([
                $nodataSlot,
            ]);
        $this->assertSame($id, $usr->getId());
        $this->assertSame([
            $freeSlot,
            $busySlot,
            $tentativeSlot,
            $unavailableSlot,
            $nodataSlot,
        ], $usr->getElements());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" xmlns:urn="urn:zimbraMail">
    <urn:f s="$startTime" e="$endTime" eventId="$id" subject="$subject" location="$location" isMeeting="true" isRecurring="true" isException="true" isReminderSet="true" isPrivate="true" hasPermission="true" />
    <urn:b s="$startTime" e="$endTime" eventId="$id" subject="$subject" location="$location" isMeeting="true" isRecurring="true" isException="true" isReminderSet="true" isPrivate="true" hasPermission="true" />
    <urn:t s="$startTime" e="$endTime" eventId="$id" subject="$subject" location="$location" isMeeting="true" isRecurring="true" isException="true" isReminderSet="true" isPrivate="true" hasPermission="true" />
    <urn:u s="$startTime" e="$endTime" eventId="$id" subject="$subject" location="$location" isMeeting="true" isRecurring="true" isException="true" isReminderSet="true" isPrivate="true" hasPermission="true" />
    <urn:n s="$startTime" e="$endTime" eventId="$id" subject="$subject" location="$location" isMeeting="true" isRecurring="true" isException="true" isReminderSet="true" isPrivate="true" hasPermission="true" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($usr, 'xml'));
        $this->assertEquals($usr, $this->serializer->deserialize($xml, StubFreeBusyUserInfo::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraMail', prefix: "urn")]
class StubFreeBusyUserInfo extends FreeBusyUserInfo
{
}
