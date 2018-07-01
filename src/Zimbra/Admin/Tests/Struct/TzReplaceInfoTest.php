<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\CalTZInfo;
use Zimbra\Admin\Struct\TzReplaceInfo;
use Zimbra\Struct\TzOnsetInfo;
use Zimbra\Struct\Id;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for TzReplaceInfo.
 */
class TzReplaceInfoTest extends ZimbraStructTestCase
{
    public function testTzReplaceInfo()
    {
        $id = $this->faker->word;
        $mon = mt_rand(1, 12);
        $hour = mt_rand(0, 23);
        $min = mt_rand(0, 59);
        $sec = mt_rand(0, 59);
        $wellKnownTz = new Id($id);
        $standard = new TzOnsetInfo($mon, $hour, $min, $sec);
        $daylight = new TzOnsetInfo($mon, $hour, $min, $sec);

        $stdname = $this->faker->word;
        $dayname = $this->faker->word;
        $stdoff = mt_rand(0, 100);
        $dayoff = mt_rand(0, 100);
        $tz = new CalTZInfo($id, $stdoff, $dayoff, $standard, $daylight, $stdname, $dayname);

        $replace = new TzReplaceInfo($wellKnownTz, $tz);
        $this->assertSame($wellKnownTz, $replace->getWellKnownTz());
        $this->assertSame($tz, $replace->getCalTz());

        $replace = new TzReplaceInfo();
        $replace->setWellKnownTz($wellKnownTz)
                ->setCalTz($tz);
        $this->assertSame($wellKnownTz, $replace->getWellKnownTz());
        $this->assertSame($tz, $replace->getCalTz());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<replace>'
                . '<wellKnownTz id="' . $id . '" />'
                . '<tz id="' . $id . '" stdoff="' . $stdoff . '" dayoff="' . $dayoff . '" stdname="' . $stdname . '" dayname="' . $dayname . '">'
                    . '<standard mon="' . $mon . '" hour="' . $hour . '" min="' . $min . '" sec="' . $sec . '" />'
                    . '<daylight mon="' . $mon . '" hour="' . $hour . '" min="' . $min . '" sec="' . $sec . '" />'
                . '</tz>'
            . '</replace>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($replace, 'xml'));

        $replace = $this->serializer->deserialize($xml, 'Zimbra\Admin\Struct\TzReplaceInfo', 'xml');
        $wellKnownTz = $replace->getWellKnownTz();
        $tz = $replace->getCalTz();
        $standard = $tz->getStandardTzOnset();
        $daylight = $tz->getDaylightTzOnset();

        $this->assertSame($id, $wellKnownTz->getId());
        $this->assertSame($id, $tz->getId());
        $this->assertSame($stdoff, $tz->getTzStdOffset());
        $this->assertSame($dayoff, $tz->getTzDayOffset());
        $this->assertSame($stdname, $tz->getStandardTZName());
        $this->assertSame($dayname, $tz->getDaylightTZName());

        $this->assertSame($mon, $standard->getMonth());
        $this->assertSame($hour, $standard->getHour());
        $this->assertSame($min, $standard->getMinute());
        $this->assertSame($sec, $standard->getSecond());

        $this->assertSame($mon, $daylight->getMonth());
        $this->assertSame($hour, $daylight->getHour());
        $this->assertSame($min, $daylight->getMinute());
        $this->assertSame($sec, $daylight->getSecond());
    }
}
