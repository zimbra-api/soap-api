<?php

namespace Zimbra\Voice\Tests\Request;

use Zimbra\Voice\Tests\ZimbraVoiceApiTestCase;
use Zimbra\Voice\Request\ModifyVoiceFeatures;

use Zimbra\Voice\Struct\StorePrincipalSpec;
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
 * Testcase class for ModifyVoiceFeatures.
 */
class ModifyVoiceFeaturesTest extends ZimbraVoiceApiTestCase
{
    public function testModifyVoiceFeaturesRequest()
    {
        $id = $this->faker->word;
        $name = $this->faker->word;
        $accountNumber = $this->faker->word;
        $storeprincipal = new StorePrincipalSpec(
            $id, $name, $accountNumber
        );

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
        $phone = new ModifyVoiceFeaturesSpec(
            $name, $callFeatures
        );

        $req = new ModifyVoiceFeatures(
            $storeprincipal, $phone
        );
        $this->assertInstanceOf('Zimbra\Voice\Request\Base', $req);
        $this->assertSame($storeprincipal, $req->getStorePrincipal());
        $this->assertSame($phone, $req->getPhone());
        $req->setStorePrincipal($storeprincipal)
            ->setPhone($phone);
        $this->assertSame($storeprincipal, $req->getStorePrincipal());
        $this->assertSame($phone, $req->getPhone());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ModifyVoiceFeaturesRequest>'
                .'<storeprincipal id="' . $id . '" name="' . $name . '" accountNumber="' . $accountNumber . '" />'
                .'<phone name="' . $name . '">'
                    .'<voicemailprefs s="true" a="false">'
                        .'<pref name="' . $name . '">' . $value  .'</pref>'
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
                .'</phone>'
            .'</ModifyVoiceFeaturesRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ModifyVoiceFeaturesRequest' => [
                '_jsns' => 'urn:zimbraVoice',
                'storeprincipal' => [
                    'id' => $id,
                    'name' => $name,
                    'accountNumber' => $accountNumber,
                ],
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
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyVoiceFeaturesApi()
    {
        $id = $this->faker->word;
        $name = $this->faker->word;
        $accountNumber = $this->faker->word;
        $storeprincipal = new StorePrincipalSpec(
            $id, $name, $accountNumber
        );

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
        $phone = new ModifyVoiceFeaturesSpec(
            $name, $callFeatures
        );

        $this->api->modifyVoiceFeatures($storeprincipal, $phone);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraVoice">'
                .'<env:Body>'
                    .'<urn1:ModifyVoiceFeaturesRequest>'
                        .'<urn1:storeprincipal id="' . $id . '" name="' . $name . '" accountNumber="' . $accountNumber . '" />'
                        .'<urn1:phone name="' . $name . '">'
                            .'<urn1:voicemailprefs s="true" a="false">'
                                .'<urn1:pref name="' . $name . '">' . $value . '</urn1:pref>'
                            .'</urn1:voicemailprefs>'
                            .'<urn1:anoncallrejection s="true" a="false" />'
                            .'<urn1:calleridblocking s="true" a="false" />'
                            .'<urn1:callforward s="true" a="false" ft="' . $ft . '" />'
                            .'<urn1:callforwardbusyline s="true" a="false" ft="' . $ft . '" />'
                            .'<urn1:callforwardnoanswer s="true" a="false" ft="' . $ft . '" nr="' . $nr . '" />'
                            .'<urn1:callwaiting s="true" a="false" />'
                            .'<urn1:selectivecallforward s="true" a="false" ft="' . $ft . '">'
                                .'<urn1:phone pn="' . $pn . '" a="true" />'
                            .'</urn1:selectivecallforward>'
                            .'<urn1:selectivecallacceptance s="true" a="false">'
                                .'<urn1:phone pn="' . $pn . '" a="true" />'
                            .'</urn1:selectivecallacceptance>'
                            .'<urn1:selectivecallrejection s="true" a="false">'
                                .'<urn1:phone pn="' . $pn . '" a="true" />'
                            .'</urn1:selectivecallrejection>'
                        .'</urn1:phone>'
                    .'</urn1:ModifyVoiceFeaturesRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
