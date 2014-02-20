<?php

namespace Zimbra\Tests\Voice;

use Zimbra\Tests\ZimbraTestCase;

use Zimbra\Enum\VoiceMsgActionOp;

/**
 * Testcase class for soap struct.
 */
class StructTest extends ZimbraTestCase
{
    public function testAnonCallRejectionFeature()
    {
        $anoncallrejection = new \Zimbra\Voice\Struct\AnonCallRejectionFeature(
            true, false
        );
        $this->assertInstanceOf('\Zimbra\Voice\Struct\CallFeatureInfo', $anoncallrejection);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<anoncallrejection s="true" a="false" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $anoncallrejection);

        $array = array(
            'anoncallrejection' => array(
                's' => true,
                'a' => false,
            ),
        );
        $this->assertEquals($array, $anoncallrejection->toArray());
    }

    public function testAnonCallRejectionReq()
    {
        $anoncallrejection = new \Zimbra\Voice\Struct\AnonCallRejectionReq();

        $xml = '<?xml version="1.0"?>'."\n"
            .'<anoncallrejection />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $anoncallrejection);

        $array = array(
            'anoncallrejection' => array(),
        );
        $this->assertEquals($array, $anoncallrejection->toArray());
    }

    public function testCallerIdBlockingFeature()
    {
        $calleridblocking = new \Zimbra\Voice\Struct\CallerIdBlockingFeature(
            true, false
        );
        $this->assertInstanceOf('\Zimbra\Voice\Struct\CallFeatureInfo', $calleridblocking);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<calleridblocking s="true" a="false" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $calleridblocking);

        $array = array(
            'calleridblocking' => array(
                's' => true,
                'a' => false,
            ),
        );
        $this->assertEquals($array, $calleridblocking->toArray());
    }

    public function testCallerIdBlockingReq()
    {
        $calleridblocking = new \Zimbra\Voice\Struct\CallerIdBlockingReq();

        $xml = '<?xml version="1.0"?>'."\n"
            .'<calleridblocking />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $calleridblocking);

        $array = array(
            'calleridblocking' => array(),
        );
        $this->assertEquals($array, $calleridblocking->toArray());
    }

    public function testCallerListEntry()
    {
        $phone = new \Zimbra\Voice\Struct\CallerListEntry('pn', true);
        $this->assertSame('pn', $phone->pn());
        $this->assertTrue($phone->a());
        $phone->pn('pn')
              ->a(true);
        $this->assertSame('pn', $phone->pn());
        $this->assertTrue($phone->a());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<phone pn="pn" a="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $phone);

        $array = array(
            'phone' => array(
                'pn' => 'pn',
                'a' => true,
            ),
        );
        $this->assertEquals($array, $phone->toArray());
    }

    public function testCallFeatureInfo()
    {
        $base = $this->getMockForAbstractClass('Zimbra\Voice\Struct\CallFeatureInfo', array(true, false));
        $this->assertTrue($base->s());
        $this->assertFalse($base->a());
        $base->s(true);
        $base->a(false);
        $this->assertTrue($base->s());
        $this->assertFalse($base->a());
    }

    public function testCallForwardBusyLineFeature()
    {
        $callforwardbusyline = new \Zimbra\Voice\Struct\CallForwardBusyLineFeature(
            true, false, 'ft'
        );
        $this->assertInstanceOf('\Zimbra\Voice\Struct\CallFeatureInfo', $callforwardbusyline);
        $this->assertSame('ft', $callforwardbusyline->ft());
        $callforwardbusyline->ft('ft');
        $this->assertSame('ft', $callforwardbusyline->ft());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<callforwardbusyline s="true" a="false" ft="ft" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $callforwardbusyline);

        $array = array(
            'callforwardbusyline' => array(
                's' => true,
                'a' => false,
                'ft' => 'ft',
            ),
        );
        $this->assertEquals($array, $callforwardbusyline->toArray());
    }

    public function testCallForwardBusyLineReq()
    {
        $callforwardbusyline = new \Zimbra\Voice\Struct\CallForwardBusyLineReq();

        $xml = '<?xml version="1.0"?>'."\n"
            .'<callforwardbusyline />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $callforwardbusyline);

        $array = array(
            'callforwardbusyline' => array(),
        );
        $this->assertEquals($array, $callforwardbusyline->toArray());
    }

    public function testCallForwardFeature()
    {
        $callforward = new \Zimbra\Voice\Struct\CallForwardFeature(
            true, false, 'ft'
        );
        $this->assertInstanceOf('\Zimbra\Voice\Struct\CallFeatureInfo', $callforward);
        $this->assertSame('ft', $callforward->ft());
        $callforward->ft('ft');
        $this->assertSame('ft', $callforward->ft());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<callforward s="true" a="false" ft="ft" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $callforward);

        $array = array(
            'callforward' => array(
                's' => true,
                'a' => false,
                'ft' => 'ft',
            ),
        );
        $this->assertEquals($array, $callforward->toArray());
    }

    public function testCallForwardNoAnswerFeature()
    {
        $callforwardnoanswer = new \Zimbra\Voice\Struct\CallForwardNoAnswerFeature(
            true, false, 'ft', 'nr'
        );
        $this->assertInstanceOf('\Zimbra\Voice\Struct\CallFeatureInfo', $callforwardnoanswer);
        $this->assertSame('ft', $callforwardnoanswer->ft());
        $this->assertSame('nr', $callforwardnoanswer->nr());
        $callforwardnoanswer->ft('ft')
                    ->nr('nr');
        $this->assertSame('ft', $callforwardnoanswer->ft());
        $this->assertSame('nr', $callforwardnoanswer->nr());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<callforwardnoanswer s="true" a="false" ft="ft" nr="nr" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $callforwardnoanswer);

        $array = array(
            'callforwardnoanswer' => array(
                's' => true,
                'a' => false,
                'ft' => 'ft',
                'nr' => 'nr',
            ),
        );
        $this->assertEquals($array, $callforwardnoanswer->toArray());
    }

    public function testCallForwardNoAnswerReq()
    {
        $callforwardnoanswer = new \Zimbra\Voice\Struct\CallForwardNoAnswerReq();

        $xml = '<?xml version="1.0"?>'."\n"
            .'<callforwardnoanswer />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $callforwardnoanswer);

        $array = array(
            'callforwardnoanswer' => array(),
        );
        $this->assertEquals($array, $callforwardnoanswer->toArray());
    }

    public function testCallForwardReq()
    {
        $callforward = new \Zimbra\Voice\Struct\CallForwardReq();

        $xml = '<?xml version="1.0"?>'."\n"
            .'<callforward />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $callforward);

        $array = array(
            'callforward' => array(),
        );
        $this->assertEquals($array, $callforward->toArray());
    }

    public function testCallWaitingFeature()
    {
        $callwaiting = new \Zimbra\Voice\Struct\CallWaitingFeature(
            true, false
        );
        $this->assertInstanceOf('\Zimbra\Voice\Struct\CallFeatureInfo', $callwaiting);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<callwaiting s="true" a="false" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $callwaiting);

        $array = array(
            'callwaiting' => array(
                's' => true,
                'a' => false,
            ),
        );
        $this->assertEquals($array, $callwaiting->toArray());
    }

    public function testCallWaitingReq()
    {
        $callwaiting = new \Zimbra\Voice\Struct\CallWaitingReq();

        $xml = '<?xml version="1.0"?>'."\n"
            .'<callwaiting />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $callwaiting);

        $array = array(
            'callwaiting' => array(),
        );
        $this->assertEquals($array, $callwaiting->toArray());
    }

    public function testFeatureWithCallerList()
    {
        $phone = new \Zimbra\Voice\Struct\CallerListEntry('pn', true);
        $featureWithCallerList = new \Zimbra\Voice\Struct\FeatureWithCallerList(
            true, false, array($phone)
        );
        $this->assertInstanceOf('\Zimbra\Voice\Struct\CallFeatureInfo', $featureWithCallerList);
        $this->assertSame(array($phone), $featureWithCallerList->phone()->all());
        $featureWithCallerList->addPhone($phone);
        $this->assertSame(array($phone, $phone), $featureWithCallerList->phone()->all());
    }

    public function testModifyFromNumSpec()
    {
        $phone = new \Zimbra\Voice\Struct\ModifyFromNumSpec(
            'oldPhone', 'phone', 'id', 'label'
        );
        $this->assertSame('oldPhone', $phone->oldPhone());
        $this->assertSame('phone', $phone->phone());
        $this->assertSame('id', $phone->id());
        $this->assertSame('label', $phone->label());
        $phone->oldPhone('oldPhone')
              ->phone('phone')
              ->id('id')
              ->label('label');
        $this->assertSame('oldPhone', $phone->oldPhone());
        $this->assertSame('phone', $phone->phone());
        $this->assertSame('id', $phone->id());
        $this->assertSame('label', $phone->label());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<phone oldPhone="oldPhone" phone="phone" id="id" label="label" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $phone);

        $array = array(
            'phone' => array(
                'oldPhone' => 'oldPhone',
                'phone' => 'phone',
                'id' => 'id',
                'label' => 'label',
            ),
        );
        $this->assertEquals($array, $phone->toArray());
    }

    function testModifyVoiceFeaturesSpec()
    {
        $pref = new \Zimbra\Voice\Struct\PrefInfo('name', 'value');
        $phone = new \Zimbra\Voice\Struct\CallerListEntry('pn', true);

        $voicemailprefs = new \Zimbra\Voice\Struct\VoiceMailPrefsFeature(
            true, false, array($pref)
        );
        $anoncallrejection = new \Zimbra\Voice\Struct\AnonCallRejectionFeature(
            true, false
        );
        $calleridblocking = new \Zimbra\Voice\Struct\CallerIdBlockingFeature(
            true, false
        );
        $callforward = new \Zimbra\Voice\Struct\CallForwardFeature(
            true, false, 'ft'
        );
        $callforwardbusyline = new \Zimbra\Voice\Struct\CallForwardBusyLineFeature(
            true, false, 'ft'
        );
        $callforwardnoanswer = new \Zimbra\Voice\Struct\CallForwardNoAnswerFeature(
            true, false, 'ft', 'nr'
        );
        $callwaiting = new \Zimbra\Voice\Struct\CallWaitingFeature(
            true, false
        );
        $selectivecallforward = new \Zimbra\Voice\Struct\SelectiveCallForwardFeature(
            true, false, array($phone), 'ft'
        );
        $selectivecallacceptance = new \Zimbra\Voice\Struct\SelectiveCallAcceptanceFeature(
            true, false, array($phone)
        );
        $selectivecallrejection = new \Zimbra\Voice\Struct\SelectiveCallRejectionFeature(
            true, false, array($phone)
        );

        $phone = new \Zimbra\Voice\Struct\ModifyVoiceFeaturesSpec(
            'name',
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
        );
        $this->assertSame('name', $phone->name());
        $this->assertSame($voicemailprefs, $phone->voicemailprefs());
        $this->assertSame($anoncallrejection, $phone->anoncallrejection());
        $this->assertSame($calleridblocking, $phone->calleridblocking());
        $this->assertSame($callforward, $phone->callforward());
        $this->assertSame($callforwardbusyline, $phone->callforwardbusyline());
        $this->assertSame($callforwardnoanswer, $phone->callforwardnoanswer());
        $this->assertSame($callwaiting, $phone->callwaiting());
        $this->assertSame($selectivecallforward, $phone->selectivecallforward());
        $this->assertSame($selectivecallacceptance, $phone->selectivecallacceptance());
        $this->assertSame($selectivecallrejection, $phone->selectivecallrejection());

        $phone->name('name')
              ->voicemailprefs($voicemailprefs)
              ->anoncallrejection($anoncallrejection)
              ->calleridblocking($calleridblocking)
              ->callforward($callforward)
              ->callforwardbusyline($callforwardbusyline)
              ->callforwardnoanswer($callforwardnoanswer)
              ->callwaiting($callwaiting)
              ->selectivecallforward($selectivecallforward)
              ->selectivecallacceptance($selectivecallacceptance)
              ->selectivecallrejection($selectivecallrejection);
        $this->assertSame('name', $phone->name());
        $this->assertSame($voicemailprefs, $phone->voicemailprefs());
        $this->assertSame($anoncallrejection, $phone->anoncallrejection());
        $this->assertSame($calleridblocking, $phone->calleridblocking());
        $this->assertSame($callforward, $phone->callforward());
        $this->assertSame($callforwardbusyline, $phone->callforwardbusyline());
        $this->assertSame($callforwardnoanswer, $phone->callforwardnoanswer());
        $this->assertSame($callwaiting, $phone->callwaiting());
        $this->assertSame($selectivecallforward, $phone->selectivecallforward());
        $this->assertSame($selectivecallacceptance, $phone->selectivecallacceptance());
        $this->assertSame($selectivecallrejection, $phone->selectivecallrejection());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<phone name="name">'
                .'<voicemailprefs s="true" a="false">'
                    .'<pref name="name">value</pref>'
                .'</voicemailprefs>'
                .'<anoncallrejection s="true" a="false" />'
                .'<calleridblocking s="true" a="false" />'
                .'<callforward s="true" a="false" ft="ft" />'
                .'<callforwardbusyline s="true" a="false" ft="ft" />'
                .'<callforwardnoanswer s="true" a="false" ft="ft" nr="nr" />'
                .'<callwaiting s="true" a="false" />'
                .'<selectivecallforward s="true" a="false" ft="ft">'
                    .'<phone pn="pn" a="true" />'
                .'</selectivecallforward>'
                .'<selectivecallacceptance s="true" a="false">'
                    .'<phone pn="pn" a="true" />'
                .'</selectivecallacceptance>'
                .'<selectivecallrejection s="true" a="false">'
                    .'<phone pn="pn" a="true" />'
                .'</selectivecallrejection>'
            .'</phone>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $phone);

        $array = array(
            'phone' => array(
                'name' => 'name',
                'voicemailprefs' => array(
                    's' => true,
                    'a' => false,
                    'pref' => array(
                        array(
                            'name' => 'name',
                            '_' => 'value',
                        ),
                    ),
                ),
                'anoncallrejection' => array(
                    's' => true,
                    'a' => false,
                ),
                'calleridblocking' => array(
                    's' => true,
                    'a' => false,
                ),
                'callforward' => array(
                    's' => true,
                    'a' => false,
                    'ft' => 'ft',
                ),
                'callforwardbusyline' => array(
                    's' => true,
                    'a' => false,
                    'ft' => 'ft',
                ),
                'callforwardnoanswer' => array(
                    's' => true,
                    'a' => false,
                    'ft' => 'ft',
                    'nr' => 'nr',
                ),
                'callwaiting' => array(
                    's' => true,
                    'a' => false,
                ),
                'selectivecallforward' => array(
                    's' => true,
                    'a' => false,
                    'ft' => 'ft',
                    'phone' => array(
                        array(
                            'pn' => 'pn',
                            'a' => true,
                        ),
                    ),
                ),
                'selectivecallacceptance' => array(
                    's' => true,
                    'a' => false,
                    'phone' => array(
                        array(
                            'pn' => 'pn',
                            'a' => true,
                        ),
                    ),
                ),
                'selectivecallrejection' => array(
                    's' => true,
                    'a' => false,
                    'phone' => array(
                        array(
                            'pn' => 'pn',
                            'a' => true,
                        ),
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $phone->toArray());
    }

    public function testModifyVoiceMailPinSpec()
    {
        $phone = new \Zimbra\Voice\Struct\ModifyVoiceMailPinSpec(
            'oldPin', 'pin', 'name'
        );
        $this->assertSame('oldPin', $phone->oldPin());
        $this->assertSame('pin', $phone->pin());
        $this->assertSame('name', $phone->name());
        $phone->oldPin('oldPin')
              ->pin('pin')
              ->name('name');
        $this->assertSame('oldPin', $phone->oldPin());
        $this->assertSame('pin', $phone->pin());
        $this->assertSame('name', $phone->name());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<phone oldPin="oldPin" pin="pin" name="name" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $phone);

        $array = array(
            'phone' => array(
                'oldPin' => 'oldPin',
                'pin' => 'pin',
                'name' => 'name',
            ),
        );
        $this->assertEquals($array, $phone->toArray());
    }

    public function testPhoneInfo()
    {
        $pref = new \Zimbra\Voice\Struct\PrefInfo('name', 'value');
        $phone = new \Zimbra\Voice\Struct\PhoneInfo('name', array($pref));
        $this->assertSame('name', $phone->name());
        $this->assertSame(array($pref), $phone->pref()->all());
        $phone->name('name')
              ->addPref($pref);
        $this->assertSame('name', $phone->name());
        $this->assertSame(array($pref, $pref), $phone->pref()->all());
        $phone->pref()->remove(1);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<phone name="name">'
                .'<pref name="name">value</pref>'
            .'</phone>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $phone);

        $array = array(
            'phone' => array(
                'name' => 'name',
                'pref' => array(
                    array(
                        'name' => 'name',
                        '_' => 'value',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $phone->toArray());
    }

    public function testPhoneSpec()
    {
        $pref = new \Zimbra\Voice\Struct\PrefSpec('name');
        $phone = new \Zimbra\Voice\Struct\PhoneSpec('name', array($pref));
        $this->assertSame('name', $phone->name());
        $this->assertSame(array($pref), $phone->pref()->all());
        $phone->name('name')
              ->addPref($pref);
        $this->assertSame('name', $phone->name());
        $this->assertSame(array($pref, $pref), $phone->pref()->all());
        $phone->pref()->remove(1);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<phone name="name">'
                .'<pref name="name" />'
            .'</phone>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $phone);

        $array = array(
            'phone' => array(
                'name' => 'name',
                'pref' => array(
                    array(
                        'name' => 'name',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $phone->toArray());
    }

    public function testPhoneVoiceFeaturesSpec()
    {
        $pref = new \Zimbra\Voice\Struct\VoiceMailPrefName('name');
        $voicemailprefs = new \Zimbra\Voice\Struct\VoiceMailPrefsReq(
            array($pref)
        );
        $anoncallrejection = new \Zimbra\Voice\Struct\AnonCallRejectionReq();
        $calleridblocking = new \Zimbra\Voice\Struct\CallerIdBlockingReq();
        $callforward = new \Zimbra\Voice\Struct\CallForwardReq();
        $callforwardbusyline = new \Zimbra\Voice\Struct\CallForwardBusyLineReq();
        $callforwardnoanswer = new \Zimbra\Voice\Struct\CallForwardNoAnswerReq();
        $callwaiting = new \Zimbra\Voice\Struct\CallWaitingReq();
        $selectivecallforward = new \Zimbra\Voice\Struct\SelectiveCallForwardReq();
        $selectivecallacceptance = new \Zimbra\Voice\Struct\SelectiveCallAcceptanceReq();
        $selectivecallrejection = new \Zimbra\Voice\Struct\SelectiveCallRejectionReq();

        $phone = new \Zimbra\Voice\Struct\PhoneVoiceFeaturesSpec(
            'name',
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
        );
        $this->assertSame('name', $phone->name());
        $this->assertSame($voicemailprefs, $phone->voicemailprefs());
        $this->assertSame($anoncallrejection, $phone->anoncallrejection());
        $this->assertSame($calleridblocking, $phone->calleridblocking());
        $this->assertSame($callforward, $phone->callforward());
        $this->assertSame($callforwardbusyline, $phone->callforwardbusyline());
        $this->assertSame($callforwardnoanswer, $phone->callforwardnoanswer());
        $this->assertSame($callwaiting, $phone->callwaiting());
        $this->assertSame($selectivecallforward, $phone->selectivecallforward());
        $this->assertSame($selectivecallacceptance, $phone->selectivecallacceptance());
        $this->assertSame($selectivecallrejection, $phone->selectivecallrejection());

        $phone->name('name')
              ->voicemailprefs($voicemailprefs)
              ->anoncallrejection($anoncallrejection)
              ->calleridblocking($calleridblocking)
              ->callforward($callforward)
              ->callforwardbusyline($callforwardbusyline)
              ->callforwardnoanswer($callforwardnoanswer)
              ->callwaiting($callwaiting)
              ->selectivecallforward($selectivecallforward)
              ->selectivecallacceptance($selectivecallacceptance)
              ->selectivecallrejection($selectivecallrejection);
        $this->assertSame('name', $phone->name());
        $this->assertSame($voicemailprefs, $phone->voicemailprefs());
        $this->assertSame($anoncallrejection, $phone->anoncallrejection());
        $this->assertSame($calleridblocking, $phone->calleridblocking());
        $this->assertSame($callforward, $phone->callforward());
        $this->assertSame($callforwardbusyline, $phone->callforwardbusyline());
        $this->assertSame($callforwardnoanswer, $phone->callforwardnoanswer());
        $this->assertSame($callwaiting, $phone->callwaiting());
        $this->assertSame($selectivecallforward, $phone->selectivecallforward());
        $this->assertSame($selectivecallacceptance, $phone->selectivecallacceptance());
        $this->assertSame($selectivecallrejection, $phone->selectivecallrejection());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<phone name="name">'
                .'<voicemailprefs>'
                    .'<pref name="name" />'
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

        $array = array(
            'phone' => array(
                'name' => 'name',
                'voicemailprefs' => array(
                    'pref' => array(
                        array(
                            'name' => 'name',
                        ),
                    ),
                ),
                'anoncallrejection' => array(),
                'calleridblocking' => array(),
                'callforward' => array(),
                'callforwardbusyline' => array(),
                'callforwardnoanswer' => array(),
                'callwaiting' => array(),
                'selectivecallforward' => array(),
                'selectivecallacceptance' => array(),
                'selectivecallrejection' => array(),
            ),
        );
        $this->assertEquals($array, $phone->toArray());
    }

    public function testPrefInfo()
    {
        $pref = new \Zimbra\Voice\Struct\PrefInfo('name', 'value');
        $this->assertSame('name', $pref->name());
        $this->assertSame('value', $pref->value());
        $pref->name('name')
             ->value('value');
        $this->assertSame('name', $pref->name());
        $this->assertSame('value', $pref->value());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<pref name="name">value</pref>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $pref);

        $array = array(
            'pref' => array(
                'name' => 'name',
                '_' => 'value',
            ),
        );
        $this->assertEquals($array, $pref->toArray());
    }

    public function testPrefSpec()
    {
        $pref = new \Zimbra\Voice\Struct\PrefSpec('name');
        $this->assertSame('name', $pref->name());
        $pref->name('name');
        $this->assertSame('name', $pref->name());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<pref name="name" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $pref);

        $array = array(
            'pref' => array(
                'name' => 'name',
            ),
        );
        $this->assertEquals($array, $pref->toArray());
    }

    public function testResetPhoneVoiceFeaturesSpec()
    {
        $anoncallrejection = new \Zimbra\Voice\Struct\AnonCallRejectionReq();
        $calleridblocking = new \Zimbra\Voice\Struct\CallerIdBlockingReq();
        $callforward = new \Zimbra\Voice\Struct\CallForwardReq();
        $callforwardbusyline = new \Zimbra\Voice\Struct\CallForwardBusyLineReq();
        $callforwardnoanswer = new \Zimbra\Voice\Struct\CallForwardNoAnswerReq();
        $callwaiting = new \Zimbra\Voice\Struct\CallWaitingReq();
        $selectivecallforward = new \Zimbra\Voice\Struct\SelectiveCallForwardReq();
        $selectivecallacceptance = new \Zimbra\Voice\Struct\SelectiveCallAcceptanceReq();
        $selectivecallrejection = new \Zimbra\Voice\Struct\SelectiveCallRejectionReq();

        $phone = new \Zimbra\Voice\Struct\ResetPhoneVoiceFeaturesSpec(
            'name',
            $anoncallrejection,
            $calleridblocking,
            $callforward,
            $callforwardbusyline,
            $callforwardnoanswer,
            $callwaiting,
            $selectivecallforward,
            $selectivecallacceptance,
            $selectivecallrejection
        );
        $this->assertSame('name', $phone->name());
        $this->assertSame($anoncallrejection, $phone->anoncallrejection());
        $this->assertSame($calleridblocking, $phone->calleridblocking());
        $this->assertSame($callforward, $phone->callforward());
        $this->assertSame($callforwardbusyline, $phone->callforwardbusyline());
        $this->assertSame($callforwardnoanswer, $phone->callforwardnoanswer());
        $this->assertSame($callwaiting, $phone->callwaiting());
        $this->assertSame($selectivecallforward, $phone->selectivecallforward());
        $this->assertSame($selectivecallacceptance, $phone->selectivecallacceptance());
        $this->assertSame($selectivecallrejection, $phone->selectivecallrejection());

        $phone->name('name')
              ->anoncallrejection($anoncallrejection)
              ->calleridblocking($calleridblocking)
              ->callforward($callforward)
              ->callforwardbusyline($callforwardbusyline)
              ->callforwardnoanswer($callforwardnoanswer)
              ->callwaiting($callwaiting)
              ->selectivecallforward($selectivecallforward)
              ->selectivecallacceptance($selectivecallacceptance)
              ->selectivecallrejection($selectivecallrejection);
        $this->assertSame('name', $phone->name());
        $this->assertSame($anoncallrejection, $phone->anoncallrejection());
        $this->assertSame($calleridblocking, $phone->calleridblocking());
        $this->assertSame($callforward, $phone->callforward());
        $this->assertSame($callforwardbusyline, $phone->callforwardbusyline());
        $this->assertSame($callforwardnoanswer, $phone->callforwardnoanswer());
        $this->assertSame($callwaiting, $phone->callwaiting());
        $this->assertSame($selectivecallforward, $phone->selectivecallforward());
        $this->assertSame($selectivecallacceptance, $phone->selectivecallacceptance());
        $this->assertSame($selectivecallrejection, $phone->selectivecallrejection());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<phone name="name">'
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

        $array = array(
            'phone' => array(
                'name' => 'name',
                'anoncallrejection' => array(),
                'calleridblocking' => array(),
                'callforward' => array(),
                'callforwardbusyline' => array(),
                'callforwardnoanswer' => array(),
                'callwaiting' => array(),
                'selectivecallforward' => array(),
                'selectivecallacceptance' => array(),
                'selectivecallrejection' => array(),
            ),
        );
        $this->assertEquals($array, $phone->toArray());
    }

    public function testSelectiveCallAcceptanceFeature()
    {
        $phone = new \Zimbra\Voice\Struct\CallerListEntry('pn', true);
        $selectivecallacceptance = new \Zimbra\Voice\Struct\SelectiveCallAcceptanceFeature(
            true, false, array($phone)
        );
        $this->assertInstanceOf('\Zimbra\Voice\Struct\FeatureWithCallerList', $selectivecallacceptance);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<selectivecallacceptance s="true" a="false">'
                .'<phone pn="pn" a="true" />'
            .'</selectivecallacceptance>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $selectivecallacceptance);

        $array = array(
            'selectivecallacceptance' => array(
                's' => true,
                'a' => false,
                'phone' => array(
                    array(
                        'pn' => 'pn',
                        'a' => true,
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $selectivecallacceptance->toArray());
    }

    public function testSelectiveCallAcceptanceReq()
    {
        $selectivecallacceptance = new \Zimbra\Voice\Struct\SelectiveCallAcceptanceReq();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<selectivecallacceptance />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $selectivecallacceptance);

        $array = array(
            'selectivecallacceptance' => array(),
        );
        $this->assertEquals($array, $selectivecallacceptance->toArray());
    }

    public function testSelectiveCallForwardFeature()
    {
        $phone = new \Zimbra\Voice\Struct\CallerListEntry('pn', true);
        $selectivecallforward = new \Zimbra\Voice\Struct\SelectiveCallForwardFeature(
            true, false, array($phone), 'ft'
        );
        $this->assertSame('ft', $selectivecallforward->ft());
        $selectivecallforward->ft('ft');
        $this->assertSame('ft', $selectivecallforward->ft());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<selectivecallforward s="true" a="false" ft="ft">'
                .'<phone pn="pn" a="true" />'
            .'</selectivecallforward>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $selectivecallforward);

        $array = array(
            'selectivecallforward' => array(
                's' => true,
                'a' => false,
                'ft' => 'ft',
                'phone' => array(
                    array(
                        'pn' => 'pn',
                        'a' => true,
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $selectivecallforward->toArray());
    }

    public function testSelectiveCallForwardReq()
    {
        $selectivecallforward = new \Zimbra\Voice\Struct\SelectiveCallForwardReq();

        $xml = '<?xml version="1.0"?>'."\n"
            .'<selectivecallforward />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $selectivecallforward);

        $array = array(
            'selectivecallforward' => array(),
        );
        $this->assertEquals($array, $selectivecallforward->toArray());
    }

    public function testSelectiveCallRejectionFeature()
    {
        $phone = new \Zimbra\Voice\Struct\CallerListEntry('pn', true);
        $selectivecallrejection = new \Zimbra\Voice\Struct\SelectiveCallRejectionFeature(
            true, false, array($phone)
        );
        $this->assertInstanceOf('\Zimbra\Voice\Struct\FeatureWithCallerList', $selectivecallrejection);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<selectivecallrejection s="true" a="false">'
                .'<phone pn="pn" a="true" />'
            .'</selectivecallrejection>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $selectivecallrejection);

        $array = array(
            'selectivecallrejection' => array(
                's' => true,
                'a' => false,
                'phone' => array(
                    array(
                        'pn' => 'pn',
                        'a' => true,
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $selectivecallrejection->toArray());
    }

    public function testSelectiveCallRejectionReq()
    {
        $selectivecallrejection = new \Zimbra\Voice\Struct\SelectiveCallRejectionReq();

        $xml = '<?xml version="1.0"?>'."\n"
            .'<selectivecallrejection />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $selectivecallrejection);

        $array = array(
            'selectivecallrejection' => array(),
        );
        $this->assertEquals($array, $selectivecallrejection->toArray());
    }

    public function testStorePrincipalSpec()
    {
        $storeprincipal = new \Zimbra\Voice\Struct\StorePrincipalSpec(
            'id', 'name', 'accountNumber'
        );
        $this->assertSame('id', $storeprincipal->id());
        $this->assertSame('name', $storeprincipal->name());
        $this->assertSame('accountNumber', $storeprincipal->accountNumber());
        $storeprincipal->id('id')
                       ->name('name')
                       ->accountNumber('accountNumber');
        $this->assertSame('id', $storeprincipal->id());
        $this->assertSame('name', $storeprincipal->name());
        $this->assertSame('accountNumber', $storeprincipal->accountNumber());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<storeprincipal id="id" name="name" accountNumber="accountNumber" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $storeprincipal);

        $array = array(
            'storeprincipal' => array(
                'id' => 'id',
                'name' => 'name',
                'accountNumber' => 'accountNumber',
            ),
        );
        $this->assertEquals($array, $storeprincipal->toArray());
    }

    public function testVoiceMailPrefName()
    {
        $pref = new \Zimbra\Voice\Struct\VoiceMailPrefName('name');
        $this->assertSame('name', $pref->name());
        $pref->name('name');
        $this->assertSame('name', $pref->name());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<pref name="name" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $pref);

        $array = array(
            'pref' => array(
                'name' => 'name',
            ),
        );
        $this->assertEquals($array, $pref->toArray());
    }

    public function testVoiceMailPrefsFeature()
    {
        $pref = new \Zimbra\Voice\Struct\PrefInfo('name', 'value');
        $voicemailprefs = new \Zimbra\Voice\Struct\VoiceMailPrefsFeature(
            true, false, array($pref)
        );
        $this->assertInstanceOf('\Zimbra\Voice\Struct\CallFeatureInfo', $voicemailprefs);
        $this->assertSame(array($pref), $voicemailprefs->pref()->all());
        $voicemailprefs->addPref($pref);
        $this->assertSame(array($pref, $pref), $voicemailprefs->pref()->all());
        $voicemailprefs->pref()->remove(1);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<voicemailprefs s="true" a="false">'
                .'<pref name="name">value</pref>'
            .'</voicemailprefs>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $voicemailprefs);

        $array = array(
            'voicemailprefs' => array(
                's' => true,
                'a' => false,
                'pref' => array(
                    array(
                        'name' => 'name',
                        '_' => 'value',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $voicemailprefs->toArray());
    }

    public function testVoiceMailPrefsReq()
    {
        $pref = new \Zimbra\Voice\Struct\VoiceMailPrefName('name');
        $voicemailprefs = new \Zimbra\Voice\Struct\VoiceMailPrefsReq(
            array($pref)
        );
        $this->assertSame(array($pref), $voicemailprefs->pref()->all());
        $voicemailprefs->addPref($pref);
        $this->assertSame(array($pref, $pref), $voicemailprefs->pref()->all());
        $voicemailprefs->pref()->remove(1);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<voicemailprefs>'
                .'<pref name="name" />'
            .'</voicemailprefs>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $voicemailprefs);

        $array = array(
            'voicemailprefs' => array(
                'pref' => array(
                    array(
                        'name' => 'name',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $voicemailprefs->toArray());
    }

    public function testVoiceMsgActionSpec()
    {
        $action = new \Zimbra\Voice\Struct\VoiceMsgActionSpec(
            VoiceMsgActionOp::MOVE(), 'phone', 'id', 'l'
        );
        $this->assertTrue($action->op()->is('move'));
        $this->assertSame('phone', $action->phone());
        $this->assertSame('id', $action->id());
        $this->assertSame('l', $action->l());
        $action->op(VoiceMsgActionOp::MOVE())
               ->phone('phone')
               ->id('id')
               ->l('l');
        $this->assertTrue($action->op()->is('move'));
        $this->assertSame('phone', $action->phone());
        $this->assertSame('id', $action->id());
        $this->assertSame('l', $action->l());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<action op="move" phone="phone" id="id" l="l" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $action);

        $array = array(
            'action' => array(
                'op' => 'move',
                'phone' => 'phone',
                'id' => 'id',
                'l' => 'l',
            ),
        );
        $this->assertEquals($array, $action->toArray());
    }

    public function testVoiceMsgUploadSpec()
    {
        $vm = new \Zimbra\Voice\Struct\VoiceMsgUploadSpec(
            'id', 'phone'
        );
        $this->assertSame('id', $vm->id());
        $this->assertSame('phone', $vm->phone());
        $vm->phone('phone')
           ->id('id');
        $this->assertSame('id', $vm->id());
        $this->assertSame('phone', $vm->phone());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<vm id="id" phone="phone" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $vm);

        $array = array(
            'vm' => array(
                'id' => 'id',
                'phone' => 'phone',
            ),
        );
        $this->assertEquals($array, $vm->toArray());
    }
}
