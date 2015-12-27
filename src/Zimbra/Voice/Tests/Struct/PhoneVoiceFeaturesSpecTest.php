<?php

namespace Zimbra\Struct\Tests;

use Zimbra\Voice\Struct\PhoneVoiceFeaturesSpec;
use Zimbra\Voice\Struct\VoiceMailPrefName;
use Zimbra\Voice\Struct\VoiceMailPrefsReq;
use Zimbra\Voice\Struct\AnonCallRejectionReq;
use Zimbra\Voice\Struct\CallerIdBlockingReq;
use Zimbra\Voice\Struct\CallForwardReq;
use Zimbra\Voice\Struct\CallForwardBusyLineReq;
use Zimbra\Voice\Struct\CallForwardNoAnswerReq;
use Zimbra\Voice\Struct\CallWaitingReq;
use Zimbra\Voice\Struct\SelectiveCallForwardReq;
use Zimbra\Voice\Struct\SelectiveCallAcceptanceReq;
use Zimbra\Voice\Struct\SelectiveCallRejectionReq;

/**
 * Testcase class for PhoneVoiceFeaturesSpec.
 */
class PhoneVoiceFeaturesSpecTest extends ZimbraStructTestCase
{
    public function testPhoneVoiceFeaturesSpec()
    {
        $name = $this->faker->word;
        $pref = new VoiceMailPrefName($name);
        $voicemailprefs = new VoiceMailPrefsReq(
            [$pref]
        );
        $anoncallrejection = new AnonCallRejectionReq();
        $calleridblocking = new CallerIdBlockingReq();
        $callforward = new CallForwardReq();
        $callforwardbusyline = new CallForwardBusyLineReq();
        $callforwardnoanswer = new CallForwardNoAnswerReq();
        $callwaiting = new CallWaitingReq();
        $selectivecallforward = new SelectiveCallForwardReq();
        $selectivecallacceptance = new SelectiveCallAcceptanceReq();
        $selectivecallrejection = new SelectiveCallRejectionReq();

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
            $selectivecallrejection
        ];
        $phone = new PhoneVoiceFeaturesSpec($name, $callFeatures);
        $this->assertSame($name, $phone->getName());
        $this->assertSame($callFeatures, $phone->getCallFeatures()->all());

        $phone = new PhoneVoiceFeaturesSpec($name);
        $phone->setName($name)
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
        $this->assertSame($name, $phone->getName());
        $this->assertSame($callFeatures, $phone->getCallFeatures()->all());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<phone name="' . $name . '">'
                .'<voicemailprefs>'
                    .'<pref name="' . $name . '" />'
                .'</voicemailprefs>'
                .'<anoncallrejection />'
                .'<calleridblocking />'
                .'<callforward />'
                .'<callforwardbusyline />'
                .'<callforwardnoanswer />'
                .'<callwaiting />'
                .'<selectivecallforward />'
                .'<selectivecallacceptance />'
                .'<selectivecallrejection />'
            .'</phone>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $phone);

        $array = [
            'phone' => [
                'name' => $name,
                'voicemailprefs' => [
                    'pref' => [
                        [
                            'name' => $name,
                        ],
                    ],
                ],
                'anoncallrejection' => [],
                'calleridblocking' => [],
                'callforward' => [],
                'callforwardbusyline' => [],
                'callforwardnoanswer' => [],
                'callwaiting' => [],
                'selectivecallforward' => [],
                'selectivecallacceptance' => [],
                'selectivecallrejection' => [],
            ],
        ];
        $this->assertEquals($array, $phone->toArray());
    }
}
