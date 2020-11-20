<?php declare(strict_types=1);

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
        $this->assertEquals($replace, $this->serializer->deserialize($xml, TzReplaceInfo::class, 'xml'));

        $json = json_encode([
            'wellKnownTz' => [
                'id' => $id,
            ],
            'tz' => [
                'id' => $id,
                'stdoff' => $stdoff,
                'dayoff' => $dayoff,
                'standard' => [
                    'mon' => $mon,
                    'hour' => $hour,
                    'min' => $min,
                    'sec' => $sec,
                ],
                'daylight' => [
                    'mon' => $mon,
                    'hour' => $hour,
                    'min' => $min,
                    'sec' => $sec,
                ],
                'stdname' => $stdname,
                'dayname' => $dayname,
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($replace, 'json'));
        $this->assertEquals($replace, $this->serializer->deserialize($json, TzReplaceInfo::class, 'json'));
    }
}
