<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Common\Enum\Frequency;

use Zimbra\Mail\Struct\ExceptionRuleInfo;
use Zimbra\Mail\Struct\RecurrenceInfo;
use Zimbra\Mail\Struct\SimpleRepeatingRule;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ExceptionRuleInfo.
 */
class ExceptionRuleInfoTest extends ZimbraTestCase
{
    public function testExceptionRuleInfo()
    {
        $recurrenceRangeType = mt_rand(1, 3);
        $recurrenceId = $this->faker->date;
        $timezone = $this->faker->timezone;
        $recurIdZ = $this->faker->date;
        $frequency = Frequency::HOUR();

        $add = new RecurrenceInfo([new SimpleRepeatingRule($frequency)]);
        $exclude = new RecurrenceInfo([new SimpleRepeatingRule($frequency)]);

        $except = new StubExceptionRuleInfo(
            $add, $exclude
        );
        $this->assertSame($add, $except->getAdd());
        $this->assertSame($exclude, $except->getExclude());

        $except = new StubExceptionRuleInfo();
        $except->setAdd($add)
            ->setExclude($exclude);
        $this->assertSame($add, $except->getAdd());
        $this->assertSame($exclude, $except->getExclude());

        $except->setRecurrenceRangeType($recurrenceRangeType)
            ->setRecurrenceId($recurrenceId)
            ->setTimezone($timezone)
            ->setRecurIdZ($recurIdZ);

        $xml = <<<EOT
<?xml version="1.0"?>
<result rangeType="$recurrenceRangeType" recurId="$recurrenceId" tz="$timezone" ridZ="$recurIdZ" xmlns:urn="urn:zimbraMail">
    <urn:add>
        <urn:rule freq="HOU" />
    </urn:add>
    <urn:exclude>
        <urn:rule freq="HOU" />
    </urn:exclude>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($except, 'xml'));
        $this->assertEquals($except, $this->serializer->deserialize($xml, StubExceptionRuleInfo::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraMail", prefix="urn")
 */
class StubExceptionRuleInfo extends ExceptionRuleInfo
{
}
