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
        $anoncallrejection = new \Zimbra\Voice\Struct\AnonCallRejectionFeature(true, false);
        $this->assertInstanceOf('\Zimbra\Voice\Struct\CallFeatureInfo', $anoncallrejection);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<anoncallrejection s="true" a="false" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $anoncallrejection);

        $array = [
            'anoncallrejection' => [
                's' => true,
                'a' => false,
            ],
        ];
        $this->assertEquals($array, $anoncallrejection->toArray());
    }

    public function testAnonCallRejectionReq()
    {
        $anoncallrejection = new \Zimbra\Voice\Struct\AnonCallRejectionReq();
        $this->assertInstanceOf('\Zimbra\Voice\Struct\CallFeatureReq', $anoncallrejection);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<anoncallrejection />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $anoncallrejection);

        $array = [
            'anoncallrejection' => [],
        ];
        $this->assertEquals($array, $anoncallrejection->toArray());
    }

    public function testCallerIdBlockingFeature()
    {
        $calleridblocking = new \Zimbra\Voice\Struct\CallerIdBlockingFeature(true, false);
        $this->assertInstanceOf('\Zimbra\Voice\Struct\CallFeatureInfo', $calleridblocking);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<calleridblocking s="true" a="false" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $calleridblocking);

        $array = [
            'calleridblocking' => [
                's' => true,
                'a' => false,
            ],
        ];
        $this->assertEquals($array, $calleridblocking->toArray());
    }

    public function testCallerIdBlockingReq()
    {
        $calleridblocking = new \Zimbra\Voice\Struct\CallerIdBlockingReq();
        $this->assertInstanceOf('\Zimbra\Voice\Struct\CallFeatureReq', $calleridblocking);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<calleridblocking />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $calleridblocking);

        $array = [
            'calleridblocking' => [],
        ];
        $this->assertEquals($array, $calleridblocking->toArray());
    }

    public function testCallerListEntry()
    {
        $pn = self::randomName();
        $phone = new \Zimbra\Voice\Struct\CallerListEntry($pn, true);
        $this->assertSame($pn, $phone->getPhoneNumber());
        $this->assertTrue($phone->getActive());
        $phone->setPhoneNumber($pn)
              ->setActive(true);
        $this->assertSame($pn, $phone->getPhoneNumber());
        $this->assertTrue($phone->getActive());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<phone pn="' . $pn . '" a="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $phone);

        $array = [
            'phone' => [
                'pn' => $pn,
                'a' => true,
            ],
        ];
        $this->assertEquals($array, $phone->toArray());
    }

    public function testCallFeatureInfo()
    {
        $base = $this->getMockForAbstractClass('Zimbra\Voice\Struct\CallFeatureInfo', [true, false]);
        $this->assertTrue($base->getSubscribed());
        $this->assertFalse($base->getActive());
        $base->setSubscribed(true);
        $base->setActive(false);
        $this->assertTrue($base->getSubscribed());
        $this->assertFalse($base->getActive());
    }

    public function testCallForwardBusyLineFeature()
    {
        $ft = self::randomName();
        $callforwardbusyline = new \Zimbra\Voice\Struct\CallForwardBusyLineFeature(true, false, $ft);
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

    public function testCallForwardBusyLineReq()
    {
        $callforwardbusyline = new \Zimbra\Voice\Struct\CallForwardBusyLineReq();
        $this->assertInstanceOf('\Zimbra\Voice\Struct\CallFeatureReq', $callforwardbusyline);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<callforwardbusyline />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $callforwardbusyline);

        $array = [
            'callforwardbusyline' => [],
        ];
        $this->assertEquals($array, $callforwardbusyline->toArray());
    }

    public function testCallForwardFeature()
    {
        $ft = self::randomName();
        $callforward = new \Zimbra\Voice\Struct\CallForwardFeature(true, false, $ft);
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

    public function testCallForwardNoAnswerFeature()
    {
        $ft = self::randomName();
        $nr = self::randomName();

        $callforwardnoanswer = new \Zimbra\Voice\Struct\CallForwardNoAnswerFeature(true, false, $ft, $nr);
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

    public function testCallForwardNoAnswerReq()
    {
        $callforwardnoanswer = new \Zimbra\Voice\Struct\CallForwardNoAnswerReq();
        $this->assertInstanceOf('\Zimbra\Voice\Struct\CallFeatureReq', $callforwardnoanswer);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<callforwardnoanswer />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $callforwardnoanswer);

        $array = [
            'callforwardnoanswer' => [],
        ];
        $this->assertEquals($array, $callforwardnoanswer->toArray());
    }

    public function testCallForwardReq()
    {
        $callforward = new \Zimbra\Voice\Struct\CallForwardReq();
        $this->assertInstanceOf('\Zimbra\Voice\Struct\CallFeatureReq', $callforward);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<callforward />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $callforward);

        $array = [
            'callforward' => [],
        ];
        $this->assertEquals($array, $callforward->toArray());
    }

    public function testCallWaitingFeature()
    {
        $callwaiting = new \Zimbra\Voice\Struct\CallWaitingFeature(true, false);
        $this->assertInstanceOf('\Zimbra\Voice\Struct\CallFeatureInfo', $callwaiting);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<callwaiting s="true" a="false" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $callwaiting);

        $array = [
            'callwaiting' => [
                's' => true,
                'a' => false,
            ],
        ];
        $this->assertEquals($array, $callwaiting->toArray());
    }

    public function testCallWaitingReq()
    {
        $callwaiting = new \Zimbra\Voice\Struct\CallWaitingReq();
        $this->assertInstanceOf('\Zimbra\Voice\Struct\CallFeatureReq', $callwaiting);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<callwaiting />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $callwaiting);

        $array = [
            'callwaiting' => [],
        ];
        $this->assertEquals($array, $callwaiting->toArray());
    }

    public function testFeatureWithCallerList()
    {
        $pn = self::randomName();
        $phone = new \Zimbra\Voice\Struct\CallerListEntry($pn, true);
        $featureWithCallerList = new \Zimbra\Voice\Struct\FeatureWithCallerList(true, false, [$phone]);
        $this->assertInstanceOf('\Zimbra\Voice\Struct\CallFeatureInfo', $featureWithCallerList);
        $this->assertSame([$phone], $featureWithCallerList->getPhones()->all());
        $featureWithCallerList->addPhone($phone);
        $this->assertSame([$phone, $phone], $featureWithCallerList->getPhones()->all());
    }

    public function testModifyFromNumSpec()
    {
        $oldPhone = self::randomName();
        $newPhone = self::randomName();
        $id = self::randomName();
        $label = self::randomName();

        $phone = new \Zimbra\Voice\Struct\ModifyFromNumSpec(
            $oldPhone, $newPhone, $id, $label
        );
        $this->assertSame($oldPhone, $phone->getOldPhone());
        $this->assertSame($newPhone, $phone->getPhone());
        $this->assertSame($id, $phone->getId());
        $this->assertSame($label, $phone->getLabel());
        $phone->setOldPhone($oldPhone)
              ->setPhone($newPhone)
              ->setId($id)
              ->setLabel($label);
        $this->assertSame($oldPhone, $phone->getOldPhone());
        $this->assertSame($newPhone, $phone->getPhone());
        $this->assertSame($id, $phone->getId());
        $this->assertSame($label, $phone->getLabel());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<phone oldPhone="' . $oldPhone . '" phone="' . $newPhone . '" id="' . $id . '" label="' . $label . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $phone);

        $array = [
            'phone' => [
                'oldPhone' => $oldPhone,
                'phone' => $newPhone,
                'id' => $id,
                'label' => $label,
            ],
        ];
        $this->assertEquals($array, $phone->toArray());
    }

    function testModifyVoiceFeaturesSpec()
    {
        $name = self::randomName();
        $value = self::randomName();
        $pn = self::randomName();
        $ft = self::randomName();
        $nr = self::randomName();

        $pref = new \Zimbra\Voice\Struct\PrefInfo($name, $value);
        $entry = new \Zimbra\Voice\Struct\CallerListEntry($pn, true);

        $voicemailprefs = new \Zimbra\Voice\Struct\VoiceMailPrefsFeature(
            true, false, [$pref]
        );
        $anoncallrejection = new \Zimbra\Voice\Struct\AnonCallRejectionFeature(
            true, false
        );
        $calleridblocking = new \Zimbra\Voice\Struct\CallerIdBlockingFeature(
            true, false
        );
        $callforward = new \Zimbra\Voice\Struct\CallForwardFeature(
            true, false, $ft
        );
        $callforwardbusyline = new \Zimbra\Voice\Struct\CallForwardBusyLineFeature(
            true, false, $ft
        );
        $callforwardnoanswer = new \Zimbra\Voice\Struct\CallForwardNoAnswerFeature(
            true, false, $ft, $nr
        );
        $callwaiting = new \Zimbra\Voice\Struct\CallWaitingFeature(
            true, false
        );
        $selectivecallforward = new \Zimbra\Voice\Struct\SelectiveCallForwardFeature(
            true, false, [$entry], $ft
        );
        $selectivecallacceptance = new \Zimbra\Voice\Struct\SelectiveCallAcceptanceFeature(
            true, false, [$entry]
        );
        $selectivecallrejection = new \Zimbra\Voice\Struct\SelectiveCallRejectionFeature(
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
        $spec = new \Zimbra\Voice\Struct\ModifyVoiceFeaturesSpec($name, $callFeatures);
        $this->assertSame($name, $spec->getName());
        $this->assertSame($callFeatures, $spec->getCallFeatures()->all());

        $spec = new \Zimbra\Voice\Struct\ModifyVoiceFeaturesSpec($name);
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

    public function testModifyVoiceMailPinSpec()
    {
        $oldPin = self::randomName();
        $pin = self::randomName();
        $name = self::randomName();

        $phone = new \Zimbra\Voice\Struct\ModifyVoiceMailPinSpec(
            $oldPin, $pin, $name
        );
        $this->assertSame($oldPin, $phone->getOldPin());
        $this->assertSame($pin, $phone->getPin());
        $this->assertSame($name, $phone->getName());
        $phone->setOldPin($oldPin)
              ->setPin($pin)
              ->setName($name);
        $this->assertSame($oldPin, $phone->getOldPin());
        $this->assertSame($pin, $phone->getPin());
        $this->assertSame($name, $phone->getName());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<phone oldPin="' . $oldPin . '" pin="' . $pin . '" name="' . $name . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $phone);

        $array = [
            'phone' => [
                'oldPin' => $oldPin,
                'pin' => $pin,
                'name' => $name,
            ],
        ];
        $this->assertEquals($array, $phone->toArray());
    }

    public function testPhoneInfo()
    {
        $name = self::randomName();
        $value = self::randomName();

        $pref = new \Zimbra\Voice\Struct\PrefInfo($name, $value);
        $phone = new \Zimbra\Voice\Struct\PhoneInfo($name, [$pref]);
        $this->assertSame($name, $phone->getName());
        $this->assertSame([$pref], $phone->getPrefs()->all());
        $phone->setName($name)
              ->addPref($pref);
        $this->assertSame($name, $phone->getName());
        $this->assertSame([$pref, $pref], $phone->getPrefs()->all());
        $phone->getPrefs()->remove(1);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<phone name="' . $name . '">'
                .'<pref name="' . $name . '">' . $value . '</pref>'
            .'</phone>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $phone);

        $array = [
            'phone' => [
                'name' => $name,
                'pref' => [
                    [
                        'name' => $name,
                        '_content' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $phone->toArray());
    }

    public function testPhoneSpec()
    {
        $name = self::randomName();
        $pref = new \Zimbra\Voice\Struct\PrefSpec($name);
        $phone = new \Zimbra\Voice\Struct\PhoneSpec($name, [$pref]);
        $this->assertSame($name, $phone->getName());
        $this->assertSame([$pref], $phone->getPrefs()->all());
        $phone->setName($name)
              ->addPref($pref);
        $this->assertSame($name, $phone->getName());
        $this->assertSame([$pref, $pref], $phone->getPrefs()->all());
        $phone->getPrefs()->remove(1);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<phone name="' . $name . '">'
                .'<pref name="' . $name . '" />'
            .'</phone>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $phone);

        $array = [
            'phone' => [
                'name' => $name,
                'pref' => [
                    [
                        'name' => $name,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $phone->toArray());
    }

    public function testPhoneVoiceFeaturesSpec()
    {
        $name = self::randomName();
        $pref = new \Zimbra\Voice\Struct\VoiceMailPrefName($name);
        $voicemailprefs = new \Zimbra\Voice\Struct\VoiceMailPrefsReq(
            [$pref]
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
        $phone = new \Zimbra\Voice\Struct\PhoneVoiceFeaturesSpec($name, $callFeatures);
        $this->assertSame($name, $phone->getName());
        $this->assertSame($callFeatures, $phone->getCallFeatures()->all());

        $phone = new \Zimbra\Voice\Struct\PhoneVoiceFeaturesSpec($name);
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

    public function testPrefInfo()
    {
        $name = self::randomName();
        $value = self::randomName();
        $pref = new \Zimbra\Voice\Struct\PrefInfo($name, $value);
        $this->assertSame($name, $pref->getName());
        $pref->setName($name);
        $this->assertSame($name, $pref->getName());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<pref name="' . $name . '">' . $value . '</pref>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $pref);

        $array = [
            'pref' => [
                'name' => $name,
                '_content' => $value,
            ],
        ];
        $this->assertEquals($array, $pref->toArray());
    }

    public function testPrefSpec()
    {
        $name = self::randomName();
        $pref = new \Zimbra\Voice\Struct\PrefSpec($name);
        $this->assertSame($name, $pref->getName());
        $pref->setName($name);
        $this->assertSame($name, $pref->getName());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<pref name="' . $name . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $pref);

        $array = [
            'pref' => [
                'name' => $name,
            ],
        ];
        $this->assertEquals($array, $pref->toArray());
    }

    public function testResetPhoneVoiceFeaturesSpec()
    {
        $name = self::randomName();
        $anoncallrejection = new \Zimbra\Voice\Struct\AnonCallRejectionReq();
        $calleridblocking = new \Zimbra\Voice\Struct\CallerIdBlockingReq();
        $callforward = new \Zimbra\Voice\Struct\CallForwardReq();
        $callforwardbusyline = new \Zimbra\Voice\Struct\CallForwardBusyLineReq();
        $callforwardnoanswer = new \Zimbra\Voice\Struct\CallForwardNoAnswerReq();
        $callwaiting = new \Zimbra\Voice\Struct\CallWaitingReq();
        $selectivecallforward = new \Zimbra\Voice\Struct\SelectiveCallForwardReq();
        $selectivecallacceptance = new \Zimbra\Voice\Struct\SelectiveCallAcceptanceReq();
        $selectivecallrejection = new \Zimbra\Voice\Struct\SelectiveCallRejectionReq();

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
        $phone = new \Zimbra\Voice\Struct\ResetPhoneVoiceFeaturesSpec($name, $callFeatures);
        $this->assertSame($name, $phone->getName());
        $this->assertSame($callFeatures, $phone->getCallFeatures()->all());

        $phone = new \Zimbra\Voice\Struct\ResetPhoneVoiceFeaturesSpec($name);
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

    public function testSelectiveCallAcceptanceFeature()
    {
        $pn = self::randomName();
        $phone = new \Zimbra\Voice\Struct\CallerListEntry($pn, true);
        $selectivecallacceptance = new \Zimbra\Voice\Struct\SelectiveCallAcceptanceFeature(
            true, false, [$phone]
        );
        $this->assertInstanceOf('\Zimbra\Voice\Struct\FeatureWithCallerList', $selectivecallacceptance);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<selectivecallacceptance s="true" a="false">'
                .'<phone pn="' . $pn . '" a="true" />'
            .'</selectivecallacceptance>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $selectivecallacceptance);

        $array = [
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
        ];
        $this->assertEquals($array, $selectivecallacceptance->toArray());
    }

    public function testSelectiveCallAcceptanceReq()
    {
        $selectivecallacceptance = new \Zimbra\Voice\Struct\SelectiveCallAcceptanceReq();
        $this->assertInstanceOf('\Zimbra\Voice\Struct\CallFeatureReq', $selectivecallacceptance);
        $xml = '<?xml version="1.0"?>'."\n"
            .'<selectivecallacceptance />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $selectivecallacceptance);

        $array = [
            'selectivecallacceptance' => [],
        ];
        $this->assertEquals($array, $selectivecallacceptance->toArray());
    }

    public function testSelectiveCallForwardFeature()
    {
        $pn = self::randomName();
        $ft = self::randomName();
        $phone = new \Zimbra\Voice\Struct\CallerListEntry($pn, true);
        $selectivecallforward = new \Zimbra\Voice\Struct\SelectiveCallForwardFeature(
            true, false, [$phone], $ft
        );
        $this->assertSame($ft, $selectivecallforward->getForwardTo());
        $selectivecallforward->setForwardTo($ft);
        $this->assertSame($ft, $selectivecallforward->getForwardTo());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<selectivecallforward s="true" a="false" ft="' . $ft . '">'
                .'<phone pn="' . $pn . '" a="true" />'
            .'</selectivecallforward>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $selectivecallforward);

        $array = [
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
        ];
        $this->assertEquals($array, $selectivecallforward->toArray());
    }

    public function testSelectiveCallForwardReq()
    {
        $selectivecallforward = new \Zimbra\Voice\Struct\SelectiveCallForwardReq();
        $this->assertInstanceOf('\Zimbra\Voice\Struct\CallFeatureReq', $selectivecallforward);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<selectivecallforward />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $selectivecallforward);

        $array = [
            'selectivecallforward' => [],
        ];
        $this->assertEquals($array, $selectivecallforward->toArray());
    }

    public function testSelectiveCallRejectionFeature()
    {
        $pn = self::randomName();
        $phone = new \Zimbra\Voice\Struct\CallerListEntry($pn, true);
        $selectivecallrejection = new \Zimbra\Voice\Struct\SelectiveCallRejectionFeature(
            true, false, [$phone]
        );
        $this->assertInstanceOf('\Zimbra\Voice\Struct\FeatureWithCallerList', $selectivecallrejection);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<selectivecallrejection s="true" a="false">'
                .'<phone pn="' . $pn . '" a="true" />'
            .'</selectivecallrejection>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $selectivecallrejection);

        $array = [
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
        ];
        $this->assertEquals($array, $selectivecallrejection->toArray());
    }

    public function testSelectiveCallRejectionReq()
    {
        $selectivecallrejection = new \Zimbra\Voice\Struct\SelectiveCallRejectionReq();
        $this->assertInstanceOf('\Zimbra\Voice\Struct\CallFeatureReq', $selectivecallrejection);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<selectivecallrejection />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $selectivecallrejection);

        $array = [
            'selectivecallrejection' => [],
        ];
        $this->assertEquals($array, $selectivecallrejection->toArray());
    }

    public function testStorePrincipalSpec()
    {
        $id = self::randomName();
        $name = self::randomName();
        $accountNumber = self::randomName();

        $storeprincipal = new \Zimbra\Voice\Struct\StorePrincipalSpec(
            $id, $name, $accountNumber
        );
        $this->assertSame($id, $storeprincipal->getId());
        $this->assertSame($name, $storeprincipal->getName());
        $this->assertSame($accountNumber, $storeprincipal->getAccountNumber());
        $storeprincipal->setId($id)
                       ->setName($name)
                       ->setAccountNumber($accountNumber);
        $this->assertSame($id, $storeprincipal->getId());
        $this->assertSame($name, $storeprincipal->getName());
        $this->assertSame($accountNumber, $storeprincipal->getAccountNumber());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<storeprincipal id="' . $id . '" name="' . $name . '" accountNumber="' . $accountNumber . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $storeprincipal);

        $array = [
            'storeprincipal' => [
                'id' => $id,
                'name' => $name,
                'accountNumber' => $accountNumber,
            ],
        ];
        $this->assertEquals($array, $storeprincipal->toArray());
    }

    public function testVoiceMailPrefName()
    {
        $name = self::randomName();
        $pref = new \Zimbra\Voice\Struct\VoiceMailPrefName($name);
        $this->assertSame($name, $pref->getName());
        $pref->setName($name);
        $this->assertSame($name, $pref->getName());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<pref name="' . $name . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $pref);

        $array = [
            'pref' => [
                'name' => $name,
            ],
        ];
        $this->assertEquals($array, $pref->toArray());
    }

    public function testVoiceMailPrefsFeature()
    {
        $name = self::randomName();
        $value = self::randomName();
        $pref = new \Zimbra\Voice\Struct\PrefInfo($name, $value);
        $voicemailprefs = new \Zimbra\Voice\Struct\VoiceMailPrefsFeature(
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

    public function testVoiceMailPrefsReq()
    {
        $name = self::randomName();
        $pref = new \Zimbra\Voice\Struct\VoiceMailPrefName($name);
        $voicemailprefs = new \Zimbra\Voice\Struct\VoiceMailPrefsReq([$pref]);
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

    public function testVoiceMsgActionSpec()
    {
        $phone = self::randomName();
        $id = self::randomName();
        $folderId = self::randomName();
        $action = new \Zimbra\Voice\Struct\VoiceMsgActionSpec(
            VoiceMsgActionOp::MOVE(), $phone, $id, $folderId
        );
        $this->assertTrue($action->getOperation()->is('move'));
        $this->assertSame($phone, $action->getPhone());
        $this->assertSame($id, $action->getId());
        $this->assertSame($folderId, $action->getFolderId());
        $action->setOperation(VoiceMsgActionOp::MOVE())
               ->setPhone($phone)
               ->setId($id)
               ->setFolderId($folderId);
        $this->assertTrue($action->getOperation()->is('move'));
        $this->assertSame($phone, $action->getPhone());
        $this->assertSame($id, $action->getId());
        $this->assertSame($folderId, $action->getFolderId());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<action op="' . VoiceMsgActionOp::MOVE() . '" phone="' . $phone . '" id="' . $id . '" l="' . $folderId . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $action);

        $array = [
            'action' => [
                'op' => VoiceMsgActionOp::MOVE()->value(),
                'phone' => $phone,
                'id' => $id,
                'l' => $folderId,
            ],
        ];
        $this->assertEquals($array, $action->toArray());
    }

    public function testVoiceMsgUploadSpec()
    {
        $phone = self::randomName();
        $id = self::randomName();
        $vm = new \Zimbra\Voice\Struct\VoiceMsgUploadSpec(
            $id, $phone
        );
        $this->assertSame($id, $vm->getId());
        $this->assertSame($phone, $vm->getPhone());
        $vm->setPhone($phone)
           ->setId($id);
        $this->assertSame($id, $vm->getId());
        $this->assertSame($phone, $vm->getPhone());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<vm id="' . $id . '" phone="' . $phone . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $vm);

        $array = [
            'vm' => [
                'id' => $id,
                'phone' => $phone,
            ],
        ];
        $this->assertEquals($array, $vm->toArray());
    }
}
