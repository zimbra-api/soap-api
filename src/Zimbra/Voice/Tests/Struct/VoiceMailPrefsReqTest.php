<?php

namespace Zimbra\Struct\Tests;

use Zimbra\Voice\Struct\VoiceMailPrefName;
use Zimbra\Voice\Struct\VoiceMailPrefsReq;

/**
 * Testcase class for VoiceMailPrefsReq.
 */
class VoiceMailPrefsReqTest extends ZimbraStructTestCase
{
    public function testVoiceMailPrefsReq()
    {
        $name = $this->faker->word;
        $pref = new VoiceMailPrefName($name);
        $voicemailprefs = new VoiceMailPrefsReq([$pref]);
        $this->assertInstanceOf('\Zimbra\Voice\Struct\CallFeatureReq', $voicemailprefs);

        $this->assertSame([$pref], $voicemailprefs->getPrefs()->all());
        $voicemailprefs->addPref($pref);
        $this->assertSame([$pref, $pref], $voicemailprefs->getPrefs()->all());
        $voicemailprefs->getPrefs()->remove(1);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<voicemailprefs>'
                .'<pref name="' . $name . '" />'
            .'</voicemailprefs>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $voicemailprefs);

        $array = [
            'voicemailprefs' => [
                'pref' => [
                    [
                        'name' => $name,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $voicemailprefs->toArray());
    }
}
