<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Enum\Frequency;

use Zimbra\Mail\Struct\RecurrenceInfo;
use Zimbra\Mail\Struct\AddRecurrenceInfo;
use Zimbra\Mail\Struct\ExcludeRecurrenceInfo;
use Zimbra\Mail\Struct\ExceptionRuleInfo;
use Zimbra\Mail\Struct\CancelRuleInfo;
use Zimbra\Mail\Struct\SingleDates;
use Zimbra\Mail\Struct\SimpleRepeatingRule;

use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for RecurrenceInfo.
 */
class RecurrenceInfoTest extends ZimbraStructTestCase
{
    public function testRecurrenceInfo()
    {
        $recurrenceRangeType = $this->faker->numberBetween(1, 3);
        $recurrenceId = $this->faker->date;
        $timezone = $this->faker->timezone;
        $recurIdZ = $this->faker->date;

        $add = new AddRecurrenceInfo([new SimpleRepeatingRule(Frequency::HOUR())]);
        $exclude = new ExcludeRecurrenceInfo([new SimpleRepeatingRule(Frequency::HOUR())]);
        $except = new ExceptionRuleInfo();
        $except->setRecurrenceRangeType($recurrenceRangeType)
            ->setRecurrenceId($recurrenceId)
            ->setTimezone($timezone)
            ->setRecurIdZ($recurIdZ);
        $cancel = new CancelRuleInfo($recurrenceRangeType, $recurrenceId, $timezone, $recurIdZ);
        $dates = new SingleDates($timezone);
        $simple = new SimpleRepeatingRule(Frequency::HOUR());
        $rules = [
            $add,
            $exclude,
            $except,
            $cancel,
            $dates,
            $simple,
        ];

        $recur = new RecurrenceInfo(
            $rules
        );
        $this->assertEquals($rules, $recur->getRules());

        $recur = new RecurrenceInfo();
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
<recur>
    <add>
        <rule freq="HOU"/>
    </add>
    <exclude>
        <rule freq="HOU"/>
    </exclude>
    <except rangeType="$recurrenceRangeType" recurId="$recurrenceId" tz="$timezone" ridZ="$recurIdZ" />
    <cancel rangeType="$recurrenceRangeType" recurId="$recurrenceId" tz="$timezone" ridZ="$recurIdZ" />
    <dates tz="$timezone" />
    <rule freq="HOU"/>
</recur>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($recur, 'xml'));
        $this->assertEquals($recur, $this->serializer->deserialize($xml, RecurrenceInfo::class, 'xml'));

        $json = json_encode([
            'add' => [
                [
                    'rule' => [
                        [
                            'freq' => 'HOU',
                        ],
                    ],
                ],
            ],
            'exclude' => [
                [
                    'rule' => [
                        [
                            'freq' => 'HOU',
                        ],
                    ],
                ],
            ],
            'except' => [
                [
                    'rangeType' => $recurrenceRangeType,
                    'recurId' => $recurrenceId,
                    'tz' => $timezone,
                    'ridZ' => $recurIdZ,
                ],
            ],
            'cancel' => [
                [
                    'rangeType' => $recurrenceRangeType,
                    'recurId' => $recurrenceId,
                    'tz' => $timezone,
                    'ridZ' => $recurIdZ,
                ],
            ],
            'dates' => [
                [
                    'tz' => $timezone,
                ],
            ],
            'rule' => [
                [
                    'freq' => 'HOU',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($recur, 'json'));
        $this->assertEquals($recur, $this->serializer->deserialize($json, RecurrenceInfo::class, 'json'));
    }
}
