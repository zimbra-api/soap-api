<?php declare(strict_types=1);

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Enum\Frequency;
use Zimbra\Enum\WeekDay;

use Zimbra\Mail\Struct\DateTimeStringAttr;
use Zimbra\Mail\Struct\NumAttr;
use Zimbra\Mail\Struct\IntervalRule;

use Zimbra\Mail\Struct\BySecondRule;
use Zimbra\Mail\Struct\ByMinuteRule;
use Zimbra\Mail\Struct\ByHourRule;
use Zimbra\Mail\Struct\ByDayRule;
use Zimbra\Mail\Struct\ByMonthDayRule;
use Zimbra\Mail\Struct\ByYearDayRule;
use Zimbra\Mail\Struct\ByWeekNoRule;
use Zimbra\Mail\Struct\ByMonthRule;
use Zimbra\Mail\Struct\BySetPosRule;

use Zimbra\Mail\Struct\WkDay;
use Zimbra\Mail\Struct\WkstRule;
use Zimbra\Mail\Struct\XNameRule;

use Zimbra\Mail\Struct\SimpleRepeatingRule;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for SimpleRepeatingRule.
 */
class SimpleRepeatingRuleTest extends ZimbraStructTestCase
{
    public function testSimpleRepeatingRule()
    {
        $frequency = Frequency::HOUR();
        $name = $this->faker->name;
        $value = $this->faker->word;
        $date = $this->faker->date;
        $num = $this->faker->unique()->numberBetween(1, 100);
        $ival = $this->faker->unique()->numberBetween(1, 100);
        $day = WeekDay::SU();
        $ordWk = $this->faker->unique()->numberBetween(1, 53);
        $seclist = implode(',', [
            $this->faker->unique()->numberBetween(0, 59),
            $this->faker->unique()->numberBetween(0, 59),
        ]);
        $minlist = implode(',', [
            $this->faker->unique()->numberBetween(0, 59),
            $this->faker->unique()->numberBetween(0, 59),
        ]);
        $hrlist = implode(',', [
            $this->faker->unique()->numberBetween(0, 23),
            $this->faker->unique()->numberBetween(0, 23),
        ]);
        $modaylist = implode(',', [
            $this->faker->unique()->numberBetween(1, 31),
            '+' . $this->faker->unique()->numberBetween(1, 31),
            '-' . $this->faker->unique()->numberBetween(1, 31),
        ]);
        $yrdaylist = implode(',', [
            $this->faker->unique()->numberBetween(1, 366),
            '+' . $this->faker->unique()->numberBetween(1, 366),
            '-' . $this->faker->unique()->numberBetween(1, 366),
        ]);
        $wklist = implode(',', [
            $this->faker->unique()->numberBetween(1, 53),
            '+' . $this->faker->unique()->numberBetween(1, 53),
            '-' . $this->faker->unique()->numberBetween(1, 53),
        ]);
        $molist = implode(',', [
            $this->faker->unique()->numberBetween(1, 12),
            $this->faker->unique()->numberBetween(1, 12),
        ]);
        $poslist = implode(',', [
            $this->faker->unique()->numberBetween(1, 366),
            '+' . $this->faker->unique()->numberBetween(1, 366),
            '-' . $this->faker->unique()->numberBetween(1, 366),
        ]);

        $until = new DateTimeStringAttr($date);
        $count = new NumAttr($num);
        $interval = new IntervalRule($ival);
        $bySecond = new BySecondRule($seclist);
        $byMinute = new ByMinuteRule($minlist);
        $byHour = new ByHourRule($hrlist);
        $byDay = new ByDayRule([new WkDay($day, $ordWk)]);
        $byMonthDay = new ByMonthDayRule($modaylist);
        $byYearDay = new ByYearDayRule($yrdaylist);
        $byWeekNo = new ByWeekNoRule($wklist);
        $byMonth = new ByMonthRule($molist);
        $bySetPos = new BySetPosRule($poslist);
        $weekStart = new WkstRule($day);
        $xName = new XNameRule($name, $value);

        $rule = new SimpleRepeatingRule(
            $frequency, $interval
        );
        $this->assertSame($frequency, $rule->getFrequency());
        $this->assertSame($interval, $rule->getInterval());

        $rule = new SimpleRepeatingRule(Frequency::SECOND());
        $rule->setFrequency($frequency)
            ->setUntil($until)
            ->setCount($count)
            ->setInterval($interval)
            ->setBySecond($bySecond)
            ->setByMinute($byMinute)
            ->setByHour($byHour)
            ->setByDay($byDay)
            ->setByMonthDay($byMonthDay)
            ->setByYearDay($byYearDay)
            ->setByWeekNo($byWeekNo)
            ->setByMonth($byMonth)
            ->setBySetPos($bySetPos)
            ->setWeekStart($weekStart)
            ->setXNames([$xName])
            ->addXName($xName);
        $this->assertSame($frequency, $rule->getFrequency());
        $this->assertSame($until, $rule->getUntil());
        $this->assertSame($count, $rule->getCount());
        $this->assertSame($interval, $rule->getInterval());
        $this->assertSame($bySecond, $rule->getBySecond());
        $this->assertSame($byMinute, $rule->getByMinute());
        $this->assertSame($byHour, $rule->getByHour());
        $this->assertSame($byDay, $rule->getByDay());
        $this->assertSame($byMonthDay, $rule->getByMonthDay());
        $this->assertSame($byYearDay, $rule->getByYearDay());
        $this->assertSame($byWeekNo, $rule->getByWeekNo());
        $this->assertSame($byMonth, $rule->getByMonth());
        $this->assertSame($bySetPos, $rule->getBySetPos());
        $this->assertSame($weekStart, $rule->getWeekStart());
        $this->assertSame([$xName, $xName], $rule->getXNames());
        $rule->setXNames([$xName]);

        $xml = <<<EOT
<?xml version="1.0"?>
<rule freq="HOU">
    <until d="$date" />
    <count num="$num" />
    <interval ival="$ival" />
    <bysecond seclist="$seclist" />
    <byminute minlist="$minlist" />
    <byhour hrlist="$hrlist" />
    <byday>
        <wkday day="SU" ordwk="$ordWk" />
    </byday>
    <bymonthday modaylist="$modaylist" />
    <byyearday yrdaylist="$yrdaylist" />
    <byweekno wklist="$wklist" />
    <bymonth molist="$molist" />
    <bysetpos poslist="$poslist" />
    <wkst day="SU" />
    <rule-x-name name="$name" value="$value" />
</rule>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($rule, 'xml'));
        $this->assertEquals($rule, $this->serializer->deserialize($xml, SimpleRepeatingRule::class, 'xml'));

        $json = json_encode([
            'freq' => 'HOU',
            'until' => [
                'd' => $date,
            ],
            'count' => [
                'num' => $num,
            ],
            'interval' => [
                'ival' => $ival,
            ],
            'bysecond' => [
                'seclist' => $seclist,
            ],
            'byminute' => [
                'minlist' => $minlist,
            ],
            'byhour' => [
                'hrlist' => $hrlist,
            ],
            'byday' => [
                'wkday' => [
                    [
                        'day' => 'SU',
                        'ordwk' => $ordWk,
                    ],
                ],
            ],
            'bymonthday' => [
                'modaylist' => $modaylist,
            ],
            'byyearday' => [
                'yrdaylist' => $yrdaylist,
            ],
            'byweekno' => [
                'wklist' => $wklist,
            ],
            'bymonth' => [
                'molist' => $molist,
            ],
            'bysetpos' => [
                'poslist' => $poslist,
            ],
            'wkst' => [
                'day' => 'SU',
            ],
            'rule-x-name' => [
                [
                    'name' => $name,
                    'value' => $value,
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($rule, 'json'));
        $this->assertEquals($rule, $this->serializer->deserialize($json, SimpleRepeatingRule::class, 'json'));
    }
}
