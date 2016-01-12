<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\CalTZInfo;
use Zimbra\Struct\TzOnsetInfo;

/**
 * Testcase class for CalTZInfo.
 */
class CalTZInfoTest extends ZimbraMailTestCase
{
    public function testCalTZInfo()
    {
        $std_mon = mt_rand(1, 12);
        $std_hour = mt_rand(0, 23);
        $std_min = mt_rand(0, 59);
        $std_sec = mt_rand(0, 59);
        $std_mday = mt_rand(1, 31);
        $std_week = mt_rand(1, 4);
        $std_wkday = mt_rand(1, 7);
        $standard = new TzOnsetInfo(
        	$std_mon, $std_hour, $std_min, $std_sec, $std_mday, $std_week, $std_wkday
    	);

        $day_mon = mt_rand(1, 12);
        $day_hour = mt_rand(0, 23);
        $day_min = mt_rand(0, 59);
        $day_sec = mt_rand(0, 59);
        $day_mday = mt_rand(1, 31);
        $day_week = mt_rand(1, 4);
        $day_wkday = mt_rand(1, 7);
        $daylight = new TzOnsetInfo(
        	$day_mon, $day_hour, $day_min, $day_sec, $day_mday, $day_week, $day_wkday
    	);

        $id = $this->faker->uuid;
        $stdoff = mt_rand(1, 10);
        $dayoff = mt_rand(1, 10);
        $stdname = $this->faker->word;
        $dayname = $this->faker->word;
        $tzi = new CalTZInfo($id, $stdoff, $dayoff, $daylight, $standard, $stdname, $dayname);

        $this->assertSame($id, $tzi->getId());
        $this->assertSame($stdoff, $tzi->getTzStdOffset());
        $this->assertSame($dayoff, $tzi->getTzDayOffset());
        $this->assertSame($daylight, $tzi->getStandardTzOnset());
        $this->assertSame($standard, $tzi->getDaylightTzOnset());
        $this->assertSame($stdname, $tzi->getStandardTZName());
        $this->assertSame($dayname, $tzi->getDaylightTZName());

        $tzi->setId($id)
            ->setTzStdOffset($stdoff)
            ->setTzDayOffset($dayoff)
            ->setStandardTzOnset($standard)
            ->setDaylightTzOnset($daylight)
            ->setStandardTZName($stdname)
            ->setDaylightTZName($dayname);
        $this->assertSame($id, $tzi->getId());
        $this->assertSame($stdoff, $tzi->getTzStdOffset());
        $this->assertSame($dayoff, $tzi->getTzDayOffset());
        $this->assertSame($standard, $tzi->getStandardTzOnset());
        $this->assertSame($daylight, $tzi->getDaylightTzOnset());
        $this->assertSame($stdname, $tzi->getStandardTZName());
        $this->assertSame($dayname, $tzi->getDaylightTZName());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<tz id="' . $id . '" stdoff="' . $stdoff . '" dayoff="' . $dayoff . '" stdname="' . $stdname . '" dayname="' . $dayname . '">'
                . '<standard mon="' . $std_mon . '" hour="' . $std_hour . '" min="' . $std_min . '" sec="' . $std_sec . '" mday="' . $std_mday . '" week="' . $std_week . '" wkday="' . $std_wkday . '" />'
                . '<daylight mon="' . $day_mon . '" hour="' . $day_hour . '" min="' . $day_min . '" sec="' . $day_sec . '" mday="' . $day_mday . '" week="' . $day_week . '" wkday="' . $day_wkday . '" />'
            .'</tz>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $tzi);

        $array = array(
            'tz' => array(
                'id' => $id,
                'stdoff' => $stdoff,
                'dayoff' => $dayoff,
                'stdname' => $stdname,
                'dayname' => $dayname,
                'standard' => array(
                    'mon' => $std_mon,
                    'hour' => $std_hour,
                    'min' => $std_min,
                    'sec' => $std_sec,
                    'mday' => $std_mday,
                    'week' => $std_week,
                    'wkday' => $std_wkday,
                ),
                'daylight' => array(
                    'mon' => $day_mon,
                    'hour' => $day_hour,
                    'min' => $day_min,
                    'sec' => $day_sec,
                    'mday' => $day_mday,
                    'week' => $day_week,
                    'wkday' => $day_wkday,
                ),
            ),
        );
        $this->assertEquals($array, $tzi->toArray());
    }
}
