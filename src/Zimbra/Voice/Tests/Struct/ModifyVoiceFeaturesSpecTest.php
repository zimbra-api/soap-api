<?php

namespace Zimbra\Struct\Tests;

use Zimbra\Voice\Struct\ModifyVoiceFeaturesSpec;
use Zimbra\Voice\Struct\PrefInfo;
use Zimbra\Voice\Struct\CallerListEntry;
use Zimbra\Voice\Struct\VoiceMailPrefsFeature;
use Zimbra\Voice\Struct\AnonCallRejectionFeature;
use Zimbra\Voice\Struct\CallerIdBlockingFeature;
use Zimbra\Voice\Struct\CallForwardFeature;
use Zimbra\Voice\Struct\CallForwardBusyLineFeature;
use Zimbra\Voice\Struct\CallForwardNoAnswerFeature;
use Zimbra\Voice\Struct\CallWaitingFeature;
use Zimbra\Voice\Struct\SelectiveCallForwardFeature;
use Zimbra\Voice\Struct\SelectiveCallAcceptanceFeature;
use Zimbra\Voice\Struct\SelectiveCallRejectionFeature;

/**
 * Testcase class for ModifyVoiceFeaturesSpec.
 */
class ModifyVoiceFeaturesSpecTest extends ZimbraStructTestCase
{
    public function testModifyVoiceFeaturesSpec()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $pn = $this->faker->word;
        $ft = $this->faker->word;
        $nr = $this->faker->word;

        $pref = new PrefInfo($name, $value);
        $entry = new CallerListEntry($pn, true);

        $voicemailprefs = new VoiceMailPrefsFeature(
            true, false, [$pref]
        );
        $anoncallrejection = new AnonCallRejectionFeature(
            true, false
        );
        $calleridblocking = new CallerIdBlockingFeature(
            true, false
        );
        $callforward = new CallForwardFeature(
            true, false, $ft
        );
        $callforwardbusyline = new CallForwardBusyLineFeature(
            true, false, $ft
        );
        $callforwardnoanswer = new CallForwardNoAnswerFeature(
            true, false, $ft, $nr
        );
        $callwaiting = new CallWaitingFeature(
            true, false
        );
        $selectivecallforward = new SelectiveCallForwardFeature(
            true, false, [$entry], $ft
        );
        $selectivecallacceptance = new SelectiveCallAcceptanceFeature(
            true, false, [$entry]
        );
        $selectivecallrejection = new SelectiveCallRejectionFeature(
            true, false, [$entry]
        );

        $callFeatures = [
            $voicemailprefs,
            $anoncallrejection,
            $calleridblocking,
            $callforward,
            $callforwardbusyline,
            $callforwardnoanswer,
            $callwaiting,
            $selectivecallforward,
            $selectivecallacceptance,
            $selectivecallrejection,
        ];
        $spec = new ModifyVoiceFeaturesSpec($name, $callFeatures);
        $this->assertSame($name, $spec->getName());
        $this->assertSame($callFeatures, $spec->getCallFeatures()->all());

        $spec = new ModifyVoiceFeaturesSpec($name);
        $spec->setName($name)
              ->addCallFeature($voicemailprefs)
              ->addCallFeature($anoncallrejection)
              ->addCallFeature($calleridblocking)
              ->addCallFeature($callforward)
              ->addCallFeature($callforwardbusyline)
              ->addCallFeature($callforwardnoanswer)
              ->addCallFeature($callwaiting)
              ->addCallFeature($selectivecallforward)
              ->addCallFeature($selectivecallacceptance)
              ->addCallFeature($selectivecallrejection);
        $this->assertSame($name, $spec->getName());
        $this->assertSame($callFeatures, $spec->getCallFeatures()->all());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<phone name="' . $name . '">'
                .'<voicemailprefs s="true" a="false">'
                    .'<pref name="' . $name . '">' . $value . '</pref>'
                .'</voicemailprefs>'
                .'<anoncallrejection s="true" a="false" />'
                .'<calleridblocking s="true" a="false" />'
                .'<callforward s="true" a="false" ft="' . $ft . '" />'
                .'<callforwardbusyline s="true" a="false" ft="' . $ft . '" />'
                .'<callforwardnoanswer s="true" a="false" ft="' . $ft . '" nr="' . $nr . '" />'
                .'<callwaiting s="true" a="false" />'
                .'<selectivecallforward s="true" a="false" ft="' . $ft . '">'
                    .'<phone pn="' . $pn . '" a="true" />'
                .'</selectivecallforward>'
                .'<selectivecallacceptance s="true" a="false">'
                    .'<phone pn="' . $pn . '" a="true" />'
                .'</selectivecallacceptance>'
                .'<selectivecallrejection s="true" a="false">'
                    .'<phone pn="' . $pn . '" a="true" />'
                .'</selectivecallrejection>'
            .'</phone>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $spec);

        $array = [
            'phone' => [
                'name' => $name,
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
                'anoncallrejection' => [
                    's' => true,
                    'a' => false,
                ],
                'calleridblocking' => [
                    's' => true,
                    'a' => false,
                ],
                'callforward' => [
                    's' => true,
                    'a' => false,
                    'ft' => $ft,
                ],
                'callforwardbusyline' => [
                    's' => true,
                    'a' => false,
                    'ft' => $ft,
                ],
                'callforwardnoanswer' => [
                    's' => true,
                    'a' => false,
                    'ft' => $ft,
                    'nr' => $nr,
                ],
                'callwaiting' => [
                    's' => true,
                    'a' => false,
                ],
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
                'selectivecallacceptance' => [
                    's' => true,
                    'a' => false,
                    'phone' => [
                        [
                            'pn' => $pn,
                            'a' => true,
                        ],
                    ],
                ],
                'selectivecallrejection' => [
                    's' => true,
                    'a' => false,
                    'phone' => [
                        [
                            'pn' => $pn,
                            'a' => true,
                        ],
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $spec->toArray());
    }
}
