<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Common\Enum\Frequency;

use Zimbra\Mail\Struct\DurationInfo;
use Zimbra\Mail\Struct\ExpandedRecurrenceComponent;
use Zimbra\Mail\Struct\InstanceRecurIdInfo;
use Zimbra\Mail\Struct\RecurrenceInfo;
use Zimbra\Mail\Struct\SimpleRepeatingRule;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ExpandedRecurrenceComponent.
 */
class ExpandedRecurrenceComponentTest extends ZimbraTestCase
{
    public function testExpandedRecurrenceComponent()
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
        $recurrence = new RecurrenceInfo([new SimpleRepeatingRule(Frequency::HOUR)]);

        $exp = new StubExpandedRecurrenceComponent($exceptionId, $startTime, $endTime, $duration, $recurrence);
        $this->assertSame($exceptionId, $exp->getExceptionId());
        $this->assertSame($startTime, $exp->getStartTime());
        $this->assertSame($endTime, $exp->getEndTime());
        $this->assertSame($duration, $exp->getDuration());
        $this->assertSame($recurrence, $exp->getRecurrence());

        $exp = new StubExpandedRecurrenceComponent();
        $exp->setExceptionId($exceptionId)
            ->setStartTime($startTime)
            ->setEndTime($endTime)
            ->setDuration($duration)
            ->setRecurrence($recurrence);
        $this->assertSame($exceptionId, $exp->getExceptionId());
        $this->assertSame($startTime, $exp->getStartTime());
        $this->assertSame($endTime, $exp->getEndTime());
        $this->assertSame($duration, $exp->getDuration());
        $this->assertSame($recurrence, $exp->getRecurrence());

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
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($exp, 'xml'));
        $this->assertEquals($exp, $this->serializer->deserialize($xml, StubExpandedRecurrenceComponent::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraMail', prefix: "urn")]
class StubExpandedRecurrenceComponent extends ExpandedRecurrenceComponent
{
}
