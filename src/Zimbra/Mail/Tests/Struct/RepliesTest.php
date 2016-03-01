<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Enum\ParticipationStatus;
use Zimbra\Mail\Struct\CalReply;
use Zimbra\Mail\Struct\Replies;

/**
 * Testcase class for Replies.
 */
class RepliesTest extends ZimbraMailTestCase
{
    public function testReplies()
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
        $replies = new Replies([$reply]);
        $this->assertSame([$reply], $replies->getReplies()->all());
        $replies->addReply($reply);
        $this->assertSame([$reply, $reply], $replies->getReplies()->all());
        $replies = new Replies([$reply]);

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<replies>'
                .'<reply at="' . $attendee . '" seq="' . $sequence . '" d="' . $date . '" sentBy="' . $sentBy . '" ptst="' . ParticipationStatus::NEEDS_ACTION() . '" rangeType="' . $rangeType . '" recurId="' . $recurId . '" tz="' . $tz . '" ridZ="' . $ridZ . '" />'
            .'</replies>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $replies);

        $array = array(
            'replies' => array(
                'reply' => array(
                    array(
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
                ),
            ),
        );
        $this->assertEquals($array, $replies->toArray());
    }
}
