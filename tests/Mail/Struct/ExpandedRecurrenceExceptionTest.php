<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Enum\Frequency;

use Zimbra\Mail\Struct\DurationInfo;
use Zimbra\Mail\Struct\ExpandedRecurrenceComponent;
use Zimbra\Mail\Struct\ExpandedRecurrenceException;
use Zimbra\Mail\Struct\InstanceRecurIdInfo;
use Zimbra\Mail\Struct\RecurrenceInfo;
use Zimbra\Mail\Struct\SimpleRepeatingRule;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ExpandedRecurrenceException.
 */
class ExpandedRecurrenceExceptionTest extends ZimbraTestCase
{
    public function testExpandedRecurrenceException()
    {
        $startTime = $this->faker->unixTime;
        $endTime = $this->faker->unixTime;
        $range = $this->faker->randomElement(['THISANDFUTURE', 'THISANDPRIOR']);
        $dateTime = $this->faker->date;
        $timezone = $this->faker->timezone;
        $weeks = mt_rand(1, 100);
        $days = mt_rand(1, 30);
        $hours = mt_rand(0, 23);
        $minutes = mt_rand(0, 59);
        $seconds = mt_rand(0, 59);

        $exceptionId = new InstanceRecurIdInfo($range, $dateTime, $timezone);
        $duration = new DurationInfo($weeks, $days, $hours, $minutes, $seconds);
        $recurrence = new RecurrenceInfo([new SimpleRepeatingRule(Frequency::HOUR())]);

        $except = new ExpandedRecurrenceException($exceptionId, $startTime, $endTime, $duration, $recurrence);
        $this->assertTrue($except instanceof ExpandedRecurrenceComponent);

        $xml = <<<EOT
<?xml version="1.0"?>
<except s="$startTime" e="$endTime">
    <exceptId range="$range" d="$dateTime" tz="$timezone" />
    <dur w="$weeks" d="$days" h="$hours" m="$minutes" s="$seconds" />
    <recur>
        <rule freq="HOU"/>
    </recur>
</except>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($except, 'xml'));
        $this->assertEquals($except, $this->serializer->deserialize($xml, ExpandedRecurrenceException::class, 'xml'));

        $json = json_encode([
            's' => $startTime,
            'e' => $endTime,
            'exceptId' => [
                'range' => $range,
                'd' => $dateTime,
                'tz' => $timezone,
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
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($except, 'json'));
        $this->assertEquals($except, $this->serializer->deserialize($json, ExpandedRecurrenceException::class, 'json'));
    }
}
