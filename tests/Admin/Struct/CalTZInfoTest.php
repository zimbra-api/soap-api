<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\CalTZInfo;
use Zimbra\Struct\TzOnsetInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CalTZInfo.
 */
class CalTZInfoTest extends ZimbraTestCase
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

        $tzi = new CalTZInfo('', 0, 0);
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

        $xml = <<<EOT
<?xml version="1.0"?>
<tz id="$id" stdoff="$stdoff" dayoff="$dayoff" stdname="$stdname" dayname="$dayname">
    <standard mon="$std_mon" hour="$std_hour" min="$std_min" sec="$std_sec" />
    <daylight mon="$day_mon" hour="$day_hour" min="$day_min" sec="$day_sec" />
</tz>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($tzi, 'xml'));
        $this->assertEquals($tzi, $this->serializer->deserialize($xml, CalTZInfo::class, 'xml'));

        $json = json_encode([
            'id' => $id,
            'stdoff' => $stdoff,
            'dayoff' => $dayoff,
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
            'stdname' => $stdname,
            'dayname' => $dayname,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($tzi, 'json'));
        $this->assertEquals($tzi, $this->serializer->deserialize($json, CalTZInfo::class, 'json'));
    }
}