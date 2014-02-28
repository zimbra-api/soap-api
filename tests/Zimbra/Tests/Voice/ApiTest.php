<?php

namespace Zimbra\Tests\Voice;

use Zimbra\Enum\VoiceMsgActionOp;
use Zimbra\Enum\VoiceSortBy;

use Zimbra\Voice\VoiceFactory;

use Zimbra\Tests\ZimbraTestCase;
use Zimbra\Tests\Soap\LocalClientWsdl;
use Zimbra\Tests\Soap\LocalClientHttp;
use Zimbra\Voice\Base as VoiceBase;

/**
 * Api test case class for voice api.
 */
class ApiTest extends ZimbraTestCase
{
    public function testVoiceFactory()
    {
        $httpApi = VoiceFactory::instance();
        $this->assertInstanceOf('\Zimbra\Account\Base', $httpApi);
        $this->assertInstanceOf('\Zimbra\Voice\Base', $httpApi);
        $this->assertInstanceOf('\Zimbra\Voice\Http', $httpApi);

        $httpApi = VoiceFactory::instance(__DIR__.'/../TestData/ZimbraService.wsdl', 'wsdl');
        $this->assertInstanceOf('\Zimbra\Account\Base', $httpApi);
        $this->assertInstanceOf('\Zimbra\Voice\Base', $httpApi);
        $this->assertInstanceOf('\Zimbra\Voice\Wsdl', $httpApi);
    }

    public function testChangeUCPassword()
    {
        $api = new LocalVoiceWsdl(__DIR__.'/../TestData/ZimbraService.wsdl');
        $api->changeUCPassword(
            'password'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraVoice">'
                .'<env:Body>'
                    .'<ns1:ChangeUCPasswordRequest '
                        .'password="password" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalVoiceHttp(null);
        $api->changeUCPassword(
            'password'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraVoice">'
                .'<env:Body>'
                    .'<urn1:ChangeUCPasswordRequest '
                        .'password="password" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetUCInfo()
    {
        $api = new LocalVoiceWsdl(__DIR__.'/../TestData/ZimbraService.wsdl');
        $api->getUCInfo();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraVoice">'
                .'<env:Body>'
                    .'<ns1:GetUCInfoRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalVoiceHttp(null);
        $api->getUCInfo();

        $client = $api->client();
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

        $storeprincipal = new \Zimbra\Voice\Struct\StorePrincipalSpec(
            'id', 'name', 'accountNumber'
        );
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

        $api = new LocalVoiceWsdl(__DIR__.'/../TestData/ZimbraService.wsdl');
        $api->getVoiceFeatures(
            $storeprincipal, $phone
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraVoice">'
                .'<env:Body>'
                    .'<ns1:GetVoiceFeaturesRequest>'
                        .'<ns1:storeprincipal id="id" name="name" accountNumber="accountNumber" />'
                        .'<ns1:phone name="name">'
                            .'<ns1:voicemailprefs>'
                                .'<ns1:pref name="name" />'
                            .'</ns1:voicemailprefs>'
                            .'<ns1:anoncallrejection />'
                            .'<ns1:calleridblocking />'
                            .'<ns1:callforward />'
                            .'<ns1:callforwardbusyline />'
                            .'<ns1:callforwardnoanswer />'
                            .'<ns1:callwaiting />'
                            .'<ns1:selectivecallforward />'
                            .'<ns1:selectivecallacceptance />'
                            .'<ns1:selectivecallrejection />'
                        .'</ns1:phone>'
                    .'</ns1:GetVoiceFeaturesRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalVoiceHttp(null);
        $api->getVoiceFeatures(
            $storeprincipal, $phone
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraVoice">'
                .'<env:Body>'
                    .'<urn1:GetVoiceFeaturesRequest>'
                        .'<urn1:storeprincipal id="id" name="name" accountNumber="accountNumber" />'
                        .'<urn1:phone name="name">'
                            .'<urn1:voicemailprefs>'
                                .'<urn1:pref name="name" />'
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
        $storeprincipal = new \Zimbra\Voice\Struct\StorePrincipalSpec(
            'id', 'name', 'accountNumber'
        );
        $pref = new \Zimbra\Voice\Struct\PrefSpec('name');
        $phone = new \Zimbra\Voice\Struct\PhoneSpec('name', array($pref));

        $api = new LocalVoiceWsdl(__DIR__.'/../TestData/ZimbraService.wsdl');
        $api->getVoiceFolder($storeprincipal, array($phone));

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraVoice">'
                .'<env:Body>'
                    .'<ns1:GetVoiceFolderRequest>'
                        .'<ns1:storeprincipal id="id" name="name" accountNumber="accountNumber" />'
                        .'<ns1:phone name="name">'
                            .'<ns1:pref name="name" />'
                        .'</ns1:phone>'
                    .'</ns1:GetVoiceFolderRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalVoiceHttp(null);
        $api->getVoiceFolder($storeprincipal, array($phone));

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraVoice">'
                .'<env:Body>'
                    .'<urn1:GetVoiceFolderRequest>'
                        .'<urn1:storeprincipal id="id" name="name" accountNumber="accountNumber" />'
                        .'<urn1:phone name="name">'
                            .'<urn1:pref name="name" />'
                        .'</urn1:phone>'
                    .'</urn1:GetVoiceFolderRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetVoiceInfo()
    {
        $pref = new \Zimbra\Voice\Struct\PrefSpec('name');
        $phone = new \Zimbra\Voice\Struct\PhoneSpec('name', array($pref));

        $api = new LocalVoiceWsdl(__DIR__.'/../TestData/ZimbraService.wsdl');
        $api->getVoiceInfo(array($phone));

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraVoice">'
                .'<env:Body>'
                    .'<ns1:GetVoiceInfoRequest>'
                        .'<ns1:phone name="name">'
                            .'<ns1:pref name="name" />'
                        .'</ns1:phone>'
                    .'</ns1:GetVoiceInfoRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalVoiceHttp(null);
        $api->getVoiceInfo(array($phone));

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraVoice">'
                .'<env:Body>'
                    .'<urn1:GetVoiceInfoRequest>'
                        .'<urn1:phone name="name">'
                            .'<urn1:pref name="name" />'
                        .'</urn1:phone>'
                    .'</urn1:GetVoiceInfoRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetVoiceMailPrefs()
    {
        $storeprincipal = new \Zimbra\Voice\Struct\StorePrincipalSpec(
            'id', 'name', 'accountNumber'
        );
        $pref = new \Zimbra\Voice\Struct\PrefSpec('name');
        $phone = new \Zimbra\Voice\Struct\PhoneSpec('name', array($pref));

        $api = new LocalVoiceWsdl(__DIR__.'/../TestData/ZimbraService.wsdl');
        $api->getVoiceMailPrefs($storeprincipal, $phone);

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraVoice">'
                .'<env:Body>'
                    .'<ns1:GetVoiceMailPrefsRequest>'
                        .'<ns1:storeprincipal id="id" name="name" accountNumber="accountNumber" />'
                        .'<ns1:phone name="name">'
                            .'<ns1:pref name="name" />'
                        .'</ns1:phone>'
                    .'</ns1:GetVoiceMailPrefsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalVoiceHttp(null);
        $api->getVoiceMailPrefs($storeprincipal, $phone);

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraVoice">'
                .'<env:Body>'
                    .'<urn1:GetVoiceMailPrefsRequest>'
                        .'<urn1:storeprincipal id="id" name="name" accountNumber="accountNumber" />'
                        .'<urn1:phone name="name">'
                            .'<urn1:pref name="name" />'
                        .'</urn1:phone>'
                    .'</urn1:GetVoiceMailPrefsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testModifyFromNum()
    {
        $storeprincipal = new \Zimbra\Voice\Struct\StorePrincipalSpec(
            'id', 'name', 'accountNumber'
        );
        $phone = new \Zimbra\Voice\Struct\ModifyFromNumSpec(
            'oldPhone', 'phone', 'id', 'label'
        );

        $api = new LocalVoiceWsdl(__DIR__.'/../TestData/ZimbraService.wsdl');
        $api->modifyFromNum($storeprincipal, $phone);

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraVoice">'
                .'<env:Body>'
                    .'<ns1:ModifyFromNumRequest>'
                        .'<ns1:storeprincipal id="id" name="name" accountNumber="accountNumber" />'
                        .'<ns1:phone oldPhone="oldPhone" phone="phone" id="id" label="label" />'
                    .'</ns1:ModifyFromNumRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalVoiceHttp(null);
        $api->modifyFromNum($storeprincipal, $phone);

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraVoice">'
                .'<env:Body>'
                    .'<urn1:ModifyFromNumRequest>'
                        .'<urn1:storeprincipal id="id" name="name" accountNumber="accountNumber" />'
                        .'<urn1:phone oldPhone="oldPhone" phone="phone" id="id" label="label" />'
                    .'</urn1:ModifyFromNumRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testModifyVoiceFeatures()
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

        $storeprincipal = new \Zimbra\Voice\Struct\StorePrincipalSpec(
            'id', 'name', 'accountNumber'
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

        $api = new LocalVoiceWsdl(__DIR__.'/../TestData/ZimbraService.wsdl');
        $api->modifyVoiceFeatures($storeprincipal, $phone);

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraVoice">'
                .'<env:Body>'
                    .'<ns1:ModifyVoiceFeaturesRequest>'
                        .'<ns1:storeprincipal id="id" name="name" accountNumber="accountNumber" />'
                        .'<ns1:phone name="name">'
                            .'<ns1:voicemailprefs s="1" a="">'
                                .'<ns1:pref name="name">value</ns1:pref>'
                            .'</ns1:voicemailprefs>'
                            .'<ns1:anoncallrejection s="1" a="" />'
                            .'<ns1:calleridblocking s="1" a="" />'
                            .'<ns1:callforward s="1" a="" ft="ft" />'
                            .'<ns1:callforwardbusyline s="1" a="" ft="ft" />'
                            .'<ns1:callforwardnoanswer s="1" a="" ft="ft" nr="nr" />'
                            .'<ns1:callwaiting s="1" a="" />'
                            .'<ns1:selectivecallforward s="1" a="" ft="ft">'
                                .'<ns1:phone pn="pn" a="1" />'
                            .'</ns1:selectivecallforward>'
                            .'<ns1:selectivecallacceptance s="1" a="">'
                                .'<ns1:phone pn="pn" a="1" />'
                            .'</ns1:selectivecallacceptance>'
                            .'<ns1:selectivecallrejection s="1" a="">'
                                .'<ns1:phone pn="pn" a="1" />'
                            .'</ns1:selectivecallrejection>'
                        .'</ns1:phone>'
                    .'</ns1:ModifyVoiceFeaturesRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalVoiceHttp(null);
        $api->modifyVoiceFeatures($storeprincipal, $phone);

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraVoice">'
                .'<env:Body>'
                    .'<urn1:ModifyVoiceFeaturesRequest>'
                        .'<urn1:storeprincipal id="id" name="name" accountNumber="accountNumber" />'
                        .'<urn1:phone name="name">'
                            .'<urn1:voicemailprefs s="true" a="false">'
                                .'<urn1:pref name="name">value</urn1:pref>'
                            .'</urn1:voicemailprefs>'
                            .'<urn1:anoncallrejection s="true" a="false" />'
                            .'<urn1:calleridblocking s="true" a="false" />'
                            .'<urn1:callforward s="true" a="false" ft="ft" />'
                            .'<urn1:callforwardbusyline s="true" a="false" ft="ft" />'
                            .'<urn1:callforwardnoanswer s="true" a="false" ft="ft" nr="nr" />'
                            .'<urn1:callwaiting s="true" a="false" />'
                            .'<urn1:selectivecallforward s="true" a="false" ft="ft">'
                                .'<urn1:phone pn="pn" a="true" />'
                            .'</urn1:selectivecallforward>'
                            .'<urn1:selectivecallacceptance s="true" a="false">'
                                .'<urn1:phone pn="pn" a="true" />'
                            .'</urn1:selectivecallacceptance>'
                            .'<urn1:selectivecallrejection s="true" a="false">'
                                .'<urn1:phone pn="pn" a="true" />'
                            .'</urn1:selectivecallrejection>'
                        .'</urn1:phone>'
                    .'</urn1:ModifyVoiceFeaturesRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testModifyVoiceMailPin()
    {
        $storeprincipal = new \Zimbra\Voice\Struct\StorePrincipalSpec(
            'id', 'name', 'accountNumber'
        );
        $phone = new \Zimbra\Voice\Struct\ModifyVoiceMailPinSpec(
            'oldPin', 'pin', 'name'
        );

        $api = new LocalVoiceWsdl(__DIR__.'/../TestData/ZimbraService.wsdl');
        $api->modifyVoiceMailPin($storeprincipal, $phone);

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraVoice">'
                .'<env:Body>'
                    .'<ns1:ModifyVoiceMailPinRequest>'
                        .'<ns1:storeprincipal id="id" name="name" accountNumber="accountNumber" />'
                        .'<ns1:phone oldPin="oldPin" pin="pin" name="name" />'
                    .'</ns1:ModifyVoiceMailPinRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalVoiceHttp(null);
        $api->modifyVoiceMailPin($storeprincipal, $phone);

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraVoice">'
                .'<env:Body>'
                    .'<urn1:ModifyVoiceMailPinRequest>'
                        .'<urn1:storeprincipal id="id" name="name" accountNumber="accountNumber" />'
                        .'<urn1:phone oldPin="oldPin" pin="pin" name="name" />'
                    .'</urn1:ModifyVoiceMailPinRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testModifyVoiceMailPrefs()
    {
        $storeprincipal = new \Zimbra\Voice\Struct\StorePrincipalSpec(
            'id', 'name', 'accountNumber'
        );
        $pref = new \Zimbra\Voice\Struct\PrefInfo('name', 'value');
        $phone = new \Zimbra\Voice\Struct\PhoneInfo('name', array($pref));

        $api = new LocalVoiceWsdl(__DIR__.'/../TestData/ZimbraService.wsdl');
        $api->modifyVoiceMailPrefs($storeprincipal, $phone);

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraVoice">'
                .'<env:Body>'
                    .'<ns1:ModifyVoiceMailPrefsRequest>'
                        .'<ns1:storeprincipal id="id" name="name" accountNumber="accountNumber" />'
                        .'<ns1:phone name="name">'
                            .'<ns1:pref name="name">value</ns1:pref>'
                        .'</ns1:phone>'
                    .'</ns1:ModifyVoiceMailPrefsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalVoiceHttp(null);
        $api->modifyVoiceMailPrefs($storeprincipal, $phone);

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraVoice">'
                .'<env:Body>'
                    .'<urn1:ModifyVoiceMailPrefsRequest>'
                        .'<urn1:storeprincipal id="id" name="name" accountNumber="accountNumber" />'
                        .'<urn1:phone name="name">'
                            .'<urn1:pref name="name">value</urn1:pref>'
                        .'</urn1:phone>'
                    .'</urn1:ModifyVoiceMailPrefsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testResetVoiceFeatures()
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

        $storeprincipal = new \Zimbra\Voice\Struct\StorePrincipalSpec(
            'id', 'name', 'accountNumber'
        );
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

        $api = new LocalVoiceWsdl(__DIR__.'/../TestData/ZimbraService.wsdl');
        $api->resetVoiceFeatures(
            $storeprincipal, $phone
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraVoice">'
                .'<env:Body>'
                    .'<ns1:ResetVoiceFeaturesRequest>'
                        .'<ns1:storeprincipal id="id" name="name" accountNumber="accountNumber" />'
                        .'<ns1:phone name="name">'
                            .'<ns1:anoncallrejection />'
                            .'<ns1:calleridblocking />'
                            .'<ns1:callforward />'
                            .'<ns1:callforwardbusyline />'
                            .'<ns1:callforwardnoanswer />'
                            .'<ns1:callwaiting />'
                            .'<ns1:selectivecallforward />'
                            .'<ns1:selectivecallacceptance />'
                            .'<ns1:selectivecallrejection />'
                        .'</ns1:phone>'
                    .'</ns1:ResetVoiceFeaturesRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalVoiceHttp(null);
        $api->resetVoiceFeatures(
            $storeprincipal, $phone
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraVoice">'
                .'<env:Body>'
                    .'<urn1:ResetVoiceFeaturesRequest>'
                        .'<urn1:storeprincipal id="id" name="name" accountNumber="accountNumber" />'
                        .'<urn1:phone name="name">'
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
        $storeprincipal = new \Zimbra\Voice\Struct\StorePrincipalSpec(
            'id', 'name', 'accountNumber'
        );

        $api = new LocalVoiceWsdl(__DIR__.'/../TestData/ZimbraService.wsdl');
        $api->searchVoice('query', $storeprincipal, 100, 100, 'types', VoiceSortBy::DATE_DESC());

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraVoice">'
                .'<env:Body>'
                    .'<ns1:SearchVoiceRequest query="query" limit="100" offset="100" types="types" sortBy="dateDesc">'
                        .'<ns1:storeprincipal id="id" name="name" accountNumber="accountNumber" />'
                    .'</ns1:SearchVoiceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalVoiceHttp(null);
        $api->searchVoice('query', $storeprincipal, 100, 100, 'types', VoiceSortBy::DATE_DESC());

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraVoice">'
                .'<env:Body>'
                    .'<urn1:SearchVoiceRequest query="query" limit="100" offset="100" types="types" sortBy="dateDesc">'
                        .'<urn1:storeprincipal id="id" name="name" accountNumber="accountNumber" />'
                    .'</urn1:SearchVoiceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testUploadVoiceMail()
    {
        $storeprincipal = new \Zimbra\Voice\Struct\StorePrincipalSpec(
            'id', 'name', 'accountNumber'
        );
        $vm = new \Zimbra\Voice\Struct\VoiceMsgUploadSpec(
            'id', 'phone'
        );

        $api = new LocalVoiceWsdl(__DIR__.'/../TestData/ZimbraService.wsdl');
        $api->uploadVoiceMail($storeprincipal, $vm);

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraVoice">'
                .'<env:Body>'
                    .'<ns1:UploadVoiceMailRequest>'
                        .'<ns1:storeprincipal id="id" name="name" accountNumber="accountNumber" />'
                        .'<ns1:vm id="id" phone="phone" />'
                    .'</ns1:UploadVoiceMailRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalVoiceHttp(null);
        $api->uploadVoiceMail($storeprincipal, $vm);

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraVoice">'
                .'<env:Body>'
                    .'<urn1:UploadVoiceMailRequest>'
                        .'<urn1:storeprincipal id="id" name="name" accountNumber="accountNumber" />'
                        .'<urn1:vm id="id" phone="phone" />'
                    .'</urn1:UploadVoiceMailRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testVoiceMsgAction()
    {
        $action = new \Zimbra\Voice\Struct\VoiceMsgActionSpec(
            VoiceMsgActionOp::MOVE(), 'phone', 'id', 'l'
        );
        $storeprincipal = new \Zimbra\Voice\Struct\StorePrincipalSpec(
            'id', 'name', 'accountNumber'
        );

        $api = new LocalVoiceWsdl(__DIR__.'/../TestData/ZimbraService.wsdl');
        $api->voiceMsgAction($action, $storeprincipal);

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraVoice">'
                .'<env:Body>'
                    .'<ns1:VoiceMsgActionRequest>'
                        .'<ns1:storeprincipal id="id" name="name" accountNumber="accountNumber" />'
                        .'<ns1:action op="move" phone="phone" id="id" l="l" />'
                    .'</ns1:VoiceMsgActionRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalVoiceHttp(null);
        $api->voiceMsgAction($action, $storeprincipal);

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraVoice">'
                .'<env:Body>'
                    .'<urn1:VoiceMsgActionRequest>'
                        .'<urn1:storeprincipal id="id" name="name" accountNumber="accountNumber" />'
                        .'<urn1:action op="move" phone="phone" id="id" l="l" />'
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
