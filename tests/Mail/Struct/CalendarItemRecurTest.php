<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Common\Enum\Frequency;

use Zimbra\Mail\Struct\DtTimeInfo;
use Zimbra\Mail\Struct\DurationInfo;
use Zimbra\Mail\Struct\ExceptionRecurIdInfo;
use Zimbra\Mail\Struct\RecurrenceInfo;
use Zimbra\Mail\Struct\SimpleRepeatingRule;

use Zimbra\Mail\Struct\CalendarItemRecur;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CalendarItemRecur.
 */
class CalendarItemRecurTest extends ZimbraTestCase
{
    public function testCalendarItemRecur()
    {
        $dateTime = $this->faker->date;
        $timezone = $this->faker->timezone;
        $recurrenceRangeType = $this->faker->numberBetween(1, 3);
        $utcTime = $this->faker->unixTime;
        $weeks = $this->faker->numberBetween(1, 100);
        $days = $this->faker->numberBetween(1, 30);
        $hours = $this->faker->numberBetween(0, 23);
        $minutes = $this->faker->numberBetween(0, 59);
        $seconds = $this->faker->numberBetween(0, 59);

        $exceptionId = new ExceptionRecurIdInfo($dateTime, $timezone, $recurrenceRangeType);
        $dtStart = new DtTimeInfo($dateTime, $timezone, $utcTime);
        $dtEnd = new DtTimeInfo($dateTime, $timezone, $utcTime);
        $duration = new DurationInfo($weeks, $days, $hours, $minutes, $seconds);
        $recurrence = new RecurrenceInfo([new SimpleRepeatingRule(Frequency::HOUR())]);

        $cal = new StubCalendarItemRecur($exceptionId, $dtStart, $dtEnd, $duration, $recurrence);
        $this->assertSame($exceptionId, $cal->getExceptionId());
        $this->assertSame($dtStart, $cal->getDtStart());
        $this->assertSame($dtEnd, $cal->getDtEnd());
        $this->assertSame($duration, $cal->getDuration());
        $this->assertSame($recurrence, $cal->getRecurrence());

        $cal = new StubCalendarItemRecur();
        $cal->setRecurrence($recurrence)
            ->setExceptionId($exceptionId)
            ->setDtStart($dtStart)
            ->setDtEnd($dtEnd)
            ->setDuration($duration);
        $this->assertSame($exceptionId, $cal->getExceptionId());
        $this->assertSame($dtStart, $cal->getDtStart());
        $this->assertSame($dtEnd, $cal->getDtEnd());
        $this->assertSame($duration, $cal->getDuration());
        $this->assertSame($recurrence, $cal->getRecurrence());

        $xml = <<<EOT
<?xml version="1.0"?>
<result xmlns:urn="urn:zimbraMail">
    <urn:exceptId d="$dateTime" tz="$timezone" rangeType="$recurrenceRangeType" />
    <urn:s d="$dateTime" tz="$timezone" u="$utcTime" />
    <urn:e d="$dateTime" tz="$timezone" u="$utcTime" />
    <urn:dur w="$weeks" d="$days" h="$hours" m="$minutes" s="$seconds" />
    <urn:recur>
        <urn:rule freq="HOU" />
    </urn:recur>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($cal, 'xml'));
        $this->assertEquals($cal, $this->serializer->deserialize($xml, StubCalendarItemRecur::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraMail", prefix="urn")
 */
class StubCalendarItemRecur extends CalendarItemRecur
{
}
