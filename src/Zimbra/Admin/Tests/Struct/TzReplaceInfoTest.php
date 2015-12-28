<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\CalTZInfo;
use Zimbra\Admin\Struct\TzReplaceInfo;
use Zimbra\Struct\TzOnsetInfo;
use Zimbra\Struct\Id;

/**
 * Testcase class for TzReplaceInfo.
 */
class TzReplaceInfoTest extends ZimbraAdminTestCase
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
        $this->assertSame($tz, $replace->getTz());

        $replace->setWellKnownTz($wellKnownTz)
                ->setTz($tz);
        $this->assertSame($wellKnownTz, $replace->getWellKnownTz());
        $this->assertSame($tz, $replace->getTz());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<replace>'
                . '<wellKnownTz id="' . $id . '" />'
                . '<tz id="' . $id . '" stdoff="' . $stdoff . '" dayoff="' . $dayoff . '" stdname="' . $stdname . '" dayname="' . $dayname . '">'
                    . '<standard mon="' . $mon . '" hour="' . $hour . '" min="' . $min . '" sec="' . $sec . '" />'
                    . '<daylight mon="' . $mon . '" hour="' . $hour . '" min="' . $min . '" sec="' . $sec . '" />'
                . '</tz>'
            . '</replace>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $replace);

        $array = [
            'replace' => [
                'wellKnownTz' => [
                    'id' => $id,
                ],
                'tz' => [
                    'id' => $id,
                    'stdoff' => $stdoff,
                    'dayoff' => $dayoff,
                    'stdname' => $stdname,
                    'dayname' => $dayname,
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
                ],
            ],
        ];
        $this->assertEquals($array, $replace->toArray());
    }
}
