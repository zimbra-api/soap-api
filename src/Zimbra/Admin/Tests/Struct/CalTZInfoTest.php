<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\CalTZInfo;
use Zimbra\Struct\TzOnsetInfo;

/**
 * Testcase class for CalTZInfo.
 */
class CalTZInfoTest extends ZimbraAdminTestCase
{
    public function testCalTZInfo()
    {
        $std_mon = mt_rand(1, 12);
        $std_hour = mt_rand(0, 23);
        $std_min = mt_rand(0, 59);
        $std_sec = mt_rand(0, 59);
        $standard = new TzOnsetInfo($std_mon, $std_hour, $std_min, $std_sec);

        $day_mon = mt_rand(1, 12);
        $day_hour = mt_rand(0, 23);
        $day_min = mt_rand(0, 59);
        $day_sec = mt_rand(0, 59);
        $daylight = new TzOnsetInfo($day_mon, $day_hour, $day_min, $day_sec);

        $id = $this->faker->word;
        $stdname = $this->faker->word;
        $dayname = $this->faker->word;
        $stdoff = mt_rand(0, 100);
        $dayoff = mt_rand(0, 100);
        $tzi = new CalTZInfo($id, $stdoff, $dayoff, $daylight, $standard, $stdname, $dayname);

        $this->assertSame($id, $tzi->getId());
        $this->assertSame($stdoff, $tzi->getTzStdOffset());
        $this->assertSame($dayoff, $tzi->getTzDayOffset());
        $this->assertSame($stdname, $tzi->getStandardTZName());
        $this->assertSame($dayname, $tzi->getDaylightTZName());
        $this->assertSame($daylight, $tzi->getStandardTzOnset());
        $this->assertSame($standard, $tzi->getDaylightTzOnset());

        $tzi->setId($id)
            ->setTzStdOffset($stdoff)
            ->setTzDayOffset($dayoff)
            ->setStandardTZName($stdname)
            ->setDaylightTZName($dayname)
            ->setStandardTzOnset($standard)
            ->setDaylightTzOnset($daylight);
        $this->assertSame($id, $tzi->getId());
        $this->assertSame($stdoff, $tzi->getTzStdOffset());
        $this->assertSame($dayoff, $tzi->getTzDayOffset());
        $this->assertSame($stdname, $tzi->getStandardTZName());
        $this->assertSame($dayname, $tzi->getDaylightTZName());
        $this->assertSame($standard, $tzi->getStandardTzOnset());
        $this->assertSame($daylight, $tzi->getDaylightTzOnset());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<tz id="' . $id . '" stdoff="' . $stdoff . '" dayoff="' . $dayoff . '" stdname="' . $stdname . '" dayname="' . $dayname . '">'
                . '<standard mon="' . $std_mon . '" hour="' . $std_hour . '" min="' . $std_min . '" sec="' . $std_sec . '" />'
                . '<daylight mon="' . $day_mon . '" hour="' . $day_hour . '" min="' . $day_min . '" sec="' . $day_sec . '" />'
            . '</tz>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $tzi);

        $array = [
            'tz' => [
                'id' => $id,
                'stdoff' => $stdoff,
                'dayoff' => $dayoff,
                'stdname' => $stdname,
                'dayname' => $dayname,
                'standard' => [
                    'mon' => $std_mon,
                    'hour' => $std_hour,
                    'min' => $std_min,
                    'sec' => $std_sec,
                ],
                'daylight' => [
                    'mon' => $day_mon,
                    'hour' => $day_hour,
                    'min' => $day_min,
                    'sec' => $day_sec,
                ],
            ],
        ];
        $this->assertEquals($array, $tzi->toArray());
    }
}
