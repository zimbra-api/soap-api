<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

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

        $except = new ExceptionRuleInfo(
            $add, $exclude
        );
        $this->assertSame($add, $except->getAdd());
        $this->assertSame($exclude, $except->getExclude());

        $except = new ExceptionRuleInfo();
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
<result rangeType="$recurrenceRangeType" recurId="$recurrenceId" tz="$timezone" ridZ="$recurIdZ">
    <add>
        <rule freq="HOU" />
    </add>
    <exclude>
        <rule freq="HOU" />
    </exclude>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($except, 'xml'));
        $this->assertEquals($except, $this->serializer->deserialize($xml, ExceptionRuleInfo::class, 'xml'));

        $json = json_encode([
            'rangeType' => $recurrenceRangeType,
            'recurId' => $recurrenceId,
            'tz' => $timezone,
            'ridZ' => $recurIdZ,
            'add' => [
                'rule' => [
                    [
                        'freq' => 'HOU',
                    ],
                ],
            ],
            'exclude' => [
                'rule' => [
                    [
                        'freq' => 'HOU',
                    ],
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($except, 'json'));
        $this->assertEquals($except, $this->serializer->deserialize($json, ExceptionRuleInfo::class, 'json'));
    }
}
