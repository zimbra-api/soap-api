<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\DtVal;
use Zimbra\Mail\Struct\DtTimeInfo;
use Zimbra\Mail\Struct\DurationInfo;

/**
 * Testcase class for DtVal.
 */
class DtValTest extends ZimbraMailTestCase
{
    public function testDtVal()
    {
        $s_date = $this->faker->iso8601;
        $s_tz = $this->faker->word;
        $s_utc = mt_rand(0, 24);

        $s = new DtTimeInfo(
            $s_date, $s_tz, $s_utc
        );

        $e_date = $this->faker->iso8601;
        $e_tz = $this->faker->word;
        $e_utc = mt_rand(0, 24);
        $e = new DtTimeInfo(
            $e_date, $e_tz, $e_utc
        );

        $weeks = mt_rand(1, 7);
        $days = mt_rand(1, 30);
        $hours = mt_rand(0, 23);
        $minutes = mt_rand(0, 59);
        $seconds = mt_rand(0, 59);
        $related = $this->faker->randomElement(['START', 'END']);
        $count = mt_rand(0, 99);
        $dur = new DurationInfo(true, $weeks, $days, $hours, $minutes, $seconds, $related, $count);

        $dtval = new DtVal($s, $e, $dur);
        $this->assertSame($s, $dtval->getStartTime());
        $this->assertSame($e, $dtval->getEndTime());
        $this->assertSame($dur, $dtval->getDuration());

        $dtval->setStartTime($s)
              ->setEndTime($e)
              ->setDuration($dur);
        $this->assertSame($s, $dtval->getStartTime());
        $this->assertSame($e, $dtval->getEndTime());
        $this->assertSame($dur, $dtval->getDuration());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<dtval>'
                .'<s d="' . $s_date . '" tz="' . $s_tz . '" u="' . $s_utc . '" />'
                .'<e d="' . $e_date . '" tz="' . $e_tz . '" u="' . $e_utc . '" />'
                .'<dur neg="true" w="' . $weeks . '" d="' . $days . '" h="' . $hours . '" m="' . $minutes . '" s="' . $seconds . '" related="' . $related . '" count="' . $count . '" />'
            .'</dtval>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $dtval);

        $array = array(
            'dtval' => array(
                's' => array(
                    'd' => $s_date,
                    'tz' => $s_tz,
                    'u' => $s_utc,
                ),
                'e' => array(
                    'd' => $e_date,
                    'tz' => $e_tz,
                    'u' => $e_utc,
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
        );
        $this->assertEquals($array, $dtval->toArray());
    }
}
