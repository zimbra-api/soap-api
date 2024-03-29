<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

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
        $id = $this->faker->uuid;
        $tzStdOffset = $this->faker->randomNumber;
        $tzDayOffset = $this->faker->randomNumber;
        $standardTZName = $this->faker->word;
        $daylightTZName = $this->faker->word;

        $mon = $this->faker->numberBetween(1, 12);
        $hour = $this->faker->numberBetween(0, 23);
        $min = $this->faker->numberBetween(0, 59);
        $sec = $this->faker->numberBetween(0, 59);
        $mday = $this->faker->numberBetween(1, 31);
        $week = $this->faker->numberBetween(1, 4);
        $wkday = $this->faker->numberBetween(1, 7);

        $standardTzOnset = new TzOnsetInfo($mon, $hour, $min, $sec, $mday, $week, $wkday);
        $daylightTzOnset = new TzOnsetInfo($mon, $hour, $min, $sec, $mday, $week, $wkday);

        $tz = new StubCalTZInfo(
            $id, $tzStdOffset, $tzDayOffset, $standardTzOnset, $daylightTzOnset, $standardTZName, $daylightTZName
        );
        $this->assertSame($id, $tz->getId());
        $this->assertSame($tzStdOffset, $tz->getTzStdOffset());
        $this->assertSame($tzDayOffset, $tz->getTzDayOffset());
        $this->assertSame($standardTzOnset, $tz->getStandardTzOnset());
        $this->assertSame($daylightTzOnset, $tz->getDaylightTzOnset());
        $this->assertSame($standardTZName, $tz->getStandardTZName());
        $this->assertSame($daylightTZName, $tz->getDaylightTZName());

        $tz = new StubCalTZInfo();
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
<result id="$id" stdoff="$tzStdOffset" dayoff="$tzDayOffset" stdname="$standardTZName" dayname="$daylightTZName" xmlns:urn="urn:zimbraMail">
    <urn:standard mon="$mon" hour="$hour" min="$min" sec="$sec" mday="$mday" week="$week" wkday="$wkday" />
    <urn:daylight mon="$mon" hour="$hour" min="$min" sec="$sec" mday="$mday" week="$week" wkday="$wkday" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($tz, 'xml'));
        $this->assertEquals($tz, $this->serializer->deserialize($xml, StubCalTZInfo::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraMail', prefix: "urn")]
class StubCalTZInfo extends CalTZInfo
{
}
