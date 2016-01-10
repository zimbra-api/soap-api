<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Enum\AceRightType;
use Zimbra\Mail\Struct\SingleDates;

/**
 * Testcase class for SingleDates.
 */
class SingleDatesTest extends ZimbraMailTestCase
{
    public function testSingleDates()
    {
        $tz = $this->faker->word;
        $date = $this->faker->iso8601;
        $utc = mt_rand(0, 24);

        $weeks = mt_rand(1, 7);
        $days = mt_rand(1, 30);
        $hours = mt_rand(0, 23);
        $minutes = mt_rand(0, 59);
        $seconds = mt_rand(0, 59);
        $related = $this->faker->randomElement(['START', 'END']);
        $count = mt_rand(1, 100);

        $s = new \Zimbra\Mail\Struct\DtTimeInfo(
            $date, $tz, $utc
        );
        $e = new \Zimbra\Mail\Struct\DtTimeInfo(
            $date, $tz, $utc
        );
        $dur = new \Zimbra\Mail\Struct\DurationInfo(
            true, $weeks, $days, $hours, $minutes, $seconds, $related, $count
        );
        $dtval = new \Zimbra\Mail\Struct\DtVal($s, $e, $dur);

        $dates = new SingleDates($tz, [$dtval]);
        $this->assertSame($tz, $dates->getTimezone());
        $this->assertSame([$dtval], $dates->getDtVals()->all());

        $dates = new SingleDates();
        $dates->setTimezone($tz)
              ->addDtVal($dtval);
        $this->assertSame($tz, $dates->getTimezone());
        $this->assertSame([$dtval], $dates->getDtVals()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<dates tz="' . $tz . '">'
                .'<dtval>'
                    .'<s d="' . $date . '" tz="' . $tz . '" u="' . $utc . '" />'
                    .'<e d="' . $date . '" tz="' . $tz . '" u="' . $utc . '" />'
                    .'<dur neg="true" w="' . $weeks . '" d="' . $days . '" h="' . $hours . '" m="' . $minutes . '" s="' . $seconds . '" related="' . $related . '" count="' . $count . '" />'
                .'</dtval>'
            .'</dates>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $dates);

        $array = array(
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
                            'count' => $count,
                        ),
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $dates->toArray());
    }
}
