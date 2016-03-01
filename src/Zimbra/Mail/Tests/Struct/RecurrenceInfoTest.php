<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Enum\Frequency;
use Zimbra\Enum\WeekDay;
use Zimbra\Mail\Struct\RecurrenceInfo;

/**
 * Testcase class for RecurrenceInfo.
 */
class RecurrenceInfoTest extends ZimbraMailTestCase
{
    public function testRecurrenceInfo()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $rangeType = mt_rand(1, 10);
        $recurId = $this->faker->iso8601;
        $tz = $this->faker->word;
        $ridZ = $this->faker->iso8601;
        $date = $this->faker->iso8601;
        $utc = mt_rand(0, 24);

        $weeks = mt_rand(1, 7);
        $days = mt_rand(1, 30);
        $hours = mt_rand(0, 23);
        $minutes = mt_rand(0, 59);
        $seconds = mt_rand(0, 59);
        $related = $this->faker->randomElement(['START', 'END']);

        $ordwk = mt_rand(1, 53);
        $num = mt_rand(1, 100);
        $ival = mt_rand(1, 100);

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

        $except = new \Zimbra\Mail\Struct\ExceptionRuleInfo(
            $rangeType, $recurId, null, null, $tz, $ridZ
        );
        $cancel = new \Zimbra\Mail\Struct\CancelRuleInfo(
            $rangeType, $recurId, $tz, $ridZ
        );

        $s = new \Zimbra\Mail\Struct\DtTimeInfo(
            $date, $tz, $utc
        );
        $e = new \Zimbra\Mail\Struct\DtTimeInfo(
            $date, $tz, $utc
        );
        $dur = new \Zimbra\Mail\Struct\DurationInfo(
            true, $weeks, $days, $hours, $minutes, $seconds, $related, $num
        );
        $dtval = new \Zimbra\Mail\Struct\DtVal($s, $e, $dur);
        $dates = new \Zimbra\Mail\Struct\SingleDates($tz, [$dtval]);

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
        $rule = new \Zimbra\Mail\Struct\SimpleRepeatingRule(
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
        $add = new \Zimbra\Mail\Struct\AddRecurrenceInfo([$except, $cancel, $dates, $rule]);
        $exclude = new \Zimbra\Mail\Struct\ExcludeRecurrenceInfo([$except, $cancel, $dates, $rule]);

        $recur = new RecurrenceInfo([$add, $exclude, $except, $cancel, $dates]);

        $this->assertSame([$add, $exclude, $except, $cancel, $dates], $recur->getRules()->all());

        $recur->addRule($rule);
        $this->assertSame([$add, $exclude, $except, $cancel, $dates, $rule], $recur->getRules()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<recur>'
                .'<add>'
                    .'<except rangeType="' . $rangeType . '" recurId="' . $recurId . '" tz="' . $tz . '" ridZ="' . $ridZ . '" />'
                    .'<cancel rangeType="' . $rangeType . '" recurId="' . $recurId . '" tz="' . $tz . '" ridZ="' . $ridZ . '" />'
                    .'<dates tz="' . $tz . '">'
                        .'<dtval>'
                            .'<s d="' . $date . '" tz="' . $tz . '" u="' . $utc . '" />'
                            .'<e d="' . $date . '" tz="' . $tz . '" u="' . $utc . '" />'
                            .'<dur neg="true" w="' . $weeks . '" d="' . $days . '" h="' . $hours . '" m="' . $minutes . '" s="' . $seconds . '" related="' . $related . '" count="' . $num . '" />'
                        .'</dtval>'
                    .'</dates>'
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
                    .'</rule>'
                .'</add>'
                .'<exclude>'
                    .'<except rangeType="' . $rangeType . '" recurId="' . $recurId . '" tz="' . $tz . '" ridZ="' . $ridZ . '" />'
                    .'<cancel rangeType="' . $rangeType . '" recurId="' . $recurId . '" tz="' . $tz . '" ridZ="' . $ridZ . '" />'
                    .'<dates tz="' . $tz . '">'
                        .'<dtval>'
                            .'<s d="' . $date . '" tz="' . $tz . '" u="' . $utc . '" />'
                            .'<e d="' . $date . '" tz="' . $tz . '" u="' . $utc . '" />'
                            .'<dur neg="true" w="' . $weeks . '" d="' . $days . '" h="' . $hours . '" m="' . $minutes . '" s="' . $seconds . '" related="' . $related . '" count="' . $num . '" />'
                        .'</dtval>'
                    .'</dates>'
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
                    .'</rule>'
                .'</exclude>'
                .'<except rangeType="' . $rangeType . '" recurId="' . $recurId . '" tz="' . $tz . '" ridZ="' . $ridZ . '" />'
                .'<cancel rangeType="' . $rangeType . '" recurId="' . $recurId . '" tz="' . $tz . '" ridZ="' . $ridZ . '" />'
                .'<dates tz="' . $tz . '">'
                    .'<dtval>'
                        .'<s d="' . $date . '" tz="' . $tz . '" u="' . $utc . '" />'
                        .'<e d="' . $date . '" tz="' . $tz . '" u="' . $utc . '" />'
                        .'<dur neg="true" w="' . $weeks . '" d="' . $days . '" h="' . $hours . '" m="' . $minutes . '" s="' . $seconds . '" related="' . $related . '" count="' . $num . '" />'
                    .'</dtval>'
                .'</dates>'
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
                .'</rule>'
            .'</recur>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $recur);

        $array = array(
            'recur' => array(
                'add' => array(
                    'except' => array(
                        'rangeType' => $rangeType,
                        'recurId' => $recurId,
                        'tz' => $tz,
                        'ridZ' => $ridZ,
                    ),
                    'cancel' => array(
                        'rangeType' => $rangeType,
                        'recurId' => $recurId,
                        'tz' => $tz,
                        'ridZ' => $ridZ,
                    ),
                    'dates' => array(
                        'tz' => $tz,
                        'dtval' => array(
                            array(
                                's' => array(
                                    'd' => $date,
                                    'tz' => $tz,
                                    'u' => $utc,
                                ),
                                'e' => array(
                                    'd' => $date,
                                    'tz' => $tz,
                                    'u' => $utc,
                                ),
                                'dur' => array(
                                    'neg' => true,
                                    'w' => $weeks,
                                    'd' => $days,
                                    'h' => $hours,
                                    'm' => $minutes,
                                    's' => $seconds,
                                    'related' => $related,
                                    'count' => $num,
                                ),
                            ),
                        ),
                    ),
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
                ),
                'exclude' => array(
                    'except' => array(
                        'rangeType' => $rangeType,
                        'recurId' => $recurId,
                        'tz' => $tz,
                        'ridZ' => $ridZ,
                    ),
                    'cancel' => array(
                        'rangeType' => $rangeType,
                        'recurId' => $recurId,
                        'tz' => $tz,
                        'ridZ' => $ridZ,
                    ),
                    'dates' => array(
                        'tz' => $tz,
                        'dtval' => array(
                            array(
                                's' => array(
                                    'd' => $date,
                                    'tz' => $tz,
                                    'u' => $utc,
                                ),
                                'e' => array(
                                    'd' => $date,
                                    'tz' => $tz,
                                    'u' => $utc,
                                ),
                                'dur' => array(
                                    'neg' => true,
                                    'w' => $weeks,
                                    'd' => $days,
                                    'h' => $hours,
                                    'm' => $minutes,
                                    's' => $seconds,
                                    'related' => $related,
                                    'count' => $num,
                                ),
                            ),
                        ),
                    ),
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
                ),
                'except' => array(
                    'rangeType' => $rangeType,
                    'recurId' => $recurId,
                    'tz' => $tz,
                    'ridZ' => $ridZ,
                ),
                'cancel' => array(
                    'rangeType' => $rangeType,
                    'recurId' => $recurId,
                    'tz' => $tz,
                    'ridZ' => $ridZ,
                ),
                'dates' => array(
                    'tz' => $tz,
                    'dtval' => array(
                        array(
                            's' => array(
                                'd' => $date,
                                'tz' => $tz,
                                'u' => $utc,
                            ),
                            'e' => array(
                                'd' => $date,
                                'tz' => $tz,
                                'u' => $utc,
                            ),
                            'dur' => array(
                                'neg' => true,
                                'w' => $weeks,
                                'd' => $days,
                                'h' => $hours,
                                'm' => $minutes,
                                's' => $seconds,
                                'related' => $related,
                                'count' => $num,
                            ),
                        ),
                    ),
                ),
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
            ),
        );
        $this->assertEquals($array, $recur->toArray());
    }
}
