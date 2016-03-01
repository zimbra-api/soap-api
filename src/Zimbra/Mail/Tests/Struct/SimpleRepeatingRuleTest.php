<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Enum\WeekDay;
use Zimbra\Enum\Frequency;
use Zimbra\Mail\Struct\SimpleRepeatingRule;

/**
 * Testcase class for SimpleRepeatingRule.
 */
class SimpleRepeatingRuleTest extends ZimbraMailTestCase
{
    public function testSimpleRepeatingRule()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $date = $this->faker->iso8601;

        $num = mt_rand(1, 100);
        $ival = mt_rand(1, 100);
        $ordwk = mt_rand(1, 53);

        $quantity = mt_rand(5, 10);
        $numbers = self::randomRange(0, 59, $quantity);
        $seclist = $minlist = implode(',', $numbers);
        $numbers = self::randomRange(0, 23, $quantity);
        $hrlist = implode(',', $numbers);
        $numbers = self::randomRange(1, 31, $quantity);
        $modaylist = implode(',', $numbers);
        $numbers = self::randomRange(1, 366, $quantity);
        $yrdaylist = implode(',', $numbers);
        $numbers = self::randomRange(1, 53, $quantity);
        $wklist = implode(',', $numbers);
        $numbers = self::randomRange(1, 12, $quantity);
        $molist = implode(',', $numbers);
        $numbers = self::randomRange(1, 366, $quantity);
        $poslist = implode(',', $numbers);

        $wkday = new \Zimbra\Mail\Struct\WkDay(WeekDay::SU(), $ordwk);
        $until = new \Zimbra\Mail\Struct\DateTimeStringAttr($date);
        $count = new \Zimbra\Mail\Struct\NumAttr($num);
        $interval = new \Zimbra\Mail\Struct\IntervalRule($ival);
        $bysecond = new \Zimbra\Mail\Struct\BySecondRule($seclist);
        $byminute = new \Zimbra\Mail\Struct\ByMinuteRule($minlist);
        $byhour = new \Zimbra\Mail\Struct\ByHourRule($hrlist);
        $byday = new \Zimbra\Mail\Struct\ByDayRule([$wkday]);
        $bymonthday = new \Zimbra\Mail\Struct\ByMonthDayRule($modaylist);
        $byyearday = new \Zimbra\Mail\Struct\ByYearDayRule($yrdaylist);
        $byweekno = new \Zimbra\Mail\Struct\ByWeekNoRule($wklist);
        $bymonth = new \Zimbra\Mail\Struct\ByMonthRule($molist);
        $bysetpos = new \Zimbra\Mail\Struct\BySetPosRule($poslist);
        $wkst = new \Zimbra\Mail\Struct\WkstRule(WeekDay::SU());
        $xname = new \Zimbra\Mail\Struct\XNameRule($name, $value);

        $rule = new SimpleRepeatingRule(
            Frequency::SECOND(),
            $until,
            $count,
            $interval,
            $bysecond,
            $byminute,
            $byhour,
            $byday,
            $bymonthday,
            $byyearday,
            $byweekno,
            $bymonth,
            $bysetpos,
            $wkst,
            [$xname]
        );
        $this->assertSame('SEC', (string) $rule->getFrequency());
        $this->assertSame($until, $rule->getUntil());
        $this->assertSame($count, $rule->getCount());
        $this->assertSame($interval, $rule->getInterval());
        $this->assertSame($bysecond, $rule->getBySecond());
        $this->assertSame($byminute, $rule->getByMinute());
        $this->assertSame($byhour, $rule->getByHour());
        $this->assertSame($byday, $rule->getByDay());
        $this->assertSame($bymonthday, $rule->getByMonthDay());
        $this->assertSame($byyearday, $rule->getByYearDay());
        $this->assertSame($byweekno, $rule->getByWeekNo());
        $this->assertSame($bymonth, $rule->getByMonth());
        $this->assertSame($bysetpos, $rule->getBySetPos());
        $this->assertSame($wkst, $rule->getWeekStart());
        $this->assertSame([$xname], $rule->getRuleXNames()->all());

        $rule = new SimpleRepeatingRule(Frequency::MINUTE());
        $rule->setFrequency(Frequency::SECOND())
             ->setUntil($until)
             ->setCount($count)
             ->setInterval($interval)
             ->setBySecond($bysecond)
             ->setByMinute($byminute)
             ->setByHour($byhour)
             ->setByDay($byday)
             ->setByMonthDay($bymonthday)
             ->setByYearDay($byyearday)
             ->setByWeekNo($byweekno)
             ->setByMonth($bymonth)
             ->setBySetPos($bysetpos)
             ->setWeekStart($wkst)
             ->addXNameRule($xname);
        $this->assertSame('SEC', (string) $rule->getFrequency());
        $this->assertSame($until, $rule->getUntil());
        $this->assertSame($count, $rule->getCount());
        $this->assertSame($interval, $rule->getInterval());
        $this->assertSame($bysecond, $rule->getBySecond());
        $this->assertSame($byminute, $rule->getByMinute());
        $this->assertSame($byhour, $rule->getByHour());
        $this->assertSame($byday, $rule->getByDay());
        $this->assertSame($bymonthday, $rule->getByMonthDay());
        $this->assertSame($byyearday, $rule->getByYearDay());
        $this->assertSame($byweekno, $rule->getByWeekNo());
        $this->assertSame($bymonth, $rule->getByMonth());
        $this->assertSame($bysetpos, $rule->getBySetPos());
        $this->assertSame($wkst, $rule->getWeekStart());
        $this->assertSame([$xname], $rule->getRuleXNames()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<rule freq="' . Frequency::SECOND() . '">'
                .'<until d="' . $date . '" />'
                .'<count num="' . $num . '" />'
                .'<interval ival="' . $ival . '" />'
                .'<bysecond seclist="' . $seclist . '" />'
                .'<byminute minlist="' . $minlist . '" />'
                .'<byhour hrlist="' . $hrlist . '" />'
                .'<byday>'
                    .'<wkday day="' . WeekDay::SU() . '" ordwk="' . $ordwk . '" />'
                .'</byday>'
                .'<bymonthday modaylist="' . $modaylist . '" />'
                .'<byyearday yrdaylist="' . $yrdaylist . '" />'
                .'<byweekno wklist="' . $wklist . '" />'
                .'<bymonth molist="' . $molist . '" />'
                .'<bysetpos poslist="' . $poslist . '" />'
                .'<wkst day="' . WeekDay::SU() . '" />'
                .'<rule-x-name name="' . $name . '" value="' . $value . '" />'
            .'</rule>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $rule);

        $array = array(
            'rule' => array(
                'freq' => Frequency::SECOND()->value(),
                'until' => array(
                    'd' => $date,
                ),
                'count' => array(
                    'num' => $num,
                ),
                'interval' => array(
                    'ival' => $ival,
                ),
                'bysecond' => array(
                    'seclist' => $seclist,
                ),
                'byminute' => array(
                    'minlist' => $minlist,
                ),
                'byhour' => array(
                    'hrlist' => $hrlist,
                ),
                'byday' => array(
                    'wkday' => array(
                        array(
                            'day' => WeekDay::SU()->value(),
                            'ordwk' => $ordwk,
                        ),
                    )
                ),
                'bymonthday' => array(
                    'modaylist' => $modaylist,
                ),
                'byyearday' => array(
                    'yrdaylist' => $yrdaylist,
                ),
                'byweekno' => array(
                    'wklist' => $wklist,
                ),
                'bymonth' => array(
                    'molist' => $molist,
                ),
                'bysetpos' => array(
                    'poslist' => $poslist,
                ),
                'wkst' => array(
                    'day' => WeekDay::SU()->value(),
                ),
                'rule-x-name' => array(
                    array(
                        'name' => $name,
                        'value' => $value,
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $rule->toArray());
    }
}
