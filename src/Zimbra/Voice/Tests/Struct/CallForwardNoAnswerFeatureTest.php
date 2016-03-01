<?php

namespace Zimbra\Struct\Tests;

use Zimbra\Voice\Struct\CallForwardNoAnswerFeature;

/**
 * Testcase class for CallForwardNoAnswerFeature.
 */
class CallForwardNoAnswerFeatureTest extends ZimbraStructTestCase
{
    public function testCallForwardNoAnswerFeature()
    {
        $ft = $this->faker->word;
        $nr = $this->faker->word;

        $callforwardnoanswer = new CallForwardNoAnswerFeature(true, false, $ft, $nr);
        $this->assertInstanceOf('\Zimbra\Voice\Struct\CallFeatureInfo', $callforwardnoanswer);
        $this->assertSame($ft, $callforwardnoanswer->getForwardTo());
        $this->assertSame($nr, $callforwardnoanswer->getNumRingCycles());
        $callforwardnoanswer->setForwardTo($ft)
            ->setNumRingCycles($nr);
        $this->assertSame($ft, $callforwardnoanswer->getForwardTo());
        $this->assertSame($nr, $callforwardnoanswer->getNumRingCycles());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<callforwardnoanswer s="true" a="false" ft="' . $ft . '" nr="' . $nr . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $callforwardnoanswer);

        $array = [
            'callforwardnoanswer' => [
                's' => true,
                'a' => false,
                'ft' => $ft,
                'nr' => $nr,
            ],
        ];
        $this->assertEquals($array, $callforwardnoanswer->toArray());
    }
}
