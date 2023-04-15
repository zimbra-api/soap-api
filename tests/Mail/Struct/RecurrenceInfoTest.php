<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Common\Enum\Frequency;

use Zimbra\Mail\Struct\RecurrenceInfo;
use Zimbra\Mail\Struct\AddRecurrenceInfo;
use Zimbra\Mail\Struct\ExcludeRecurrenceInfo;
use Zimbra\Mail\Struct\ExceptionRuleInfo;
use Zimbra\Mail\Struct\CancelRuleInfo;
use Zimbra\Mail\Struct\SingleDates;
use Zimbra\Mail\Struct\SimpleRepeatingRule;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for RecurrenceInfo.
 */
class RecurrenceInfoTest extends ZimbraTestCase
{
    public function testRecurrenceInfo()
    {
        $recurrenceRangeType = $this->faker->numberBetween(1, 3);
        $recurrenceId = $this->faker->date;
        $timezone = $this->faker->timezone;
        $recurIdZ = $this->faker->date;

        $add = new AddRecurrenceInfo([new SimpleRepeatingRule(Frequency::HOUR)]);
        $exclude = new ExcludeRecurrenceInfo([new SimpleRepeatingRule(Frequency::HOUR)]);
        $except = new ExceptionRuleInfo();
        $except->setRecurrenceRangeType($recurrenceRangeType)
            ->setRecurrenceId($recurrenceId)
            ->setTimezone($timezone)
            ->setRecurIdZ($recurIdZ);
        $cancel = new CancelRuleInfo($recurrenceRangeType, $recurrenceId, $timezone, $recurIdZ);
        $dates = new SingleDates($timezone);
        $simple = new SimpleRepeatingRule(Frequency::HOUR);
        $rules = [
            $add,
            $exclude,
            $except,
            $cancel,
            $dates,
            $simple,
        ];

        $recur = new StubRecurrenceInfo(
            $rules
        );
        $this->assertEquals($rules, $recur->getRules());

        $recur = new StubRecurrenceInfo();
        $recur->setRules([
            $add,
            $exclude,
            $except,
            $cancel,
            $dates,
        ])
        ->addRule($simple);
        $this->assertEquals($rules, $recur->getRules());

        $xml = <<<EOT
<?xml version="1.0"?>
<result xmlns:urn="urn:zimbraMail">
    <urn:add>
        <urn:rule freq="HOU"/>
    </urn:add>
    <urn:exclude>
        <urn:rule freq="HOU"/>
    </urn:exclude>
    <urn:except rangeType="$recurrenceRangeType" recurId="$recurrenceId" tz="$timezone" ridZ="$recurIdZ" />
    <urn:cancel rangeType="$recurrenceRangeType" recurId="$recurrenceId" tz="$timezone" ridZ="$recurIdZ" />
    <urn:dates tz="$timezone" />
    <urn:rule freq="HOU"/>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($recur, 'xml'));
        $this->assertEquals($recur, $this->serializer->deserialize($xml, StubRecurrenceInfo::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraMail', prefix: "urn")]
class StubRecurrenceInfo extends RecurrenceInfo
{
}
