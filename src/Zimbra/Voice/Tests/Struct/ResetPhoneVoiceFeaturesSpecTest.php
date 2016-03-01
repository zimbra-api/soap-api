<?php

namespace Zimbra\Struct\Tests;

use Zimbra\Voice\Struct\ResetPhoneVoiceFeaturesSpec;
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
 * Testcase class for ResetPhoneVoiceFeaturesSpec.
 */
class ResetPhoneVoiceFeaturesSpecTest extends ZimbraStructTestCase
{
    public function testResetPhoneVoiceFeaturesSpec()
    {
        $name = $this->faker->word;
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
        $phone = new ResetPhoneVoiceFeaturesSpec($name, $callFeatures);
        $this->assertSame($name, $phone->getName());
        $this->assertSame($callFeatures, $phone->getCallFeatures()->all());

        $phone = new ResetPhoneVoiceFeaturesSpec($name);
        $phone->setName($name)
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
