<?php

namespace Zimbra\Tests\Account;

use Zimbra\Tests\ZimbraTestCase;

use Zimbra\Account\AccountFactory;

use Zimbra\Enum\AccountBy;
use Zimbra\Enum\AceRightType;
use Zimbra\Enum\ConditionOperator as CondOp;
use Zimbra\Enum\ContentType;
use Zimbra\Enum\DistributionListBy as DLBy;
use Zimbra\Enum\DistributionListGranteeBy as DLGranteeBy;
use Zimbra\Enum\DistributionListSubscribeOp as DLSubscribeOp;
use Zimbra\Enum\GalSearchType as SearchType;
use Zimbra\Enum\GranteeType;
use Zimbra\Enum\MemberOfSelector as MemberOf;
use Zimbra\Enum\Operation;
use Zimbra\Enum\SortBy;
use Zimbra\Enum\TargetType;
use Zimbra\Enum\TargetBy;
use Zimbra\Enum\ZimletStatus;

use Zimbra\Tests\Soap\LocalClientWsdl;
use Zimbra\Tests\Soap\LocalClientHttp;
use Zimbra\Account\Base as AccountBase;

/**
 * Api test case class for account request.
 */
class ApiTest extends ZimbraTestCase
{
    public function testAccountFactory()
    {
        $httpApi = AccountFactory::instance();
        $this->assertInstanceOf('\Zimbra\Account\Base', $httpApi);
        $this->assertInstanceOf('\Zimbra\Account\Http', $httpApi);

        $httpApi = AccountFactory::instance(__DIR__.'/../TestData/ZimbraUserService.wsdl', 'wsdl');
        $this->assertInstanceOf('\Zimbra\Account\Base', $httpApi);
        $this->assertInstanceOf('\Zimbra\Account\Wsdl', $httpApi);
    }

    public function testAuth()
    {
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), 'value');
        $preauth = new \Zimbra\Account\Struct\PreAuth(1000, 'value', 1000);
        $authToken = new \Zimbra\Account\Struct\AuthToken('value', true);

        $attr = new \Zimbra\Account\Struct\Attr('name', 'value', true);
        $attrs = new \Zimbra\Account\Struct\AuthAttrs(array($attr));

        $pref = new \Zimbra\Account\Struct\Pref('name', 'value', 1000);
        $prefs = new \Zimbra\Account\Struct\AuthPrefs(array($pref));

        $api = new LocalAccountWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->auth(
            $account, 'password', $preauth, $authToken, 'virtualHost',
            $prefs, $attrs, 'requestedSkin', false
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<ns1:AuthRequest persistAuthTokenCookie="false">'
                        .'<ns1:account by="name">value</ns1:account>'
                        .'<ns1:password>password</ns1:password>'
                        .'<ns1:preauth timestamp="1000" expiresTimestamp="1000">value</ns1:preauth>'
                        .'<ns1:authToken verifyAccount="true">value</ns1:authToken>'
                        .'<ns1:virtualHost>virtualHost</ns1:virtualHost>'
                        .'<ns1:prefs>'
                            .'<ns1:pref name="name" modified="1000">value</ns1:pref>'
                        .'</ns1:prefs>'
                        .'<ns1:attrs>'
                            .'<ns1:attr name="name" pd="true">value</ns1:attr>'
                        .'</ns1:attrs>'
                        .'<ns1:requestedSkin>requestedSkin</ns1:requestedSkin>'
                    .'</ns1:AuthRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAccountHttp(null);
        $api->auth(
            $account, 'password', $preauth, $authToken, 'virtualHost',
            $prefs, $attrs, 'requestedSkin', false
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<urn1:AuthRequest persistAuthTokenCookie="false">'
                        .'<urn1:account by="name">value</urn1:account>'
                        .'<urn1:password>password</urn1:password>'
                        .'<urn1:preauth timestamp="1000" expiresTimestamp="1000">value</urn1:preauth>'
                        .'<urn1:authToken verifyAccount="true">value</urn1:authToken>'
                        .'<urn1:virtualHost>virtualHost</urn1:virtualHost>'
                        .'<urn1:prefs>'
                            .'<urn1:pref name="name" modified="1000">value</urn1:pref>'
                        .'</urn1:prefs>'
                        .'<urn1:attrs>'
                            .'<urn1:attr name="name" pd="true">value</urn1:attr>'
                        .'</urn1:attrs>'
                        .'<urn1:requestedSkin>requestedSkin</urn1:requestedSkin>'
                    .'</urn1:AuthRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testAuthByAcount()
    {
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), 'value');
        $api = new LocalAccountWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->authByAcount(
            $account, 'password', 'virtualHost'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<ns1:AuthRequest>'
                        .'<ns1:account by="name">value</ns1:account>'
                        .'<ns1:password>password</ns1:password>'
                        .'<ns1:virtualHost>virtualHost</ns1:virtualHost>'
                        .'<ns1:prefs />'
                        .'<ns1:attrs />'
                    .'</ns1:AuthRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAccountHttp(null);
        $api->authByAcount(
            $account, 'password', 'virtualHost'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<urn1:AuthRequest>'
                        .'<urn1:account by="name">value</urn1:account>'
                        .'<urn1:password>password</urn1:password>'
                        .'<urn1:virtualHost>virtualHost</urn1:virtualHost>'
                        .'<urn1:prefs />'
                        .'<urn1:attrs />'
                    .'</urn1:AuthRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testAuthByToken()
    {
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), 'value');
        $authToken = new \Zimbra\Account\Struct\AuthToken('value', true);

        $api = new LocalAccountWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->authByToken(
            $account, $authToken, 'virtualHost'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<ns1:AuthRequest>'
                        .'<ns1:account by="name">value</ns1:account>'
                        .'<ns1:authToken verifyAccount="true">value</ns1:authToken>'
                        .'<ns1:virtualHost>virtualHost</ns1:virtualHost>'
                        .'<ns1:prefs />'
                        .'<ns1:attrs />'
                    .'</ns1:AuthRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAccountHttp(null);
        $api->authByToken(
            $account, $authToken, 'virtualHost'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<urn1:AuthRequest>'
                        .'<urn1:account by="name">value</urn1:account>'
                        .'<urn1:authToken verifyAccount="true">value</urn1:authToken>'
                        .'<urn1:virtualHost>virtualHost</urn1:virtualHost>'
                        .'<urn1:prefs />'
                        .'<urn1:attrs />'
                    .'</urn1:AuthRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testAutoCompleteGal()
    {
        $api = new LocalAccountWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->autoCompleteGal(
            'name', true, SearchType::ALL(), 'galAcctId', 10
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<ns1:AutoCompleteGalRequest '
                        .'needExp="true" name="name" type="all" galAcctId="galAcctId" limit="10" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAccountHttp(null);
        $api->autoCompleteGal(
            'name', true, SearchType::ALL(), 'galAcctId', 10
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<urn1:AutoCompleteGalRequest '
                        .'needExp="true" name="name" type="all" galAcctId="galAcctId" limit="10" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testChangePassword()
    {
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), 'value');
        $api = new LocalAccountWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->changePassword(
            $account, 'oldPassword', 'password', 'virtualHost'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<ns1:ChangePasswordRequest>'
                        .'<ns1:account by="name">value</ns1:account>'
                        .'<ns1:oldPassword>oldPassword</ns1:oldPassword>'
                        .'<ns1:password>password</ns1:password>'
                        .'<ns1:virtualHost>virtualHost</ns1:virtualHost>'
                    .'</ns1:ChangePasswordRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAccountHttp(null);
        $api->changePassword(
            $account, 'oldPassword', 'password', 'virtualHost'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<urn1:ChangePasswordRequest>'
                        .'<urn1:account by="name">value</urn1:account>'
                        .'<urn1:oldPassword>oldPassword</urn1:oldPassword>'
                        .'<urn1:password>password</urn1:password>'
                        .'<urn1:virtualHost>virtualHost</urn1:virtualHost>'
                    .'</urn1:ChangePasswordRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCheckRights()
    {
        $target = new \Zimbra\Account\Struct\CheckRightsTargetSpec(
            TargetType::DOMAIN(), TargetBy::ID(), 'key', array('right1', 'right2')
        );
        $api = new LocalAccountWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->checkRights(
            array($target)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<ns1:CheckRightsRequest>'
                        .'<ns1:target type="domain" by="id" key="key">'
                            .'<ns1:right>right1</ns1:right>'
                            .'<ns1:right>right2</ns1:right>'
                        .'</ns1:target>'
                    .'</ns1:CheckRightsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAccountHttp(null);
        $api->checkRights(
            array($target)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<urn1:CheckRightsRequest>'
                        .'<urn1:target type="domain" by="id" key="key">'
                            .'<urn1:right>right1</urn1:right>'
                            .'<urn1:right>right2</urn1:right>'
                        .'</urn1:target>'
                    .'</urn1:CheckRightsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCreateDistributionList()
    {
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');
        $api = new LocalAccountWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->createDistributionList(
            'name', true, array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<ns1:CreateDistributionListRequest name="name" dynamic="true">'
                        .'<ns1:a n="key">value</ns1:a>'
                    .'</ns1:CreateDistributionListRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAccountHttp(null);
        $api->createDistributionList(
            'name', true, array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<urn1:CreateDistributionListRequest name="name" dynamic="true">'
                        .'<urn1:a n="key">value</urn1:a>'
                    .'</urn1:CreateDistributionListRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCreateIdentity()
    {
        $attr = new \Zimbra\Account\Struct\Attr('name', 'value', true);
        $identity = new \Zimbra\Account\Struct\Identity('name', 'id', array($attr));

        $api = new LocalAccountWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->createIdentity(
            $identity
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<ns1:CreateIdentityRequest>'
                        .'<ns1:identity name="name" id="id">'
                            .'<ns1:a name="name" pd="true">value</ns1:a>'
                        .'</ns1:identity>'
                    .'</ns1:CreateIdentityRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAccountHttp(null);
        $api->createIdentity(
            $identity
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<urn1:CreateIdentityRequest>'
                        .'<urn1:identity name="name" id="id">'
                            .'<urn1:a name="name" pd="true">value</urn1:a>'
                        .'</urn1:identity>'
                    .'</urn1:CreateIdentityRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCreateSignature()
    {
        $content = new \Zimbra\Account\Struct\SignatureContent('value', ContentType::TEXT_PLAIN());
        $signature = new \Zimbra\Account\Struct\Signature('name', 'id', 'cid', array($content));

        $api = new LocalAccountWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->createSignature(
            $signature
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<ns1:CreateSignatureRequest>'
                        .'<ns1:signature id="id" name="name">'
                            .'<ns1:content type="text/plain">value</ns1:content>'
                            .'<ns1:cid>cid</ns1:cid>'
                        .'</ns1:signature>'
                    .'</ns1:CreateSignatureRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAccountHttp(null);
        $api->createSignature(
            $signature
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<urn1:CreateSignatureRequest>'
                        .'<urn1:signature id="id" name="name">'
                            .'<urn1:cid>cid</urn1:cid>'
                            .'<urn1:content type="text/plain">value</urn1:content>'
                        .'</urn1:signature>'
                    .'</urn1:CreateSignatureRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testDeleteIdentity()
    {
        $identity = new \Zimbra\Account\Struct\NameId('name', 'id');

        $api = new LocalAccountWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->deleteIdentity(
            $identity
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<ns1:DeleteIdentityRequest>'
                        .'<ns1:identity name="name" id="id" />'
                    .'</ns1:DeleteIdentityRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAccountHttp(null);
        $api->deleteIdentity(
            $identity
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<urn1:DeleteIdentityRequest>'
                        .'<urn1:identity name="name" id="id" />'
                    .'</urn1:DeleteIdentityRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testDeleteSignature()
    {
        $signature = new \Zimbra\Account\Struct\NameId('name', 'id');

        $api = new LocalAccountWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->deleteSignature(
            $signature
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<ns1:DeleteSignatureRequest>'
                        .'<ns1:signature name="name" id="id" />'
                    .'</ns1:DeleteSignatureRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAccountHttp(null);
        $api->deleteSignature(
            $signature
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<urn1:DeleteSignatureRequest>'
                        .'<urn1:signature name="name" id="id" />'
                    .'</urn1:DeleteSignatureRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testDiscoverRights()
    {
        $api = new LocalAccountWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->discoverRights(
            array('right1', 'right2', 'right3')
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<ns1:DiscoverRightsRequest>'
                        .'<ns1:right>right1</ns1:right>'
                        .'<ns1:right>right2</ns1:right>'
                        .'<ns1:right>right3</ns1:right>'
                    .'</ns1:DiscoverRightsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAccountHttp(null);
        $api->discoverRights(
            array('right1', 'right2', 'right3')
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<urn1:DiscoverRightsRequest>'
                        .'<urn1:right>right1</urn1:right>'
                        .'<urn1:right>right2</urn1:right>'
                        .'<urn1:right>right3</urn1:right>'
                    .'</urn1:DiscoverRightsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testDistributionListAction()
    {
        $subsReq = new \Zimbra\Account\Struct\DistributionListSubscribeReq(DLSubscribeOp::SUBSCRIBE(), 'value', true);
        $owner = new \Zimbra\Account\Struct\DistributionListGranteeSelector(GranteeType::USR(), DLGranteeBy::ID(), 'value');
        $grantee = new \Zimbra\Account\Struct\DistributionListGranteeSelector(GranteeType::ALL(), DLGranteeBy::NAME(), 'value');
        $right = new \Zimbra\Account\Struct\DistributionListRightSpec('right', array($grantee));
        $a = new \Zimbra\Struct\KeyValuePair('key', 'value');
        $action = new \Zimbra\Account\Struct\DistributionListAction(Operation::MODIFY(), 'newName', $subsReq, array('dlm'), array($owner), array($right), array($a));

        $dl = new \Zimbra\Account\Struct\DistributionListSelector(DLBy::NAME(), 'value');
        $attr = new \Zimbra\Account\Struct\Attr('name', 'value', true);

        $api = new LocalAccountWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->distributionListAction(
            $dl, $action, array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<ns1:DistributionListActionRequest>'
                        .'<ns1:a name="name" pd="true">value</ns1:a>'
                        .'<ns1:dl by="name">value</ns1:dl>'
                        .'<ns1:action op="modify">'
                            .'<ns1:a n="key">value</ns1:a>'
                            .'<ns1:dlm>dlm</ns1:dlm>'
                            .'<ns1:newName>newName</ns1:newName>'
                            .'<ns1:owner type="usr" by="id">value</ns1:owner>'
                            .'<ns1:right right="right">'
                                .'<ns1:grantee type="all" by="name">value</ns1:grantee>'
                            .'</ns1:right>'
                            .'<ns1:subsReq op="subscribe" bccOwners="true">value</ns1:subsReq>'
                        .'</ns1:action>'
                    .'</ns1:DistributionListActionRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAccountHttp(null);
        $api->distributionListAction(
            $dl, $action, array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<urn1:DistributionListActionRequest>'
                        .'<urn1:dl by="name">value</urn1:dl>'
                        .'<urn1:action op="modify">'
                            .'<urn1:newName>newName</urn1:newName>'
                            .'<urn1:subsReq op="subscribe" bccOwners="true">value</urn1:subsReq>'
                            .'<urn1:dlm>dlm</urn1:dlm>'
                            .'<urn1:owner type="usr" by="id">value</urn1:owner>'
                            .'<urn1:right right="right">'
                                .'<urn1:grantee type="all" by="name">value</urn1:grantee>'
                            .'</urn1:right>'
                            .'<urn1:a n="key">value</urn1:a>'
                        .'</urn1:action>'
                        .'<urn1:a name="name" pd="true">value</urn1:a>'
                    .'</urn1:DistributionListActionRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testEndSession()
    {
        $api = new LocalAccountWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->endSession();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<ns1:EndSessionRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAccountHttp(null);
        $api->endSession();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<urn1:EndSessionRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAccountDistributionLists()
    {
        $api = new LocalAccountWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->getAccountDistributionLists(true, MemberOf::DIRECT_ONLY(), 'attrs');

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<ns1:GetAccountDistributionListsRequest ownerOf="true" memberOf="directOnly" attrs="attrs" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAccountHttp(null);
        $api->getAccountDistributionLists(true, MemberOf::DIRECT_ONLY(), 'attrs');

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<urn1:GetAccountDistributionListsRequest ownerOf="true" memberOf="directOnly" attrs="attrs" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAccountInfo()
    {
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), 'value');

        $api = new LocalAccountWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->getAccountInfo($account);

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<ns1:GetAccountInfoRequest>'
                        .'<ns1:account by="name">value</ns1:account>'
                    .'</ns1:GetAccountInfoRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAccountHttp(null);
        $api->getAccountInfo($account);

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<urn1:GetAccountInfoRequest>'
                        .'<urn1:account by="name">value</urn1:account>'
                    .'</urn1:GetAccountInfoRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAllLocales()
    {
        $api = new LocalAccountWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->getAllLocales();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<ns1:GetAllLocalesRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAccountHttp(null);
        $api->getAllLocales();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<urn1:GetAllLocalesRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAvailableCsvFormats()
    {
        $api = new LocalAccountWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->getAvailableCsvFormats();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<ns1:GetAvailableCsvFormatsRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAccountHttp(null);
        $api->getAvailableCsvFormats();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<urn1:GetAvailableCsvFormatsRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAvailableLocales()
    {
        $api = new LocalAccountWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->getAvailableLocales();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<ns1:GetAvailableLocalesRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAccountHttp(null);
        $api->getAvailableLocales();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<urn1:GetAvailableLocalesRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAvailableSkins()
    {
        $api = new LocalAccountWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->getAvailableSkins();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<ns1:GetAvailableSkinsRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAccountHttp(null);
        $api->getAvailableSkins();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<urn1:GetAvailableSkinsRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetDistributionList()
    {
        $dl = new \Zimbra\Account\Struct\DistributionListSelector(DLBy::NAME(), 'value');
        $attr = new \Zimbra\Account\Struct\Attr('name', 'value', true);

        $api = new LocalAccountWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->getDistributionList($dl, true, 'sendToDistList', array($attr));

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<ns1:GetDistributionListRequest needOwners="true" needRights="sendToDistList">'
                        .'<ns1:a name="name" pd="true">value</ns1:a>'
                        .'<ns1:dl by="name">value</ns1:dl>'
                    .'</ns1:GetDistributionListRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAccountHttp(null);
        $api->getDistributionList($dl, true, 'sendToDistList', array($attr));

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<urn1:GetDistributionListRequest needOwners="true" needRights="sendToDistList">'
                        .'<urn1:dl by="name">value</urn1:dl>'
                        .'<urn1:a name="name" pd="true">value</urn1:a>'
                    .'</urn1:GetDistributionListRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetDistributionListMembers()
    {
        $api = new LocalAccountWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->getDistributionListMembers('name', 100, 100);

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<ns1:GetDistributionListMembersRequest limit="100" offset="100">'
                        .'<ns1:dl>name</ns1:dl>'
                    .'</ns1:GetDistributionListMembersRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAccountHttp(null);
        $api->getDistributionListMembers('name', 100, 100);

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<urn1:GetDistributionListMembersRequest limit="100" offset="100">'
                        .'<urn1:dl>name</urn1:dl>'
                    .'</urn1:GetDistributionListMembersRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetIdentities()
    {
        $api = new LocalAccountWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->getIdentities();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<ns1:GetIdentitiesRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAccountHttp(null);
        $api->getIdentities();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<urn1:GetIdentitiesRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetInfo()
    {
        $api = new LocalAccountWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->getInfo('x,attrs,y,zimlets,z', 'rights');

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<ns1:GetInfoRequest sections="attrs,zimlets" rights="rights" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAccountHttp(null);
        $api->getInfo('x,attrs,y,zimlets,z', 'rights');

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<urn1:GetInfoRequest sections="attrs,zimlets" rights="rights" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetPrefs()
    {
        $pref = new \Zimbra\Account\Struct\Pref('name', 'value', 1000);

        $api = new LocalAccountWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->getPrefs(array($pref));

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<ns1:GetPrefsRequest>'
                        .'<ns1:pref name="name" modified="1000">value</ns1:pref>'
                    .'</ns1:GetPrefsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAccountHttp(null);
        $api->getPrefs(array($pref));

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<urn1:GetPrefsRequest>'
                        .'<urn1:pref name="name" modified="1000">value</urn1:pref>'
                    .'</urn1:GetPrefsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetRights()
    {
        $ace = new \Zimbra\Account\Struct\Right('right');

        $api = new LocalAccountWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->getRights(array($ace));

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<ns1:GetRightsRequest>'
                        .'<ns1:ace right="right" />'
                    .'</ns1:GetRightsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAccountHttp(null);
        $api->getRights(array($ace));

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<urn1:GetRightsRequest>'
                        .'<urn1:ace right="right" />'
                    .'</urn1:GetRightsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetShareInfo()
    {
        $owner = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), 'value');
        $grantee = new \Zimbra\Struct\GranteeChooser('type', 'id', 'name');

        $api = new LocalAccountWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->getShareInfo($grantee, $owner, true, false);

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<ns1:GetShareInfoRequest internal="true" includeSelf="false" >'
                        .'<ns1:grantee type="type" id="id" name="name" />'
                        .'<ns1:owner by="name">value</ns1:owner>'
                    .'</ns1:GetShareInfoRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAccountHttp(null);
        $api->getShareInfo($grantee, $owner, true, false);

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<urn1:GetShareInfoRequest internal="true" includeSelf="false" >'
                        .'<urn1:grantee type="type" id="id" name="name" />'
                        .'<urn1:owner by="name">value</urn1:owner>'
                    .'</urn1:GetShareInfoRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetSignatures()
    {
        $api = new LocalAccountWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->getSignatures();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<ns1:GetSignaturesRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAccountHttp(null);
        $api->getSignatures();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<urn1:GetSignaturesRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetVersionInfo()
    {
        $api = new LocalAccountWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->getVersionInfo();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<ns1:GetVersionInfoRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAccountHttp(null);
        $api->getVersionInfo();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<urn1:GetVersionInfoRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetWhiteBlackList()
    {
        $api = new LocalAccountWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->getWhiteBlackList();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<ns1:GetWhiteBlackListRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAccountHttp(null);
        $api->getWhiteBlackList();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<urn1:GetWhiteBlackListRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGrantRights()
    {
        $ace = new \Zimbra\Account\Struct\AccountACEInfo(
            GranteeType::ALL(), AceRightType::VIEW_FREE_BUSY(), 'zid', 'dir', 'key', 'pw', true, false
        );

        $api = new LocalAccountWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->grantRights(array($ace));

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<ns1:GrantRightsRequest>'
                        .'<ns1:ace gt="all" right="viewFreeBusy" zid="zid" d="dir" key="key" pw="pw" deny="true" chkgt="false" />'
                    .'</ns1:GrantRightsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAccountHttp(null);
        $api->grantRights(array($ace));

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<urn1:GrantRightsRequest>'
                        .'<urn1:ace gt="all" right="viewFreeBusy" zid="zid" d="dir" key="key" pw="pw" deny="true" chkgt="false" />'
                    .'</urn1:GrantRightsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testModifyIdentity()
    {
        $attr = new \Zimbra\Account\Struct\Attr('name', 'value', true);
        $identity = new \Zimbra\Account\Struct\Identity('name', 'id', array($attr));

        $api = new LocalAccountWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->modifyIdentity($identity);

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<ns1:ModifyIdentityRequest>'
                        .'<ns1:identity name="name" id="id">'
                            .'<ns1:a name="name" pd="true">value</ns1:a>'
                        .'</ns1:identity>'
                    .'</ns1:ModifyIdentityRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAccountHttp(null);
        $api->modifyIdentity($identity);

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<urn1:ModifyIdentityRequest>'
                        .'<urn1:identity name="name" id="id">'
                            .'<urn1:a name="name" pd="true">value</urn1:a>'
                        .'</urn1:identity>'
                    .'</urn1:ModifyIdentityRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
    public function testModifyPrefs()
    {
        $pref = new \Zimbra\Account\Struct\Pref('name', 'value', 1000);

        $api = new LocalAccountWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->modifyPrefs(array($pref));

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<ns1:ModifyPrefsRequest>'
                        .'<ns1:pref name="name" modified="1000">value</ns1:pref>'
                    .'</ns1:ModifyPrefsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAccountHttp(null);
        $api->modifyPrefs(array($pref));

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<urn1:ModifyPrefsRequest>'
                        .'<urn1:pref name="name" modified="1000">value</urn1:pref>'
                    .'</urn1:ModifyPrefsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testModifyProperties()
    {
        $prop = new \Zimbra\Account\Struct\Prop('zimlet', 'name', 'value');

        $api = new LocalAccountWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->modifyProperties(array($prop));

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<ns1:ModifyPropertiesRequest>'
                        .'<ns1:prop zimlet="zimlet" name="name">value</ns1:prop>'
                    .'</ns1:ModifyPropertiesRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAccountHttp(null);
        $api->modifyProperties(array($prop));

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<urn1:ModifyPropertiesRequest>'
                        .'<urn1:prop zimlet="zimlet" name="name">value</urn1:prop>'
                    .'</urn1:ModifyPropertiesRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
    public function testModifySignature()
    {
        $content = new \Zimbra\Account\Struct\SignatureContent('value', ContentType::TEXT_HTML());
        $signature = new \Zimbra\Account\Struct\Signature('name', 'id', 'cid', array($content));

        $api = new LocalAccountWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->modifySignature($signature);

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<ns1:ModifySignatureRequest>'
                        .'<ns1:signature name="name" id="id">'
                            .'<ns1:content type="text/html">value</ns1:content>'
                            .'<ns1:cid>cid</ns1:cid>'
                        .'</ns1:signature>'
                    .'</ns1:ModifySignatureRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAccountHttp(null);
        $api->modifySignature($signature);

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<urn1:ModifySignatureRequest>'
                        .'<urn1:signature name="name" id="id">'
                            .'<urn1:cid>cid</urn1:cid>'
                            .'<urn1:content type="text/html">value</urn1:content>'
                        .'</urn1:signature>'
                    .'</urn1:ModifySignatureRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
    public function testModifyWhiteBlackList()
    {
        $white = new \Zimbra\Struct\OpValue('+', 'white');
        $black = new \Zimbra\Struct\OpValue('-', 'black');
        $whiteList = new \Zimbra\Account\Struct\WhiteList(array($white));
        $blackList = new \Zimbra\Account\Struct\BlackList(array($black));

        $api = new LocalAccountWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->modifyWhiteBlackList($whiteList, $blackList);

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<ns1:ModifyWhiteBlackListRequest>'
                        .'<ns1:whiteList>'
                            .'<ns1:addr op="+">white</ns1:addr>'
                        .'</ns1:whiteList>'
                        .'<ns1:blackList>'
                            .'<ns1:addr op="-">black</ns1:addr>'
                        .'</ns1:blackList>'
                    .'</ns1:ModifyWhiteBlackListRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAccountHttp(null);
        $api->modifyWhiteBlackList($whiteList, $blackList);

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<urn1:ModifyWhiteBlackListRequest>'
                        .'<urn1:whiteList>'
                            .'<urn1:addr op="+">white</urn1:addr>'
                        .'</urn1:whiteList>'
                        .'<urn1:blackList>'
                            .'<urn1:addr op="-">black</urn1:addr>'
                        .'</urn1:blackList>'
                    .'</urn1:ModifyWhiteBlackListRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testModifyZimletPrefs()
    {
        $zimlet = new \Zimbra\Account\Struct\ZimletPrefsSpec('name', ZimletStatus::ENABLED());

        $api = new LocalAccountWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->modifyZimletPrefs(array($zimlet));

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<ns1:ModifyZimletPrefsRequest>'
                        .'<ns1:zimlet name="name" presence="enabled" />'
                    .'</ns1:ModifyZimletPrefsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAccountHttp(null);
        $api->modifyZimletPrefs(array($zimlet));

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<urn1:ModifyZimletPrefsRequest>'
                        .'<urn1:zimlet name="name" presence="enabled" />'
                    .'</urn1:ModifyZimletPrefsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testRevokeRights()
    {
        $ace = new \Zimbra\Account\Struct\AccountACEInfo(GranteeType::ALL(), AceRightType::VIEW_FREE_BUSY(), 'zid', 'dir', 'key', 'pw', true, false);

        $api = new LocalAccountWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->revokeRights(array($ace));

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<ns1:RevokeRightsRequest>'
                        .'<ns1:ace gt="all" right="viewFreeBusy" zid="zid" d="dir" key="key" pw="pw" deny="true" chkgt="false" />'
                    .'</ns1:RevokeRightsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAccountHttp(null);
        $api->revokeRights(array($ace));

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<urn1:RevokeRightsRequest>'
                        .'<urn1:ace gt="all" right="viewFreeBusy" zid="zid" d="dir" key="key" pw="pw" deny="true" chkgt="false" />'
                    .'</urn1:RevokeRightsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
    public function testSearchCalendarResources()
    {
        $cursor = new \Zimbra\Struct\CursorInfo('id','sortVal', 'endSortVal', true);

        $otherCond = new \Zimbra\Account\Struct\EntrySearchFilterSingleCond('attr', CondOp::GE(), 'value', false);
        $otherConds = new \Zimbra\Account\Struct\EntrySearchFilterMultiCond(false, true, NULL, $otherCond);
        $cond = new \Zimbra\Account\Struct\EntrySearchFilterSingleCond('a', CondOp::EQ(), 'v', true);
        $conds = new \Zimbra\Account\Struct\EntrySearchFilterMultiCond(true, false, $otherConds, $cond);

        $filter = new \Zimbra\Account\Struct\EntrySearchFilterInfo($conds);
        $api = new LocalAccountWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->searchCalendarResources(
            'locale', $cursor, 'name', $filter, true, 'sortBy', 10, 10, 'galAcctId', 'attrs'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<ns1:SearchCalendarResourcesRequest attrs="attrs" quick="true" sortBy="sortBy" limit="10" offset="10" galAcctId="galAcctId">'
                        .'<ns1:locale>locale</ns1:locale>'
                        .'<ns1:cursor id="id" sortVal="sortVal" endSortVal="endSortVal" includeOffset="true" />'
                        .'<ns1:name>name</ns1:name>'
                        .'<ns1:searchFilter>'
                            .'<ns1:conds not="true" or="false">'
                                .'<ns1:conds not="false" or="true">'
                                    .'<ns1:cond not="false" attr="attr" op="ge" value="value" />'
                                .'</ns1:conds>'
                                .'<ns1:cond not="true" attr="a" op="eq" value="v" />'
                            .'</ns1:conds>'
                        .'</ns1:searchFilter>'
                    .'</ns1:SearchCalendarResourcesRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $filter = new \Zimbra\Account\Struct\EntrySearchFilterInfo(null, $cond);
        $api = new LocalAccountWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->searchCalendarResources(
            'locale', $cursor, 'name', $filter, true, 'sortBy', 10, 10, 'galAcctId', 'attrs'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<ns1:SearchCalendarResourcesRequest attrs="attrs" quick="true" sortBy="sortBy" limit="10" offset="10" galAcctId="galAcctId">'
                        .'<ns1:locale>locale</ns1:locale>'
                        .'<ns1:cursor id="id" sortVal="sortVal" endSortVal="endSortVal" includeOffset="true" />'
                        .'<ns1:name>name</ns1:name>'
                        .'<ns1:searchFilter>'
                            .'<ns1:cond not="true" attr="a" op="eq" value="v" />'
                        .'</ns1:searchFilter>'
                    .'</ns1:SearchCalendarResourcesRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $filter = new \Zimbra\Account\Struct\EntrySearchFilterInfo($conds, $cond);
        $api = new LocalAccountHttp(null);
        $api->searchCalendarResources(
            'locale', $cursor, 'name', $filter, true, 'sortBy', 10, 10, 'galAcctId', 'attrs'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<urn1:SearchCalendarResourcesRequest quick="true" sortBy="sortBy" limit="10" offset="10" galAcctId="galAcctId" attrs="attrs">'
                        .'<urn1:locale>locale</urn1:locale>'
                        .'<urn1:cursor id="id" sortVal="sortVal" endSortVal="endSortVal" includeOffset="true" />'
                        .'<urn1:name>name</urn1:name>'
                        .'<urn1:searchFilter>'
                            .'<urn1:conds not="true" or="false">'
                                .'<urn1:conds not="false" or="true">'
                                    .'<urn1:cond attr="attr" op="ge" value="value" not="false" />'
                                .'</urn1:conds>'
                                .'<urn1:cond attr="a" op="eq" value="v" not="true" />'
                            .'</urn1:conds>'
                            .'<urn1:cond attr="a" op="eq" value="v" not="true" />'
                        .'</urn1:searchFilter>'
                    .'</urn1:SearchCalendarResourcesRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testSearchGal()
    {
        $cursor = new \Zimbra\Struct\CursorInfo('id','sortVal', 'endSortVal', true);

        $otherCond = new \Zimbra\Account\Struct\EntrySearchFilterSingleCond('attr', CondOp::GE(), 'value', false);
        $otherConds = new \Zimbra\Account\Struct\EntrySearchFilterMultiCond(false, true, NULL, $otherCond);
        $cond = new \Zimbra\Account\Struct\EntrySearchFilterSingleCond('a', CondOp::EQ(), 'v', true);
        $conds = new \Zimbra\Account\Struct\EntrySearchFilterMultiCond(true, false, $otherConds, $cond);

        $filter = new \Zimbra\Account\Struct\EntrySearchFilterInfo($conds);
        $api = new LocalAccountWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->searchGal(
            'locale', $cursor, $filter, 'ref', 'name', SearchType::ALL(),
            true, false, MemberOf::ALL(), true, 'galAcctId', false, SortBy::NONE(), 10, 10
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<ns1:SearchGalRequest ref="ref" name="name" type="all" needExp="true" needIsOwner="false" needIsMember="all" needSMIMECerts="true" galAcctId="galAcctId" quick="false" sortBy="none" limit="10" offset="10">'
                        .'<ns1:locale>locale</ns1:locale>'
                        .'<ns1:cursor id="id" sortVal="sortVal" endSortVal="endSortVal" includeOffset="true" />'
                        .'<ns1:searchFilter>'
                            .'<ns1:conds not="true" or="false">'
                                .'<ns1:conds not="false" or="true">'
                                    .'<ns1:cond not="false" attr="attr" op="ge" value="value" />'
                                .'</ns1:conds>'
                                .'<ns1:cond not="true" attr="a" op="eq" value="v" />'
                            .'</ns1:conds>'
                        .'</ns1:searchFilter>'
                    .'</ns1:SearchGalRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $filter = new \Zimbra\Account\Struct\EntrySearchFilterInfo(null, $cond);
        $api = new LocalAccountWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->searchGal(
            'locale', $cursor, $filter, 'ref', 'name', SearchType::ALL(),
            true, false, MemberOf::ALL(), true, 'galAcctId', false, SortBy::NONE(), 10, 10
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<ns1:SearchGalRequest ref="ref" name="name" type="all" needExp="true" needIsOwner="false" needIsMember="all" needSMIMECerts="true" galAcctId="galAcctId" quick="false" sortBy="none" limit="10" offset="10">'
                        .'<ns1:locale>locale</ns1:locale>'
                        .'<ns1:cursor id="id" sortVal="sortVal" endSortVal="endSortVal" includeOffset="true" />'
                        .'<ns1:searchFilter>'
                            .'<ns1:cond not="true" attr="a" op="eq" value="v" />'
                        .'</ns1:searchFilter>'
                    .'</ns1:SearchGalRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $filter = new \Zimbra\Account\Struct\EntrySearchFilterInfo($conds, $cond);
        $api = new LocalAccountHttp(null);
        $api->searchGal(
            'locale', $cursor, $filter, 'ref', 'name', SearchType::ALL(),
            true, false, MemberOf::ALL(), true, 'galAcctId', false, SortBy::NONE(), 10, 10
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<urn1:SearchGalRequest ref="ref" name="name" type="all" needExp="true" needIsOwner="false" needIsMember="all" needSMIMECerts="true" galAcctId="galAcctId" quick="false" sortBy="none" limit="10" offset="10">'
                        .'<urn1:locale>locale</urn1:locale>'
                        .'<urn1:cursor id="id" sortVal="sortVal" endSortVal="endSortVal" includeOffset="true" />'
                        .'<urn1:searchFilter>'
                            .'<urn1:conds not="true" or="false">'
                                .'<urn1:conds not="false" or="true">'
                                    .'<urn1:cond attr="attr" op="ge" value="value" not="false" />'
                                .'</urn1:conds>'
                                .'<urn1:cond attr="a" op="eq" value="v" not="true" />'
                            .'</urn1:conds>'
                            .'<urn1:cond attr="a" op="eq" value="v" not="true" />'
                        .'</urn1:searchFilter>'
                    .'</urn1:SearchGalRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testSubscribeDistributionList()
    {
        $dl = new \Zimbra\Account\Struct\DistributionListSelector(DLBy::NAME(), 'value');

        $api = new LocalAccountWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->subscribeDistributionList(DLSubscribeOp::SUBSCRIBE(), $dl);

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<ns1:SubscribeDistributionListRequest op="subscribe">'
                        .'<ns1:dl by="name">value</ns1:dl>'
                    .'</ns1:SubscribeDistributionListRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAccountHttp(null);
        $api->subscribeDistributionList(DLSubscribeOp::SUBSCRIBE(), $dl);

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<urn1:SubscribeDistributionListRequest op="subscribe">'
                        .'<urn1:dl by="name">value</urn1:dl>'
                    .'</urn1:SubscribeDistributionListRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
    public function testSyncGal()
    {
        $api = new LocalAccountWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->syncGal('token', 'galAcctId', true);

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<ns1:SyncGalRequest token="token" galAcctId="galAcctId" idOnly="true" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAccountHttp(null);
        $api->syncGal('token', 'galAcctId', true);

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                .'<env:Body>'
                    .'<urn1:SyncGalRequest token="token" galAcctId="galAcctId" idOnly="true" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}

class LocalAccountWsdl extends AccountBase
{
    public function __construct($location)
    {
        parent::__construct($location);
        $this->_client = new LocalClientWsdl($this->_location);
    }
}

class LocalAccountHttp extends AccountBase
{
    public function __construct($location)
    {
        parent::__construct($location);
        $this->_client = new LocalClientHttp($this->_location);
    }
}
