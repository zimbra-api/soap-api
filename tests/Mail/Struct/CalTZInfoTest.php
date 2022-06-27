<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Common\Struct\TzOnsetInfo;
use Zimbra\Mail\Struct\CalTZInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CalTZInfo.
 */
class CalTZInfoTest extends ZimbraTestCase
{
    public function testCalTZInfo()
    {
        $id = $this->faker->word;
        $tzStdOffset = $this->faker->randomNumber;
        $tzDayOffset = $this->faker->randomNumber;
        $standardTZName = $this->faker->word;
        $daylightTZName = $this->faker->word;

        $mon = mt_rand(1, 12);
        $hour = mt_rand(0, 23);
        $min = mt_rand(0, 59);
        $sec = mt_rand(0, 59);
        $mday = mt_rand(1, 31);
        $week = mt_rand(1, 4);
        $wkday = mt_rand(1, 7);

        $standardTzOnset = new TzOnsetInfo($mon, $hour, $min, $sec, $mday, $week, $wkday);
        $daylightTzOnset = new TzOnsetInfo($mon, $hour, $min, $sec, $mday, $week, $wkday);

        $tz = new CalTZInfo(
            $id, $tzStdOffset, $tzDayOffset, $standardTzOnset, $daylightTzOnset, $standardTZName, $daylightTZName
        );
        $this->assertSame($id, $tz->getId());
        $this->assertSame($tzStdOffset, $tz->getTzStdOffset());
        $this->assertSame($tzDayOffset, $tz->getTzDayOffset());
        $this->assertSame($standardTzOnset, $tz->getStandardTzOnset());
        $this->assertSame($daylightTzOnset, $tz->getDaylightTzOnset());
        $this->assertSame($standardTZName, $tz->getStandardTZName());
        $this->assertSame($daylightTZName, $tz->getDaylightTZName());

        $tz = new CalTZInfo('', 0, 0);
        $tz->setId($id)
            ->setTzStdOffset($tzStdOffset)
            ->setTzDayOffset($tzDayOffset)
            ->setStandardTzOnset($standardTzOnset)
            ->setDaylightTzOnset($daylightTzOnset)
            ->setStandardTZName($standardTZName)
            ->setDaylightTZName($daylightTZName);
        $this->assertSame($id, $tz->getId());
        $this->assertSame($tzStdOffset, $tz->getTzStdOffset());
        $this->assertSame($tzDayOffset, $tz->getTzDayOffset());
        $this->assertSame($standardTzOnset, $tz->getStandardTzOnset());
        $this->assertSame($daylightTzOnset, $tz->getDaylightTzOnset());
        $this->assertSame($standardTZName, $tz->getStandardTZName());
        $this->assertSame($daylightTZName, $tz->getDaylightTZName());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" stdoff="$tzStdOffset" dayoff="$tzDayOffset" stdname="$standardTZName" dayname="$daylightTZName">
    <standard mon="$mon" hour="$hour" min="$min" sec="$sec" mday="$mday" week="$week" wkday="$wkday" />
    <daylight mon="$mon" hour="$hour" min="$min" sec="$sec" mday="$mday" week="$week" wkday="$wkday" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($tz, 'xml'));
        $this->assertEquals($tz, $this->serializer->deserialize($xml, CalTZInfo::class, 'xml'));
    }
}
