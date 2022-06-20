<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Common\SerializerFactory;
use Zimbra\Mail\SerializerHandler;

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
    protected function setUp(): void
    {
        SerializerFactory::addSerializerHandler(new SerializerHandler);
        parent::setUp();
    }

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
        $noDataSlot = new FreeBusyNODATAslot(
            $startTime, $endTime, $id, $subject, $location, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE
        );

        $usr = new FreeBusyUserInfo($id, [
            $freeSlot,
            $busySlot,
            $tentativeSlot,
            $unavailableSlot,
            $noDataSlot,
        ]);
        $this->assertSame($id, $usr->getId());
        $this->assertSame([
            $freeSlot,
            $busySlot,
            $tentativeSlot,
            $unavailableSlot,
            $noDataSlot,
        ], $usr->getElements());

        $usr = new FreeBusyUserInfo('');
        $usr->setId($id)
            ->setElements([
                $freeSlot,
                $busySlot,
                $tentativeSlot,
                $unavailableSlot,
            ])
            ->addElement($noDataSlot);
        $this->assertSame($id, $usr->getId());
        $this->assertSame([
            $freeSlot,
            $busySlot,
            $tentativeSlot,
            $unavailableSlot,
            $noDataSlot,
        ], $usr->getElements());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id">
    <f s="$startTime" e="$endTime" eventId="$id" subject="$subject" location="$location" isMeeting="true" isRecurring="true" isException="true" isReminderSet="true" isPrivate="true" hasPermission="true" />
    <b s="$startTime" e="$endTime" eventId="$id" subject="$subject" location="$location" isMeeting="true" isRecurring="true" isException="true" isReminderSet="true" isPrivate="true" hasPermission="true" />
    <t s="$startTime" e="$endTime" eventId="$id" subject="$subject" location="$location" isMeeting="true" isRecurring="true" isException="true" isReminderSet="true" isPrivate="true" hasPermission="true" />
    <u s="$startTime" e="$endTime" eventId="$id" subject="$subject" location="$location" isMeeting="true" isRecurring="true" isException="true" isReminderSet="true" isPrivate="true" hasPermission="true" />
    <n s="$startTime" e="$endTime" eventId="$id" subject="$subject" location="$location" isMeeting="true" isRecurring="true" isException="true" isReminderSet="true" isPrivate="true" hasPermission="true" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($usr, 'xml'));
        $this->assertEquals($usr, $this->serializer->deserialize($xml, FreeBusyUserInfo::class, 'xml'));

        $json = json_encode([
            'id' => $id,
            'f' => [
                [
                    's' => $startTime,
                    'e' => $endTime,
                    'eventId' => $id,
                    'subject' => $subject,
                    'location' => $location,
                    'isMeeting' => TRUE,
                    'isRecurring' => TRUE,
                    'isException' => TRUE,
                    'isReminderSet' => TRUE,
                    'isPrivate' => TRUE,
                    'hasPermission' => TRUE,
                ],
            ],
            'b' => [
                [
                    's' => $startTime,
                    'e' => $endTime,
                    'eventId' => $id,
                    'subject' => $subject,
                    'location' => $location,
                    'isMeeting' => TRUE,
                    'isRecurring' => TRUE,
                    'isException' => TRUE,
                    'isReminderSet' => TRUE,
                    'isPrivate' => TRUE,
                    'hasPermission' => TRUE,
                ],
            ],
            't' => [
                [
                    's' => $startTime,
                    'e' => $endTime,
                    'eventId' => $id,
                    'subject' => $subject,
                    'location' => $location,
                    'isMeeting' => TRUE,
                    'isRecurring' => TRUE,
                    'isException' => TRUE,
                    'isReminderSet' => TRUE,
                    'isPrivate' => TRUE,
                    'hasPermission' => TRUE,
                ],
            ],
            'u' => [
                [
                    's' => $startTime,
                    'e' => $endTime,
                    'eventId' => $id,
                    'subject' => $subject,
                    'location' => $location,
                    'isMeeting' => TRUE,
                    'isRecurring' => TRUE,
                    'isException' => TRUE,
                    'isReminderSet' => TRUE,
                    'isPrivate' => TRUE,
                    'hasPermission' => TRUE,
                ],
            ],
            'n' => [
                [
                    's' => $startTime,
                    'e' => $endTime,
                    'eventId' => $id,
                    'subject' => $subject,
                    'location' => $location,
                    'isMeeting' => TRUE,
                    'isRecurring' => TRUE,
                    'isException' => TRUE,
                    'isReminderSet' => TRUE,
                    'isPrivate' => TRUE,
                    'hasPermission' => TRUE,
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($usr, 'json'));
        $this->assertEquals($usr, $this->serializer->deserialize($json, FreeBusyUserInfo::class, 'json'));
    }
}
