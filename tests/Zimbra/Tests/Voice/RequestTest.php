<?php

namespace Zimbra\Tests\Voice;

use Zimbra\Tests\ZimbraTestCase;
use Zimbra\Enum\VoiceMsgActionOp;
use Zimbra\Enum\VoiceSortBy;

/**
 * Testcase class for voice request.
 */
class RequestTest extends ZimbraTestCase
{
    public function testBaseRequest()
    {
        $req = $this->getMockForAbstractClass('\Zimbra\Voice\Request\Base');
        $this->assertInstanceOf('Zimbra\Soap\Request', $req);
        $this->assertEquals('urn:zimbraVoice', $req->getXmlNamespace());
    }

    public function testChangeUCPassword()
    {
        $password = self::randomName();
        $req = new \Zimbra\Voice\Request\ChangeUCPassword(
            $password
        );
        $this->assertInstanceOf('Zimbra\Voice\Request\Base', $req);
        $this->assertSame($password, $req->getPassword());
        $req->setPassword($password);
        $this->assertSame($password, $req->getPassword());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ChangeUCPasswordRequest password="' . $password . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ChangeUCPasswordRequest' => [
                '_jsns' => 'urn:zimbraVoice',
                'password' =>$password,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetUCInfo()
    {
        $req = new \Zimbra\Voice\Request\GetUCInfo();
        $this->assertInstanceOf('Zimbra\Voice\Request\Base', $req);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetUCInfoRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetUCInfoRequest' => [
                '_jsns' => 'urn:zimbraVoice',
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetVoiceFeatures()
    {
        $id = self::randomName();
        $name = self::randomName();
        $accountNumber = self::randomName();
        $storeprincipal = new \Zimbra\Voice\Struct\StorePrincipalSpec(
            $id, $name, $accountNumber
        );

        $pref = new \Zimbra\Voice\Struct\VoiceMailPrefName($name);
        $voicemailprefs = new \Zimbra\Voice\Struct\VoiceMailPrefsReq([$pref]);
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
        $phone = new \Zimbra\Voice\Struct\PhoneVoiceFeaturesSpec(
            $name, $callFeatures
        );

        $req = new \Zimbra\Voice\Request\GetVoiceFeatures(
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
            .'<GetVoiceFeaturesRequest>'
                .'<storeprincipal id="' . $id . '" name="' . $name . '" accountNumber="' . $accountNumber . '" />'
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
                .'</phone>'
            .'</GetVoiceFeaturesRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetVoiceFeaturesRequest' => [
                '_jsns' => 'urn:zimbraVoice',
                'storeprincipal' => [
                    'id' => $id,
                    'name' => $name,
                    'accountNumber' => $accountNumber,
                ],
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
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetVoiceFolder()
    {
        $id = self::randomName();
        $name = self::randomName();
        $accountNumber = self::randomName();
        $storeprincipal = new \Zimbra\Voice\Struct\StorePrincipalSpec(
            $id, $name, $accountNumber
        );
        $pref = new \Zimbra\Voice\Struct\PrefSpec($name);
        $phone = new \Zimbra\Voice\Struct\PhoneSpec($name, [$pref]);

        $req = new \Zimbra\Voice\Request\GetVoiceFolder(
            $storeprincipal, [$phone]
        );
        $this->assertInstanceOf('Zimbra\Voice\Request\Base', $req);
        $this->assertSame($storeprincipal, $req->getStorePrincipal());
        $this->assertSame([$phone], $req->getPhones()->all());
        $req->setStorePrincipal($storeprincipal)
            ->addPhone($phone);
        $this->assertSame($storeprincipal, $req->getStorePrincipal());
        $this->assertSame([$phone, $phone], $req->getPhones()->all());
        $req->getPhones()->remove(1);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetVoiceFolderRequest>'
                .'<storeprincipal id="' . $id . '" name="' . $name . '" accountNumber="' . $accountNumber . '" />'
                .'<phone name="' . $name . '">'
                    .'<pref name="' . $name . '" />'
                .'</phone>'
            .'</GetVoiceFolderRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetVoiceFolderRequest' => [
                '_jsns' => 'urn:zimbraVoice',
                'storeprincipal' => [
                    'id' => $id,
                    'name' => $name,
                    'accountNumber' => $accountNumber,
                ],
                'phone' => [
                    [
                        'name' => $name,
                        'pref' => [
                            [
                                'name' => $name,
                            ],
                        ],
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetVoiceInfo()
    {
        $name = self::randomName();
        $pref = new \Zimbra\Voice\Struct\PrefSpec($name);
        $phone = new \Zimbra\Voice\Struct\PhoneSpec($name, [$pref]);

        $req = new \Zimbra\Voice\Request\GetVoiceInfo(
            [$phone]
        );
        $this->assertInstanceOf('Zimbra\Voice\Request\Base', $req);
        $this->assertSame([$phone], $req->getPhones()->all());
        $req->addPhone($phone);
        $this->assertSame([$phone, $phone], $req->getPhones()->all());
        $req->getPhones()->remove(1);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetVoiceInfoRequest>'
                .'<phone name="' . $name . '">'
                    .'<pref name="' . $name . '" />'
                .'</phone>'
            .'</GetVoiceInfoRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetVoiceInfoRequest' => [
                '_jsns' => 'urn:zimbraVoice',
                'phone' => [
                    [
                        'name' => $name,
                        'pref' => [
                            [
                                'name' => $name,
                            ],
                        ],
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetVoiceMailPrefs()
    {
        $id = self::randomName();
        $name = self::randomName();
        $accountNumber = self::randomName();
        $storeprincipal = new \Zimbra\Voice\Struct\StorePrincipalSpec(
            $id, $name, $accountNumber
        );
        $pref = new \Zimbra\Voice\Struct\PrefSpec($name);
        $phone = new \Zimbra\Voice\Struct\PhoneSpec($name, [$pref]);

        $req = new \Zimbra\Voice\Request\GetVoiceMailPrefs(
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
            .'<GetVoiceMailPrefsRequest>'
                .'<storeprincipal id="' . $id . '" name="' . $name . '" accountNumber="' . $accountNumber . '" />'
                .'<phone name="' . $name . '">'
                    .'<pref name="' . $name . '" />'
                .'</phone>'
            .'</GetVoiceMailPrefsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetVoiceMailPrefsRequest' => [
                '_jsns' => 'urn:zimbraVoice',
                'storeprincipal' => [
                    'id' => $id,
                    'name' => $name,
                    'accountNumber' => $accountNumber,
                ],
                'phone' => [
                    'name' => $name,
                    'pref' => [
                        [
                            'name' => $name,
                        ],
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyFromNum()
    {
        $id = self::randomName();
        $name = self::randomName();
        $accountNumber = self::randomName();
        $storeprincipal = new \Zimbra\Voice\Struct\StorePrincipalSpec(
            $id, $name, $accountNumber
        );

        $oldPhone = self::randomName();
        $newPhone = self::randomName();
        $label = self::randomName();
        $phone = new \Zimbra\Voice\Struct\ModifyFromNumSpec(
            $oldPhone, $newPhone, $id, $label
        );

        $req = new \Zimbra\Voice\Request\ModifyFromNum(
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
            .'<ModifyFromNumRequest>'
                .'<storeprincipal id="' . $id . '" name="' . $name . '" accountNumber="' . $accountNumber . '" />'
                .'<phone oldPhone="' . $oldPhone . '" phone="' . $newPhone . '" id="' . $id . '" label="' . $label . '" />'
            .'</ModifyFromNumRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ModifyFromNumRequest' => [
                '_jsns' => 'urn:zimbraVoice',
                'storeprincipal' => [
                    'id' => $id,
                    'name' => $name,
                    'accountNumber' => $accountNumber,
                ],
                'phone' => [
                    'oldPhone' => $oldPhone,
                    'phone' => $newPhone,
                    'id' => $id,
                    'label' => $label,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyVoiceFeatures()
    {
        $id = self::randomName();
        $name = self::randomName();
        $accountNumber = self::randomName();
        $storeprincipal = new \Zimbra\Voice\Struct\StorePrincipalSpec(
            $id, $name, $accountNumber
        );

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
        $phone = new \Zimbra\Voice\Struct\ModifyVoiceFeaturesSpec(
            $name, $callFeatures
        );

        $req = new \Zimbra\Voice\Request\ModifyVoiceFeatures(
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

    public function testModifyVoiceMailPin()
    {
        $id = self::randomName();
        $name = self::randomName();
        $accountNumber = self::randomName();
        $storeprincipal = new \Zimbra\Voice\Struct\StorePrincipalSpec(
            $id, $name, $accountNumber
        );

        $oldPin = self::randomName();
        $pin = self::randomName();
        $phone = new \Zimbra\Voice\Struct\ModifyVoiceMailPinSpec(
            $oldPin, $pin, $name
        );

        $req = new \Zimbra\Voice\Request\ModifyVoiceMailPin(
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
            .'<ModifyVoiceMailPinRequest>'
                .'<storeprincipal id="' . $id . '" name="' . $name . '" accountNumber="' . $accountNumber . '" />'
                .'<phone oldPin="' . $oldPin . '" pin="' . $pin . '" name="' . $name . '" />'
            .'</ModifyVoiceMailPinRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ModifyVoiceMailPinRequest' => [
                '_jsns' => 'urn:zimbraVoice',
                'storeprincipal' => [
                    'id' => $id,
                    'name' => $name,
                    'accountNumber' => $accountNumber,
                ],
                'phone' => [
                    'oldPin' => $oldPin,
                    'pin' => $pin,
                    'name' => $name,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyVoiceMailPrefs()
    {
        $id = self::randomName();
        $name = self::randomName();
        $accountNumber = self::randomName();
        $value = self::randomName();
        $storeprincipal = new \Zimbra\Voice\Struct\StorePrincipalSpec(
            $id, $name, $accountNumber
        );
        $pref = new \Zimbra\Voice\Struct\PrefInfo($name, $value);
        $phone = new \Zimbra\Voice\Struct\PhoneInfo($name, [$pref]);

        $req = new \Zimbra\Voice\Request\ModifyVoiceMailPrefs(
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
            .'<ModifyVoiceMailPrefsRequest>'
                .'<storeprincipal id="' . $id . '" name="' . $name . '" accountNumber="' . $accountNumber . '" />'
                .'<phone name="' . $name . '">'
                    .'<pref name="' . $name . '">' . $value . '</pref>'
                .'</phone>'
            .'</ModifyVoiceMailPrefsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ModifyVoiceMailPrefsRequest' => [
                '_jsns' => 'urn:zimbraVoice',
                'storeprincipal' => [
                    'id' => $id,
                    'name' => $name,
                    'accountNumber' => $accountNumber,
                ],
                'phone' => [
                    'name' => $name,
                    'pref' => [
                        [
                            'name' => $name,
                            '_content' => $value,
                        ],
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testResetVoiceFeatures()
    {
        $id = self::randomName();
        $name = self::randomName();
        $accountNumber = self::randomName();
        $storeprincipal = new \Zimbra\Voice\Struct\StorePrincipalSpec(
            $id, $name, $accountNumber
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
        $phone = new \Zimbra\Voice\Struct\ResetPhoneVoiceFeaturesSpec(
            $name, $callFeatures
        );

        $req = new \Zimbra\Voice\Request\ResetVoiceFeatures(
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
            .'<ResetVoiceFeaturesRequest>'
                .'<storeprincipal id="' . $id . '" name="' . $name . '" accountNumber="' . $accountNumber . '" />'
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
                .'</phone>'
            .'</ResetVoiceFeaturesRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ResetVoiceFeaturesRequest' => [
                '_jsns' => 'urn:zimbraVoice',
                'storeprincipal' => [
                    'id' => $id,
                    'name' => $name,
                    'accountNumber' => $accountNumber,
                ],
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
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testSearchVoice()
    {
        $id = self::randomName();
        $name = self::randomName();
        $accountNumber = self::randomName();
        $query = self::randomName();
        $types = self::randomName();
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);

        $storeprincipal = new \Zimbra\Voice\Struct\StorePrincipalSpec(
            $id, $name, $accountNumber
        );
        $req = new \Zimbra\Voice\Request\SearchVoice(
            $query, $storeprincipal, $limit, $offset, $types, VoiceSortBy::DATE_DESC()
        );
        $this->assertInstanceOf('Zimbra\Voice\Request\Base', $req);
        $this->assertSame($query, $req->getQuery());
        $this->assertSame($storeprincipal, $req->getStorePrincipal());
        $this->assertSame($limit, $req->getLimit());
        $this->assertSame($offset, $req->getOffset());
        $this->assertSame($types, $req->getTypes());
        $this->assertTrue($req->getSortBy()->is('dateDesc'));

        $req->setQuery($query)
            ->setStorePrincipal($storeprincipal)
            ->setLimit($limit)
            ->setOffset($offset)
            ->setTypes($types)
            ->setSortBy(VoiceSortBy::DATE_DESC());
        $this->assertSame($query, $req->getQuery());
        $this->assertSame($storeprincipal, $req->getStorePrincipal());
        $this->assertSame($limit, $req->getLimit());
        $this->assertSame($offset, $req->getOffset());
        $this->assertSame($types, $req->getTypes());
        $this->assertTrue($req->getSortBy()->is('dateDesc'));

        $xml = '<?xml version="1.0"?>'."\n"
            .'<SearchVoiceRequest query="' . $query . '" limit="' . $limit . '" offset="' . $offset . '" types="' . $types . '" sortBy="' . VoiceSortBy::DATE_DESC() . '">'
                .'<storeprincipal id="' . $id . '" name="' . $name . '" accountNumber="' . $accountNumber . '" />'
            .'</SearchVoiceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'SearchVoiceRequest' => [
                '_jsns' => 'urn:zimbraVoice',
                'query' => $query,
                'limit' => $limit,
                'offset' => $offset,
                'types' => $types,
                'sortBy' => VoiceSortBy::DATE_DESC()->value(),
                'storeprincipal' => [
                    'id' => $id,
                    'name' => $name,
                    'accountNumber' => $accountNumber,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testUploadVoiceMail()
    {
        $id = self::randomName();
        $name = self::randomName();
        $accountNumber = self::randomName();
        $phone = self::randomName();
        $storeprincipal = new \Zimbra\Voice\Struct\StorePrincipalSpec(
            $id, $name, $accountNumber
        );
        $vm = new \Zimbra\Voice\Struct\VoiceMsgUploadSpec(
            $id, $phone
        );

        $req = new \Zimbra\Voice\Request\UploadVoiceMail(
            $storeprincipal, $vm
        );
        $this->assertInstanceOf('Zimbra\Voice\Request\Base', $req);
        $this->assertSame($storeprincipal, $req->getStorePrincipal());
        $this->assertSame($vm, $req->getVoiceMsg());
        $req->setStorePrincipal($storeprincipal)
            ->setVoiceMsg($vm);
        $this->assertSame($storeprincipal, $req->getStorePrincipal());
        $this->assertSame($vm, $req->getVoiceMsg());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<UploadVoiceMailRequest>'
                .'<storeprincipal id="' . $id . '" name="' . $name . '" accountNumber="' . $accountNumber . '" />'
                .'<vm id="' . $id . '" phone="' . $phone . '" />'
            .'</UploadVoiceMailRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'UploadVoiceMailRequest' => [
                '_jsns' => 'urn:zimbraVoice',
                'storeprincipal' => [
                    'id' => $id,
                    'name' => $name,
                    'accountNumber' => $accountNumber,
                ],
                'vm' => [
                    'id' => $id,
                    'phone' => $phone,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testVoiceMsgAction()
    {
        $id = self::randomName();
        $name = self::randomName();
        $accountNumber = self::randomName();
        $phone = self::randomName();
        $folderId = self::randomName();
        $action = new \Zimbra\Voice\Struct\VoiceMsgActionSpec(
            VoiceMsgActionOp::MOVE(), $phone, $id, $folderId
        );
        $storeprincipal = new \Zimbra\Voice\Struct\StorePrincipalSpec(
            $id, $name, $accountNumber
        );

        $req = new \Zimbra\Voice\Request\VoiceMsgAction(
            $action, $storeprincipal
        );
        $this->assertInstanceOf('Zimbra\Voice\Request\Base', $req);
        $this->assertSame($storeprincipal, $req->getStorePrincipal());
        $this->assertSame($action, $req->getAction());
        $req->setStorePrincipal($storeprincipal)
            ->setAction($action);
        $this->assertSame($storeprincipal, $req->getStorePrincipal());
        $this->assertSame($action, $req->getAction());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<VoiceMsgActionRequest>'
                .'<storeprincipal id="' . $id . '" name="' . $name . '" accountNumber="' . $accountNumber . '" />'
                .'<action op="' . VoiceMsgActionOp::MOVE() . '" phone="' . $phone . '" id="' . $id . '" l="' . $folderId . '" />'
            .'</VoiceMsgActionRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'VoiceMsgActionRequest' => [
                '_jsns' => 'urn:zimbraVoice',
                'storeprincipal' => [
                    'id' => $id,
                    'name' => $name,
                    'accountNumber' => $accountNumber,
                ],
                'action' => [
                    'op' => VoiceMsgActionOp::MOVE()->value(),
                    'phone' => $phone,
                    'id' => $id,
                    'l' => $folderId,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }
}
