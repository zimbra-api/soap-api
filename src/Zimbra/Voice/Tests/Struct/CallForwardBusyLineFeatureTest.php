<?php

namespace Zimbra\Struct\Tests;

use Zimbra\Voice\Struct\CallForwardBusyLineFeature;

/**
 * Testcase class for CallForwardBusyLineFeature.
 */
class CallForwardBusyLineFeatureTest extends ZimbraStructTestCase
{
    public function testCallForwardBusyLineFeature()
    {
        $ft = $this->faker->word;
        $callforwardbusyline = new CallForwardBusyLineFeature(true, false, $ft);
        $this->assertInstanceOf('\Zimbra\Voice\Struct\CallFeatureInfo', $callforwardbusyline);
        $this->assertSame($ft, $callforwardbusyline->getForwardTo());
        $callforwardbusyline->setForwardTo($ft);
        $this->assertSame($ft, $callforwardbusyline->getForwardTo());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<callforwardbusyline s="true" a="false" ft="' . $ft . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $callforwardbusyline);

        $array = [
            'callforwardbusyline' => [
                's' => true,
                'a' => false,
                'ft' => $ft,
            ],
        ];
        $this->assertEquals($array, $callforwardbusyline->toArray());
    }
}
