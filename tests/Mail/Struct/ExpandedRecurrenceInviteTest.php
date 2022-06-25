<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Common\Enum\Frequency;

use Zimbra\Mail\Struct\DurationInfo;
use Zimbra\Mail\Struct\ExpandedRecurrenceComponent;
use Zimbra\Mail\Struct\ExpandedRecurrenceInvite;
use Zimbra\Mail\Struct\InstanceRecurIdInfo;
use Zimbra\Mail\Struct\RecurrenceInfo;
use Zimbra\Mail\Struct\SimpleRepeatingRule;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ExpandedRecurrenceInvite.
 */
class ExpandedRecurrenceInviteTest extends ZimbraTestCase
{
    public function testExpandedRecurrenceInvite()
    {
        $startTime = $this->faker->unixTime;
        $endTime = $this->faker->unixTime;
        $range = $this->faker->randomElement(['THISANDFUTURE', 'THISANDPRIOR']);
        $dateTime = $this->faker->date;
        $tz = $this->faker->timezone;
        $weeks = mt_rand(1, 100);
        $days = mt_rand(1, 30);
        $hours = mt_rand(0, 23);
        $minutes = mt_rand(0, 59);
        $seconds = mt_rand(0, 59);

        $exceptionId = new InstanceRecurIdInfo($range, $dateTime, $tz);
        $duration = new DurationInfo($weeks, $days, $hours, $minutes, $seconds);
        $recurrence = new RecurrenceInfo([new SimpleRepeatingRule(Frequency::HOUR())]);

        $comp = new ExpandedRecurrenceInvite($exceptionId, $startTime, $endTime, $duration, $recurrence);
        $this->assertTrue($comp instanceof ExpandedRecurrenceComponent);

        $xml = <<<EOT
<?xml version="1.0"?>
<result s="$startTime" e="$endTime">
    <exceptId range="$range" d="$dateTime" tz="$tz" />
    <dur w="$weeks" d="$days" h="$hours" m="$minutes" s="$seconds" />
    <recur>
        <rule freq="HOU"/>
    </recur>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($comp, 'xml'));
        $this->assertEquals($comp, $this->serializer->deserialize($xml, ExpandedRecurrenceInvite::class, 'xml'));

        $json = json_encode([
            's' => $startTime,
            'e' => $endTime,
            'exceptId' => [
                'range' => $range,
                'd' => $dateTime,
                'tz' => $tz,
            ],
            'dur' => [
                'w' => $weeks,
                'd' => $days,
                'h' => $hours,
                'm' => $minutes,
                's' => $seconds,
            ],
            'recur' => [
                'rule' => [
                    [
                        'freq' => 'HOU',
                    ],
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($comp, 'json'));
        $this->assertEquals($comp, $this->serializer->deserialize($json, ExpandedRecurrenceInvite::class, 'json'));
    }
}
