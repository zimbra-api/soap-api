<?php

namespace Zimbra\Struct\Tests;

use Zimbra\Voice\Struct\PrefInfo;
use Zimbra\Voice\Struct\VoiceMailPrefsFeature;

/**
 * Testcase class for VoiceMailPrefsFeature.
 */
class VoiceMailPrefsFeatureTest extends ZimbraStructTestCase
{
    public function testVoiceMailPrefsFeature()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $pref = new PrefInfo($name, $value);
        $voicemailprefs = new VoiceMailPrefsFeature(
            true, false, [$pref]
        );
        $this->assertInstanceOf('\Zimbra\Voice\Struct\CallFeatureInfo', $voicemailprefs);
        $this->assertSame([$pref], $voicemailprefs->getPrefs()->all());
        $voicemailprefs->addPref($pref);
        $this->assertSame([$pref, $pref], $voicemailprefs->getPrefs()->all());
        $voicemailprefs->getPrefs()->remove(1);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<voicemailprefs s="true" a="false">'
                .'<pref name="' . $name . '">' . $value . '</pref>'
            .'</voicemailprefs>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $voicemailprefs);

        $array = [
            'voicemailprefs' => [
                's' => true,
                'a' => false,
                'pref' => [
                    [
                        'name' => $name,
                        '_content' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $voicemailprefs->toArray());
    }
}
