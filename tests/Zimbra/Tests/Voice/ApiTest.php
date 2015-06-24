<?php

namespace Zimbra\Tests\Voice;

use Zimbra\Enum\VoiceMsgActionOp;
use Zimbra\Enum\VoiceSortBy;

use Zimbra\Tests\ZimbraTestCase;
use Zimbra\Tests\Soap\LocalClientWsdl;
use Zimbra\Tests\Soap\LocalClientHttp;
use Zimbra\Voice\Base as VoiceBase;
use Zimbra\Voice\VoiceFactory;

/**
 * Api test case class for voice api.
 */
class ApiTest extends ZimbraTestCase
{
    private $_api;

    public function __construct()
    {
        parent::__construct();
        $this->_api = new LocalVoiceHttp(null);
    }

    public function testVoiceFactory()
    {
        $httpApi = VoiceFactory::instance();
        $this->assertInstanceOf('\Zimbra\Account\Base', $httpApi);
        $this->assertInstanceOf('\Zimbra\Voice\Base', $httpApi);
        $this->assertInstanceOf('\Zimbra\Voice\Http', $httpApi);
    }

    public function testChangeUCPassword()
    {
        $password = self::randomName();
        $this->_api->changeUCPassword(
            $password
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraVoice">'
                .'<env:Body>'
                    .'<urn1:ChangeUCPasswordRequest '
                        .'password="' . $password . '" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetUCInfo()
    {
        $this->_api->getUCInfo();

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraVoice">'
                .'<env:Body>'
                    .'<urn1:GetUCInfoRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
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

        $this->_api->getVoiceFeatures(
            $storeprincipal, $phone
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraVoice">'
                .'<env:Body>'
                    .'<urn1:GetVoiceFeaturesRequest>'
                        .'<urn1:storeprincipal id="' . $id . '" name="' . $name . '" accountNumber="' . $accountNumber . '" />'
                        .'<urn1:phone name="' . $name . '">'
                            .'<urn1:voicemailprefs>'
                                .'<urn1:pref name="' . $name . '" />'
                            .'</urn1:voicemailprefs>'
                            .'<urn1:anoncallrejection />'
                            .'<urn1:calleridblocking />'
                            .'<urn1:callforward />'
                            .'<urn1:callforwardbusyline />'
                            .'<urn1:callforwardnoanswer />'
                            .'<urn1:callwaiting />'
                            .'<urn1:selectivecallforward />'
                            .'<urn1:selectivecallacceptance />'
                            .'<urn1:selectivecallrejection />'
                        .'</urn1:phone>'
                    .'</urn1:GetVoiceFeaturesRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
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

        $this->_api->getVoiceFolder($storeprincipal, array($phone));

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraVoice">'
                .'<env:Body>'
                    .'<urn1:GetVoiceFolderRequest>'
                        .'<urn1:storeprincipal id="' . $id . '" name="' . $name . '" accountNumber="' . $accountNumber . '" />'
                        .'<urn1:phone name="' . $name . '">'
                            .'<urn1:pref name="' . $name . '" />'
                        .'</urn1:phone>'
                    .'</urn1:GetVoiceFolderRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetVoiceInfo()
    {
        $name = self::randomName();
        $pref = new \Zimbra\Voice\Struct\PrefSpec($name);
        $phone = new \Zimbra\Voice\Struct\PhoneSpec($name, [$pref]);

        $this->_api->getVoiceInfo(array($phone));

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraVoice">'
                .'<env:Body>'
                    .'<urn1:GetVoiceInfoRequest>'
                        .'<urn1:phone name="' . $name . '">'
                            .'<urn1:pref name="' . $name . '" />'
                        .'</urn1:phone>'
                    .'</urn1:GetVoiceInfoRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
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

        $this->_api->getVoiceMailPrefs($storeprincipal, $phone);

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraVoice">'
                .'<env:Body>'
                    .'<urn1:GetVoiceMailPrefsRequest>'
                        .'<urn1:storeprincipal id="' . $id . '" name="' . $name . '" accountNumber="' . $accountNumber . '" />'
                        .'<urn1:phone name="' . $name . '">'
                            .'<urn1:pref name="' . $name . '" />'
                        .'</urn1:phone>'
                    .'</urn1:GetVoiceMailPrefsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
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

        $this->_api->modifyFromNum($storeprincipal, $phone);

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraVoice">'
                .'<env:Body>'
                    .'<urn1:ModifyFromNumRequest>'
                        .'<urn1:storeprincipal id="' . $id . '" name="' . $name . '" accountNumber="' . $accountNumber . '" />'
                        .'<urn1:phone oldPhone="' . $oldPhone . '" phone="' . $newPhone . '" id="' . $id . '" label="' . $label . '" />'
                    .'</urn1:ModifyFromNumRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
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

        $this->_api->modifyVoiceFeatures($storeprincipal, $phone);

        $client = $this->_api->client();
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

        $this->_api->modifyVoiceMailPin($storeprincipal, $phone);

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraVoice">'
                .'<env:Body>'
                    .'<urn1:ModifyVoiceMailPinRequest>'
                        .'<urn1:storeprincipal id="' . $id . '" name="' . $name . '" accountNumber="' . $accountNumber . '" />'
                        .'<urn1:phone oldPin="' . $oldPin . '" pin="' . $pin . '" name="' . $name . '" />'
                    .'</urn1:ModifyVoiceMailPinRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
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

        $this->_api->modifyVoiceMailPrefs($storeprincipal, $phone);

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraVoice">'
                .'<env:Body>'
                    .'<urn1:ModifyVoiceMailPrefsRequest>'
                        .'<urn1:storeprincipal id="' . $id . '" name="' . $name . '" accountNumber="' . $accountNumber . '" />'
                        .'<urn1:phone name="' . $name . '">'
                            .'<urn1:pref name="' . $name . '">' . $value . '</urn1:pref>'
                        .'</urn1:phone>'
                    .'</urn1:ModifyVoiceMailPrefsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
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

        $this->_api->resetVoiceFeatures(
            $storeprincipal, $phone
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraVoice">'
                .'<env:Body>'
                    .'<urn1:ResetVoiceFeaturesRequest>'
                        .'<urn1:storeprincipal id="' . $id . '" name="' . $name . '" accountNumber="' . $accountNumber . '" />'
                        .'<urn1:phone name="' . $name . '">'
                            .'<urn1:anoncallrejection />'
                            .'<urn1:calleridblocking />'
                            .'<urn1:callforward />'
                            .'<urn1:callforwardbusyline />'
                            .'<urn1:callforwardnoanswer />'
                            .'<urn1:callwaiting />'
                            .'<urn1:selectivecallforward />'
                            .'<urn1:selectivecallacceptance />'
                            .'<urn1:selectivecallrejection />'
                        .'</urn1:phone>'
                    .'</urn1:ResetVoiceFeaturesRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
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

        $this->_api->searchVoice(
            $query, $storeprincipal, $limit, $offset, $types, VoiceSortBy::DATE_DESC()
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraVoice">'
                .'<env:Body>'
                    .'<urn1:SearchVoiceRequest query="' . $query . '" limit="' . $limit . '" offset="' . $offset . '" types="' . $types . '" sortBy="' . VoiceSortBy::DATE_DESC() . '">'
                        .'<urn1:storeprincipal id="' . $id . '" name="' . $name . '" accountNumber="' . $accountNumber . '" />'
                    .'</urn1:SearchVoiceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
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

        $this->_api->uploadVoiceMail($storeprincipal, $vm);

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraVoice">'
                .'<env:Body>'
                    .'<urn1:UploadVoiceMailRequest>'
                        .'<urn1:storeprincipal id="' . $id . '" name="' . $name . '" accountNumber="' . $accountNumber . '" />'
                        .'<urn1:vm id="' . $id . '" phone="' . $phone . '" />'
                    .'</urn1:UploadVoiceMailRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
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

        $this->_api->voiceMsgAction($action, $storeprincipal);

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraVoice">'
                .'<env:Body>'
                    .'<urn1:VoiceMsgActionRequest>'
                        .'<urn1:storeprincipal id="' . $id . '" name="' . $name . '" accountNumber="' . $accountNumber . '" />'
                        .'<urn1:action op="' . VoiceMsgActionOp::MOVE() . '" phone="' . $phone . '" id="' . $id . '" l="' . $folderId . '" />'
                    .'</urn1:VoiceMsgActionRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}

class LocalVoiceWsdl extends VoiceBase
{
    public function __construct($location)
    {
        parent::__construct($location);
        $this->_client = new LocalClientWsdl($this->_location);
    }
}

class LocalVoiceHttp extends VoiceBase
{
    public function __construct($location)
    {
        parent::__construct($location);
        $this->_client = new LocalClientHttp($this->_location);
    }
}
