<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Common\Enum\ParticipationStatus;
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
        $rangeType = $this->faker->numberBetween(1, 3);
        $recurId = $this->faker->uuid;

        $reply = new CalendarReply(
            $rangeType, $recurId, $seq, $date, $attendee, $sentBy, $partStat
        );
        $this->assertSame($seq, $reply->getSeq());
        $this->assertSame($date, $reply->getDate());
        $this->assertSame($attendee, $reply->getAttendee());
        $this->assertSame($sentBy, $reply->getSentBy());
        $this->assertSame($partStat, $reply->getPartStat());

        $reply = new CalendarReply($rangeType, $recurId, 0, 0, '');
        $reply->setSeq($seq)
            ->setDate($date)
            ->setAttendee($attendee)
            ->setSentBy($sentBy)
            ->setPartStat($partStat);
        $this->assertSame($seq, $reply->getSeq());
        $this->assertSame($date, $reply->getDate());
        $this->assertSame($attendee, $reply->getAttendee());
        $this->assertSame($sentBy, $reply->getSentBy());
        $this->assertSame($partStat, $reply->getPartStat());

        $xml = <<<EOT
<?xml version="1.0"?>
<result rangeType="$rangeType" recurId="$recurId" seq="$seq" d="$date" at="$attendee" sentBy="$sentBy" ptst="AC" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($reply, 'xml'));
        $this->assertEquals($reply, $this->serializer->deserialize($xml, CalendarReply::class, 'xml'));

        $json = json_encode([
            'rangeType' => $rangeType,
            'recurId' => $recurId,
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
