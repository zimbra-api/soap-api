<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Enum\InviteType;

use Zimbra\Mail\Struct\CalendarReply;
use Zimbra\Mail\Struct\CalTZInfo;
use Zimbra\Mail\Struct\InviteComponent;
use Zimbra\Mail\Struct\InviteInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for InviteInfo.
 */
class InviteInfoTest extends ZimbraTestCase
{
    public function testInviteInfo()
    {
        $calItemType = InviteType::TASK();
        $id = $this->faker->word;
        $tzStdOffset = $this->faker->randomNumber;
        $tzDayOffset = $this->faker->randomNumber;
        $method = $this->faker->word;
        $componentNum = $this->faker->randomNumber;

        $seq = $this->faker->randomNumber;
        $date = $this->faker->unixTime;
        $attendee = $this->faker->email;
        $recurrenceRangeType = $this->faker->numberBetween(1, 3);
        $recurrenceId = $this->faker->date;

        $timezone = new CalTZInfo($id, $tzStdOffset, $tzDayOffset);
        $inviteComponent = new InviteComponent($method, $componentNum, TRUE);
        $calendarReply = new CalendarReply($seq, $date, $attendee);
        $calendarReply->setRecurrenceRangeType($recurrenceRangeType)
            ->setRecurrenceId($recurrenceId);

        $inv = new InviteInfo($calItemType, [$timezone], $inviteComponent, [$calendarReply]);
        $this->assertSame($calItemType, $inv->getCalItemType());
        $this->assertSame([$timezone], $inv->getTimezones());
        $this->assertSame($inviteComponent, $inv->getInviteComponent());
        $this->assertSame([$calendarReply], $inv->getCalendarReplies());

        $inv = new InviteInfo(InviteType::TASK());
        $inv->setCalItemType($calItemType)
            ->setTimezones([$timezone])
            ->addTimezone($timezone)
            ->setInviteComponent($inviteComponent)
            ->setCalendarReplies([$calendarReply])
            ->addCalendarReply($calendarReply);
        $this->assertSame($calItemType, $inv->getCalItemType());
        $this->assertSame([$timezone, $timezone], $inv->getTimezones());
        $this->assertSame($inviteComponent, $inv->getInviteComponent());
        $this->assertSame([$calendarReply, $calendarReply], $inv->getCalendarReplies());
        $inv->setTimezones([$timezone])
            ->setCalendarReplies([$calendarReply]);

        $xml = <<<EOT
<?xml version="1.0"?>
<inv type="task">
    <tz id="$id" stdoff="$tzStdOffset" dayoff="$tzDayOffset" />
    <comp method="$method" compNum="$componentNum" rsvp="true" />
    <replies>
        <reply rangeType="$recurrenceRangeType" recurId="$recurrenceId" seq="$seq" d="$date" at="$attendee" />
    </replies>
</inv>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($inv, 'xml'));
        $this->assertEquals($inv, $this->serializer->deserialize($xml, InviteInfo::class, 'xml'));

        $json = json_encode([
            'type' => 'task',
            'tz' => [
                [
                    'id' => $id,
                    'stdoff' => $tzStdOffset,
                    'dayoff' => $tzDayOffset,
                ],
            ],
            'comp' => [
                'method' => $method,
                'compNum' => $componentNum,
                'rsvp' => TRUE,
            ],
            'replies' => [
                'reply' => [
                    [
                        'rangeType' => $recurrenceRangeType,
                        'recurId' => $recurrenceId,
                        'seq' => $seq,
                        'd' => $date,
                        'at' => $attendee,
                    ],
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($inv, 'json'));
        $this->assertEquals($inv, $this->serializer->deserialize($json, InviteInfo::class, 'json'));
    }
}
