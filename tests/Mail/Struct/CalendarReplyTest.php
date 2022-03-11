<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Enum\ParticipationStatus;
use Zimbra\Mail\Struct\CalendarReply;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CalendarReply.
 */
class CalendarReplyTest extends ZimbraTestCase
{
    public function testCalendarReply()
    {
        $seq = $this->faker->randomNumber;
        $date = $this->faker->unixTime;
        $attendee = $this->faker->email;
        $sentBy = $this->faker->email;
        $partStat = ParticipationStatus::ACCEPT();
        $recurrenceRangeType = $this->faker->numberBetween(1, 3);
        $recurrenceId = $this->faker->date;

        $reply = new CalendarReply($seq, $date, $attendee);
        $this->assertSame($seq, $reply->getSeq());
        $this->assertSame($date, $reply->getDate());
        $this->assertSame($attendee, $reply->getAttendee());

        $reply = new CalendarReply(0, 0, '');
        $reply->setSeq($seq)
            ->setDate($date)
            ->setAttendee($attendee)
            ->setSentBy($sentBy)
            ->setPartStat($partStat)
            ->setRecurrenceRangeType($recurrenceRangeType)
            ->setRecurrenceId($recurrenceId);
        $this->assertSame($seq, $reply->getSeq());
        $this->assertSame($date, $reply->getDate());
        $this->assertSame($attendee, $reply->getAttendee());
        $this->assertSame($sentBy, $reply->getSentBy());
        $this->assertSame($partStat, $reply->getPartStat());

        $xml = <<<EOT
<?xml version="1.0"?>
<result rangeType="$recurrenceRangeType" recurId="$recurrenceId" seq="$seq" d="$date" at="$attendee" sentBy="$sentBy" ptst="AC" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($reply, 'xml'));
        $this->assertEquals($reply, $this->serializer->deserialize($xml, CalendarReply::class, 'xml'));

        $json = json_encode([
            'rangeType' => $recurrenceRangeType,
            'recurId' => $recurrenceId,
            'seq' => $seq,
            'd' => $date,
            'at' => $attendee,
            'sentBy' => $sentBy,
            'ptst' => 'AC',
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($reply, 'json'));
        $this->assertEquals($reply, $this->serializer->deserialize($json, CalendarReply::class, 'json'));
    }
}
