<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Common\Enum\Frequency;

use Zimbra\Mail\Struct\DurationInfo;
use Zimbra\Mail\Struct\ExpandedRecurrenceComponent;
use Zimbra\Mail\Struct\ExpandedRecurrenceCancel;
use Zimbra\Mail\Struct\InstanceRecurIdInfo;
use Zimbra\Mail\Struct\RecurrenceInfo;
use Zimbra\Mail\Struct\SimpleRepeatingRule;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ExpandedRecurrenceCancel.
 */
class ExpandedRecurrenceCancelTest extends ZimbraTestCase
{
    public function testExpandedRecurrenceCancel()
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

        $cancel = new StubExpandedRecurrenceCancel($exceptionId, $startTime, $endTime, $duration, $recurrence);
        $this->assertTrue($cancel instanceof ExpandedRecurrenceComponent);

        $xml = <<<EOT
<?xml version="1.0"?>
<result s="$startTime" e="$endTime" xmlns:urn="urn:zimbraMail">
    <urn:exceptId range="$range" d="$dateTime" tz="$timezone" />
    <urn:dur w="$weeks" d="$days" h="$hours" m="$minutes" s="$seconds" />
    <urn:recur>
        <urn:rule freq="HOU"/>
    </urn:recur>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($cancel, 'xml'));
        $this->assertEquals($cancel, $this->serializer->deserialize($xml, StubExpandedRecurrenceCancel::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraMail', prefix: 'urn')]
class StubExpandedRecurrenceCancel extends ExpandedRecurrenceCancel
{
}
