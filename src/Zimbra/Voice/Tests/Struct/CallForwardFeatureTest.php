<?php

namespace Zimbra\Struct\Tests;

use Zimbra\Voice\Struct\CallForwardFeature;

/**
 * Testcase class for CallForwardFeature.
 */
class CallForwardFeatureTest extends ZimbraStructTestCase
{
    public function testCallForwardFeature()
    {
        $ft = $this->faker->word;
        $callforward = new CallForwardFeature(true, false, $ft);
        $this->assertInstanceOf('\Zimbra\Voice\Struct\CallFeatureInfo', $callforward);
        $this->assertSame($ft, $callforward->getForwardTo());
        $callforward->setForwardTo($ft);
        $this->assertSame($ft, $callforward->getForwardTo());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<callforward s="true" a="false" ft="' . $ft . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $callforward);

        $array = [
            'callforward' => [
                's' => true,
                'a' => false,
                'ft' => $ft,
            ],
        ];
        $this->assertEquals($array, $callforward->toArray());
    }
}
