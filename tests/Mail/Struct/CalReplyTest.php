<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Common\Enum\ParticipationStatus;
use Zimbra\Mail\Struct\CalReply;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CalReply.
 */
class CalReplyTest extends ZimbraTestCase
{
    public function testCalReply()
    {
        $sequence = $this->faker->randomNumber;
        $date = $this->faker->unixTime;
        $attendee = $this->faker->email;
        $sentBy = $this->faker->email;
        $partStat = ParticipationStatus::ACCEPT();
        $rangeType = $this->faker->numberBetween(1, 3);
        $recurId = $this->faker->uuid;

        $reply = new CalReply(
            $rangeType, $recurId, $sequence, $date, $attendee, $sentBy, $partStat
        );
        $this->assertSame($sequence, $reply->getSequence());
        $this->assertSame($date, $reply->getDate());
        $this->assertSame($attendee, $reply->getAttendee());
        $this->assertSame($sentBy, $reply->getSentBy());
        $this->assertSame($partStat, $reply->getPartStat());

        $reply = new CalReply($rangeType, $recurId);
        $reply->setSequence($sequence)
            ->setDate($date)
            ->setAttendee($attendee)
            ->setSentBy($sentBy)
            ->setPartStat($partStat);
        $this->assertSame($sequence, $reply->getSequence());
        $this->assertSame($date, $reply->getDate());
        $this->assertSame($attendee, $reply->getAttendee());
        $this->assertSame($sentBy, $reply->getSentBy());
        $this->assertSame($partStat, $reply->getPartStat());

        $xml = <<<EOT
<?xml version="1.0"?>
<result rangeType="$rangeType" recurId="$recurId" seq="$sequence" d="$date" at="$attendee" sentBy="$sentBy" ptst="AC" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($reply, 'xml'));
        $this->assertEquals($reply, $this->serializer->deserialize($xml, CalReply::class, 'xml'));
    }
}
