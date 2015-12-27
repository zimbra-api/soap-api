<?php

namespace Zimbra\Struct\Tests;

use Zimbra\Voice\Struct\CallerListEntry;
use Zimbra\Voice\Struct\SelectiveCallForwardFeature;

/**
 * Testcase class for SelectiveCallForwardFeature.
 */
class SelectiveCallForwardFeatureTest extends ZimbraStructTestCase
{
    public function testSelectiveCallForwardFeature()
    {
        $pn = $this->faker->word;
        $ft = $this->faker->word;
        $phone = new CallerListEntry($pn, true);
        $selectivecallforward = new SelectiveCallForwardFeature(
            true, false, [$phone], $ft
        );
        $this->assertSame($ft, $selectivecallforward->getForwardTo());
        $selectivecallforward->setForwardTo($ft);
        $this->assertSame($ft, $selectivecallforward->getForwardTo());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<selectivecallforward s="true" a="false" ft="' . $ft . '">'
                .'<phone pn="' . $pn . '" a="true" />'
            .'</selectivecallforward>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $selectivecallforward);

        $array = [
            'selectivecallforward' => [
                's' => true,
                'a' => false,
                'ft' => $ft,
                'phone' => [
                    [
                        'pn' => $pn,
                        'a' => true,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $selectivecallforward->toArray());
    }
}
