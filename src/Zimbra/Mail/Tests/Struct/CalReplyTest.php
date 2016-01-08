<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Enum\ParticipationStatus;
use Zimbra\Mail\Struct\CalReply;

/**
 * Testcase class for CalReply.
 */
class CalReplyTest extends ZimbraMailTestCase
{
    public function testCalReply()
    {
        $attendee = $this->faker->word;
        $sequence = mt_rand(1, 100);
        $date = mt_rand(1, 100);
        $rangeType = mt_rand(1, 100);
        $recurId = $this->faker->iso8601;
        $sentBy = $this->faker->word;
        $tz = $this->faker->word;
        $ridZ = $this->faker->iso8601;

        $reply = new CalReply(
            $attendee, $sequence, $date, $rangeType, $recurId, $sentBy, ParticipationStatus::NEEDS_ACTION(), $tz, $ridZ
        );
        $this->assertSame($attendee, $reply->getAttendee());
        $this->assertSame($sequence, $reply->getSequence());
        $this->assertSame($date, $reply->getDate());
        $this->assertSame($sentBy, $reply->getSentBy());
        $this->assertTrue($reply->getPartStat()->is('NE'));

        $reply->setAttendee($attendee)
              ->setSequence($sequence)
              ->setDate($date)
              ->setSentBy($sentBy)
              ->setPartStat(ParticipationStatus::NEEDS_ACTION());
        $this->assertSame($attendee, $reply->getAttendee());
        $this->assertSame($sequence, $reply->getSequence());
        $this->assertSame($date, $reply->getDate());
        $this->assertSame($sentBy, $reply->getSentBy());
        $this->assertTrue($reply->getPartStat()->is('NE'));

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<reply at="' . $attendee . '" seq="' . $sequence . '" d="' . $date . '" sentBy="' . $sentBy . '" ptst="' . ParticipationStatus::NEEDS_ACTION() . '" rangeType="' . $rangeType . '" recurId="' . $recurId . '" tz="' . $tz . '" ridZ="' . $ridZ . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $reply);

        $array = array(
            'reply' => array(
                'at' => $attendee,
                'seq' => $sequence,
                'd' => $date,
                'sentBy' => $sentBy,
                'ptst' => ParticipationStatus::NEEDS_ACTION()->value(),
                'rangeType' => $rangeType,
                'recurId' => $recurId,
                'tz' => $tz,
                'ridZ' => $ridZ,
            ),
        );
        $this->assertEquals($array, $reply->toArray());
    }
}
