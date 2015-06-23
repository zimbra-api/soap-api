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
 * Api test case class for account api.
 */
class ApiTest extends ZimbraTestCase
{
    private $_api;

    public function __construct()
    {
        parent::__construct();
        $this->_api = new LocalAccountHttp(null);
    }

    public function testAccountFactory()
    {
        $httpApi = AccountFactory::instance();
        $this->assertInstanceOf('\Zimbra\Account\Base', $httpApi);
        $this->assertInstanceOf('\Zimbra\Account\Http', $httpApi);
    }

    public function testAuth()
    {
        $name = self::randomName();
        $value = md5(self::randomString());
        $password = md5(self::randomString());
        $virtualHost = self::randomName();
        $requestedSkin = self::randomName();
        $time = mt_rand(0, 1000);

        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), $value);
        $preauth = new \Zimbra\Account\Struct\PreAuth($time, $value, $time);
        $authToken = new \Zimbra\Account\Struct\AuthToken($value, true);

        $attr = new \Zimbra\Account\Struct\Attr($name, $value, true);
        $attrs = new \Zimbra\Account\Struct\AuthAttrs(array($attr));

        $pref = new \Zimbra\Account\Struct\Pref($name, $value, $time);
        $prefs = new \Zimbra\Account\Struct\AuthPrefs(array($pref));

        $this->_api->auth(
            $account, $password, $preauth, $authToken, $virtualHost,
            $prefs, $attrs, $requestedSkin, false
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:AuthRequest persistAuthTokenCookie="false">'
                        . '<urn1:account by="' . AccountBy::NAME() . '">' . $value . '</urn1:account>'
                        . '<urn1:password>' . $password . '</urn1:password>'
                        . '<urn1:preauth timestamp="' . $time . '" expiresTimestamp="' . $time . '">' . $value . '</urn1:preauth>'
                        . '<urn1:authToken verifyAccount="true">' . $value . '</urn1:authToken>'
                        . '<urn1:virtualHost>' . $virtualHost . '</urn1:virtualHost>'
                        . '<urn1:prefs>'
                            . '<urn1:pref name="' . $name . '" modified="' . $time . '">' . $value . '</urn1:pref>'
                        . '</urn1:prefs>'
                        . '<urn1:attrs>'
                            . '<urn1:attr name="' . $name . '" pd="true">' . $value . '</urn1:attr>'
                        . '</urn1:attrs>'
                        . '<urn1:requestedSkin>' . $requestedSkin . '</urn1:requestedSkin>'
                    . '</urn1:AuthRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testAuthByAcount()
    {
        $value = md5(self::randomString());
        $password = md5(self::randomString());
        $virtualHost = self::randomName();

        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), $value);

        $this->_api->authByAcount(
            $account, $password, $virtualHost
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:AuthRequest>'
                        . '<urn1:account by="' . AccountBy::NAME() . '">' . $value . '</urn1:account>'
                        . '<urn1:password>' . $password . '</urn1:password>'
                        . '<urn1:virtualHost>' . $virtualHost . '</urn1:virtualHost>'
                        . '<urn1:prefs />'
                        . '<urn1:attrs />'
                    . '</urn1:AuthRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testAuthByToken()
    {
        $value = md5(self::randomString());
        $virtualHost = self::randomName();

        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), $value);
        $authToken = new \Zimbra\Account\Struct\AuthToken($value, true);

        $this->_api->authByToken(
            $account, $authToken, $virtualHost
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:AuthRequest>'
                        . '<urn1:account by="' . AccountBy::NAME() . '">' . $value . '</urn1:account>'
                        . '<urn1:authToken verifyAccount="true">' . $value . '</urn1:authToken>'
                        . '<urn1:virtualHost>' . $virtualHost . '</urn1:virtualHost>'
                        . '<urn1:prefs />'
                        . '<urn1:attrs />'
                    . '</urn1:AuthRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testAutoCompleteGal()
    {
        $name = self::randomName();
        $galAcctId = self::randomName();
        $limit = mt_rand(0, 100);

        $this->_api->autoCompleteGal(
            $name, true, SearchType::ALL(), $galAcctId, $limit
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:AutoCompleteGalRequest '
                        . 'needExp="true" name="' . $name . '" type="' . SearchType::ALL() . '" galAcctId="' . $galAcctId . '" limit="' . $limit . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testChangePassword()
    {
        $value = md5(self::randomString());
        $oldPassword = md5(self::randomString());
        $password = md5(self::randomString());
        $virtualHost = self::randomName();

        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), $value);

        $this->_api->changePassword(
            $account, $oldPassword, $password, $virtualHost
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:ChangePasswordRequest>'
                        . '<urn1:account by="' . AccountBy::NAME() . '">' . $value . '</urn1:account>'
                        . '<urn1:oldPassword>' . $oldPassword . '</urn1:oldPassword>'
                        . '<urn1:password>' . $password . '</urn1:password>'
                        . '<urn1:virtualHost>' . $virtualHost . '</urn1:virtualHost>'
                    . '</urn1:ChangePasswordRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCheckRights()
    {
        $key = self::randomName();
        $right1 = md5(self::randomString());
        $right2 = md5(self::randomString());

        $target = new \Zimbra\Account\Struct\CheckRightsTargetSpec(
            TargetType::DOMAIN(), TargetBy::ID(), $key, array($right1, $right2)
        );

        $this->_api->checkRights(
            array($target)
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:CheckRightsRequest>'
                        . '<urn1:target type="' . TargetType::DOMAIN() . '" by="' . TargetBy::ID() . '" key="' . $key . '">'
                            . '<urn1:right>' . $right1 . '</urn1:right>'
                            . '<urn1:right>' . $right2 . '</urn1:right>'
                        . '</urn1:target>'
                    . '</urn1:CheckRightsRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCreateDistributionList()
    {
        $name = self::randomName();
        $key = self::randomName();
        $value = md5(self::randomString());
        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);

        $this->_api->createDistributionList(
            $name, true, array($attr)
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:CreateDistributionListRequest name="' . $name . '" dynamic="true">'
                        . '<urn1:a n="' . $key . '">' . $value . '</urn1:a>'
                    . '</urn1:CreateDistributionListRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCreateIdentity()
    {
        $id = self::randomName();
        $name = self::randomName();
        $value = md5(self::randomString());
        $attr = new \Zimbra\Account\Struct\Attr($name, $value, true);
        $identity = new \Zimbra\Account\Struct\Identity($name, $id, array($attr));

        $this->_api->createIdentity(
            $identity
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:CreateIdentityRequest>'
                        . '<urn1:identity name="' . $name . '" id="' . $id . '">'
                            . '<urn1:a name="' . $name . '" pd="true">' . $value . '</urn1:a>'
                        . '</urn1:identity>'
                    . '</urn1:CreateIdentityRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCreateSignature()
    {
        $value = md5(self::randomString());
        $name = self::randomName();
        $id = self::randomName();
        $cid = self::randomName();
        $content = new \Zimbra\Account\Struct\SignatureContent($value, ContentType::TEXT_PLAIN());
        $signature = new \Zimbra\Account\Struct\Signature($name, $id, $cid, array($content));

        $this->_api->createSignature(
            $signature
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:CreateSignatureRequest>'
                        . '<urn1:signature id="' . $id . '" name="' . $name . '">'
                            . '<urn1:cid>' . $cid . '</urn1:cid>'
                            . '<urn1:content type="' . ContentType::TEXT_PLAIN() . '">' . $value . '</urn1:content>'
                        . '</urn1:signature>'
                    . '</urn1:CreateSignatureRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testDeleteIdentity()
    {
        $name = self::randomName();
        $id = self::randomName();
        $identity = new \Zimbra\Account\Struct\NameId($name, $id);

        $this->_api->deleteIdentity(
            $identity
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:DeleteIdentityRequest>'
                        . '<urn1:identity name="' . $name . '" id="' . $id . '" />'
                    . '</urn1:DeleteIdentityRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testDeleteSignature()
    {
        $name = self::randomName();
        $id = self::randomName();
        $signature = new \Zimbra\Account\Struct\NameId($name, $id);

        $this->_api->deleteSignature(
            $signature
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:DeleteSignatureRequest>'
                        . '<urn1:signature name="' . $name . '" id="' . $id . '" />'
                    . '</urn1:DeleteSignatureRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testDiscoverRights()
    {
        $right1 = self::randomName();
        $right2 = self::randomName();
        $right3 = self::randomName();

        $this->_api->discoverRights(
            array($right1, $right2, $right3)
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:DiscoverRightsRequest>'
                        . '<urn1:right>' . $right1 . '</urn1:right>'
                        . '<urn1:right>' . $right2 . '</urn1:right>'
                        . '<urn1:right>' . $right3 . '</urn1:right>'
                    . '</urn1:DiscoverRightsRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testDistributionListAction()
    {
        $name = self::randomName();
        $value = md5(self::randomString());
        $member = self::randomName();

        $subsReq = new \Zimbra\Account\Struct\DistributionListSubscribeReq(DLSubscribeOp::SUBSCRIBE(), $value, true);
        $owner = new \Zimbra\Account\Struct\DistributionListGranteeSelector(GranteeType::USR(), DLGranteeBy::ID(), $value);
        $grantee = new \Zimbra\Account\Struct\DistributionListGranteeSelector(GranteeType::ALL(), DLGranteeBy::NAME(), $value);
        $right = new \Zimbra\Account\Struct\DistributionListRightSpec($name, array($grantee));
        $a = new \Zimbra\Struct\KeyValuePair($name, $value);
        $action = new \Zimbra\Account\Struct\DistributionListAction(Operation::MODIFY(), $name, $subsReq, array($member), array($owner), array($right), array($a));

        $dl = new \Zimbra\Account\Struct\DistributionListSelector(DLBy::NAME(), $value);
        $attr = new \Zimbra\Account\Struct\Attr($name, $value, true);

        $this->_api->distributionListAction(
            $dl, $action, array($attr)
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:DistributionListActionRequest>'
                        . '<urn1:dl by="' . DLBy::NAME() . '">' . $value . '</urn1:dl>'
                        . '<urn1:action op="' . Operation::MODIFY() . '">'
                            . '<urn1:newName>' . $name . '</urn1:newName>'
                            . '<urn1:subsReq op="' . DLSubscribeOp::SUBSCRIBE() . '" bccOwners="true">' . $value . '</urn1:subsReq>'
                            . '<urn1:a n="' . $name . '">' . $value . '</urn1:a>'
                            . '<urn1:dlm>' . $member . '</urn1:dlm>'
                            . '<urn1:owner type="' . GranteeType::USR() . '" by="' . DLGranteeBy::ID() . '">' . $value . '</urn1:owner>'
                            . '<urn1:right right="' . $name . '">'
                                . '<urn1:grantee type="' . GranteeType::ALL() . '" by="' . DLGranteeBy::NAME() . '">' . $value . '</urn1:grantee>'
                            . '</urn1:right>'
                        . '</urn1:action>'
                        . '<urn1:a name="' . $name . '" pd="true">' . $value . '</urn1:a>'
                    . '</urn1:DistributionListActionRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testEndSession()
    {
        $this->_api->endSession();

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:EndSessionRequest />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAccountDistributionLists()
    {
        $attrs = self::randomName();
        $this->_api->getAccountDistributionLists(true, MemberOf::DIRECT_ONLY(), array($attrs));

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:GetAccountDistributionListsRequest ownerOf="true" memberOf="' . MemberOf::DIRECT_ONLY() . '" attrs="' . $attrs . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAccountInfo()
    {
        $value = md5(self::randomString());
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), $value);

        $this->_api->getAccountInfo($account);

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:GetAccountInfoRequest>'
                        . '<urn1:account by="' . AccountBy::NAME() . '">' . $value . '</urn1:account>'
                    . '</urn1:GetAccountInfoRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAllLocales()
    {
        $this->_api->getAllLocales();

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:GetAllLocalesRequest />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAvailableCsvFormats()
    {
        $this->_api->getAvailableCsvFormats();

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:GetAvailableCsvFormatsRequest />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAvailableLocales()
    {
        $this->_api->getAvailableLocales();

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:GetAvailableLocalesRequest />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAvailableSkins()
    {
        $this->_api->getAvailableSkins();

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:GetAvailableSkinsRequest />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetDistributionList()
    {
        $name = self::randomName();
        $value = md5(self::randomString());
        $dl = new \Zimbra\Account\Struct\DistributionListSelector(DLBy::NAME(), $value);
        $attr = new \Zimbra\Account\Struct\Attr($name, $value, true);

        $this->_api->getDistributionList($dl, true, 'sendToDistList', array($attr));

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:GetDistributionListRequest needOwners="true" needRights="sendToDistList">'
                        . '<urn1:dl by="' . DLBy::NAME() . '">' . $value . '</urn1:dl>'
                        . '<urn1:a name="' . $name . '" pd="true">' . $value . '</urn1:a>'
                    . '</urn1:GetDistributionListRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetDistributionListMembers()
    {
        $name = self::randomName();
        $this->_api->getDistributionListMembers($name, 100, 100);

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:GetDistributionListMembersRequest limit="100" offset="100">'
                        . '<urn1:dl>' . $name . '</urn1:dl>'
                    . '</urn1:GetDistributionListMembersRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetIdentities()
    {
        $this->_api->getIdentities();

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:GetIdentitiesRequest />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetInfo()
    {
        $name = self::randomName();
        $this->_api->getInfo('x,attrs,y,zimlets,z', $name);

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:GetInfoRequest sections="attrs,zimlets" rights="' . $name . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetPrefs()
    {
        $name = self::randomName();
        $value = md5(self::randomString());
        $modified = mt_rand(0, 1000);
        $pref = new \Zimbra\Account\Struct\Pref($name, $value, $modified);

        $this->_api->getPrefs(array($pref));

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:GetPrefsRequest>'
                        . '<urn1:pref name="' . $name . '" modified="' . $modified . '">' . $value . '</urn1:pref>'
                    . '</urn1:GetPrefsRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetRights()
    {
        $name = self::randomName();
        $ace = new \Zimbra\Account\Struct\Right($name);

        $this->_api->getRights(array($ace));

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:GetRightsRequest>'
                        . '<urn1:ace right="' . $name . '" />'
                    . '</urn1:GetRightsRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetShareInfo()
    {
        $value = md5(self::randomString());
        $name = self::randomName();
        $type = self::randomName();
        $id = self::randomName();
        $owner = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), $value);
        $grantee = new \Zimbra\Struct\GranteeChooser($type, $id, $name);

        $this->_api->getShareInfo($grantee, $owner, true, false);

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:GetShareInfoRequest internal="true" includeSelf="false" >'
                        . '<urn1:grantee type="' . $type . '" id="' . $id . '" name="' . $name . '" />'
                        . '<urn1:owner by="' . AccountBy::NAME() . '">' . $value . '</urn1:owner>'
                    . '</urn1:GetShareInfoRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetSignatures()
    {
        $this->_api->getSignatures();

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:GetSignaturesRequest />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetVersionInfo()
    {
        $this->_api->getVersionInfo();

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:GetVersionInfoRequest />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetWhiteBlackList()
    {
        $this->_api->getWhiteBlackList();

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:GetWhiteBlackListRequest />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGrantRights()
    {
        $zid = self::randomName();
        $dir = self::randomName();
        $key = self::randomName();
        $pw = self::randomName();
        $ace = new \Zimbra\Account\Struct\AccountACEInfo(
            GranteeType::ALL(), AceRightType::VIEW_FREE_BUSY(), $zid, $dir, $key, $pw, true, false
        );

        $this->_api->grantRights(array($ace));

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:GrantRightsRequest>'
                        . '<urn1:ace gt="' . GranteeType::ALL() . '" right="' . AceRightType::VIEW_FREE_BUSY() . '" zid="' . $zid . '" d="' . $dir . '" key="' . $key . '" pw="' . $pw . '" deny="true" chkgt="false" />'
                    . '</urn1:GrantRightsRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testModifyIdentity()
    {
        $name = self::randomName();
        $id = self::randomName();
        $value = md5(self::randomString());
        $attr = new \Zimbra\Account\Struct\Attr($name, $value, true);
        $identity = new \Zimbra\Account\Struct\Identity($name, $id, array($attr));

        $this->_api->modifyIdentity($identity);

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:ModifyIdentityRequest>'
                        . '<urn1:identity name="' . $name . '" id="' . $id . '">'
                            . '<urn1:a name="' . $name . '" pd="true">' . $value . '</urn1:a>'
                        . '</urn1:identity>'
                    . '</urn1:ModifyIdentityRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
    public function testModifyPrefs()
    {
        $name = self::randomName();
        $value = md5(self::randomString());
        $modified = mt_rand(0, 1000);
        $pref = new \Zimbra\Account\Struct\Pref($name, $value, $modified);

        $this->_api->modifyPrefs(array($pref));

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:ModifyPrefsRequest>'
                        . '<urn1:pref name="' . $name . '" modified="' . $modified . '">' . $value . '</urn1:pref>'
                    . '</urn1:ModifyPrefsRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testModifyProperties()
    {
        $zimlet = self::randomName();
        $name = self::randomName();
        $value = md5(self::randomString());
        $prop = new \Zimbra\Account\Struct\Prop($zimlet, $name, $value);

        $this->_api->modifyProperties(array($prop));

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:ModifyPropertiesRequest>'
                        . '<urn1:prop zimlet="' . $zimlet . '" name="' . $name . '">' . $value . '</urn1:prop>'
                    . '</urn1:ModifyPropertiesRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testModifySignature()
    {
        $value = md5(self::randomString());
        $name = self::randomName();
        $id = self::randomName();
        $cid = self::randomName();
        $content = new \Zimbra\Account\Struct\SignatureContent($value, ContentType::TEXT_HTML());
        $signature = new \Zimbra\Account\Struct\Signature($name, $id, $cid, array($content));

        $this->_api->modifySignature($signature);

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:ModifySignatureRequest>'
                        . '<urn1:signature name="' . $name . '" id="' . $id . '">'
                            . '<urn1:cid>' . $cid . '</urn1:cid>'
                            . '<urn1:content type="' . ContentType::TEXT_HTML() . '">' . $value . '</urn1:content>'
                        . '</urn1:signature>'
                    . '</urn1:ModifySignatureRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
    public function testModifyWhiteBlackList()
    {
        $value = md5(self::randomString());
        $white = new \Zimbra\Struct\OpValue('+', $value);
        $black = new \Zimbra\Struct\OpValue('-', $value);
        $whiteList = new \Zimbra\Account\Struct\WhiteList(array($white));
        $blackList = new \Zimbra\Account\Struct\BlackList(array($black));

        $this->_api->modifyWhiteBlackList($whiteList, $blackList);

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:ModifyWhiteBlackListRequest>'
                        . '<urn1:whiteList>'
                            . '<urn1:addr op="+">' . $value . '</urn1:addr>'
                        . '</urn1:whiteList>'
                        . '<urn1:blackList>'
                            . '<urn1:addr op="-">' . $value . '</urn1:addr>'
                        . '</urn1:blackList>'
                    . '</urn1:ModifyWhiteBlackListRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testModifyZimletPrefs()
    {
        $name = self::randomName();
        $zimlet = new \Zimbra\Account\Struct\ZimletPrefsSpec($name, ZimletStatus::ENABLED());

        $this->_api->modifyZimletPrefs(array($zimlet));

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:ModifyZimletPrefsRequest>'
                        . '<urn1:zimlet name="' . $name . '" presence="' . ZimletStatus::ENABLED() . '" />'
                    . '</urn1:ModifyZimletPrefsRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testRevokeRights()
    {
        $zid = md5(self::randomString());
        $dir = md5(self::randomString());
        $key = md5(self::randomString());
        $pw = md5(self::randomString());
        $ace = new \Zimbra\Account\Struct\AccountACEInfo(GranteeType::ALL(), AceRightType::VIEW_FREE_BUSY(), $zid, $dir, $key, $pw, true, false);

        $this->_api->revokeRights(array($ace));

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:RevokeRightsRequest>'
                        . '<urn1:ace gt="' . GranteeType::ALL() . '" right="' . AceRightType::VIEW_FREE_BUSY() . '" zid="' . $zid . '" d="' . $dir . '" key="' . $key . '" pw="' . $pw . '" deny="true" chkgt="false" />'
                    . '</urn1:RevokeRightsRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testSearchCalendarResources()
    {
        $id = md5(self::randomString());
        $sortVal = md5(self::randomString());
        $endSortVal = md5(self::randomString());
        $cursor = new \Zimbra\Struct\CursorInfo($id, $sortVal, $endSortVal, true);

        $attr = self::randomName();
        $value = md5(self::randomString());
        $cond = new \Zimbra\Struct\EntrySearchFilterSingleCond($attr, CondOp::EQ(), $value, true);
        $singleCond = new \Zimbra\Struct\EntrySearchFilterSingleCond($attr, CondOp::GE(), $value, false);
        $multiConds = new \Zimbra\Struct\EntrySearchFilterMultiCond(false, true, array($singleCond));
        $conds = new \Zimbra\Struct\EntrySearchFilterMultiCond(true, false, array($cond, $multiConds));
        $filter = new \Zimbra\Struct\EntrySearchFilterInfo($conds);

        $locale = self::randomName();
        $name = self::randomName();
        $sortBy = self::randomName();
        $galAcctId = self::randomName();
        $attrs = self::randomName();
        $limit = mt_rand(1, 100);
        $offset = mt_rand(0, 100);

        $this->_api->searchCalendarResources(
            $locale, $cursor, $name, $filter, true, $sortBy, $limit, $offset, $galAcctId, array($attrs)
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:SearchCalendarResourcesRequest quick="true" sortBy="' . $sortBy . '" limit="' . $limit . '" offset="' . $offset . '" galAcctId="' . $galAcctId . '" attrs="' . $attrs . '">'
                        . '<urn1:locale>' . $locale . '</urn1:locale>'
                        . '<urn1:cursor id="' . $id . '" sortVal="' . $sortVal . '" endSortVal="' . $endSortVal . '" includeOffset="true" />'
                        . '<urn1:name>' . $name . '</urn1:name>'
                        . '<urn1:searchFilter>'
                            . '<urn1:conds not="true" or="false">'
                                . '<urn1:conds not="false" or="true">'
                                    . '<urn1:cond attr="' . $attr . '" op="' . CondOp::GE() . '" value="' . $value . '" not="false" />'
                                . '</urn1:conds>'
                                . '<urn1:cond attr="' . $attr . '" op="' . CondOp::EQ() . '" value="' . $value . '" not="true" />'
                            . '</urn1:conds>'
                        . '</urn1:searchFilter>'
                    . '</urn1:SearchCalendarResourcesRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $filter = new \Zimbra\Struct\EntrySearchFilterInfo($cond);
        $this->_api->searchCalendarResources(
            $locale, $cursor, $name, $filter, true, $sortBy, $limit, $offset, $galAcctId, array($attrs)
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:SearchCalendarResourcesRequest quick="true" sortBy="' . $sortBy . '" limit="' . $limit . '" offset="' . $offset . '" galAcctId="' . $galAcctId . '" attrs="' . $attrs . '">'
                        . '<urn1:locale>' . $locale . '</urn1:locale>'
                        . '<urn1:cursor id="' . $id . '" sortVal="' . $sortVal . '" endSortVal="' . $endSortVal . '" includeOffset="true" />'
                        . '<urn1:name>' . $name . '</urn1:name>'
                        . '<urn1:searchFilter>'
                            . '<urn1:cond attr="' . $attr . '" op="' . CondOp::EQ() . '" value="' . $value . '" not="true" />'
                        . '</urn1:searchFilter>'
                    . '</urn1:SearchCalendarResourcesRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testSearchGal()
    {
        $id = md5(self::randomString());
        $sortVal = md5(self::randomString());
        $endSortVal = md5(self::randomString());
        $cursor = new \Zimbra\Struct\CursorInfo($id,$sortVal, $endSortVal, true);

        $attr = self::randomName();
        $value = md5(self::randomString());
        $cond = new \Zimbra\Struct\EntrySearchFilterSingleCond($attr, CondOp::EQ(), $value, true);
        $singleCond = new \Zimbra\Struct\EntrySearchFilterSingleCond($attr, CondOp::GE(), $value, false);
        $multiConds = new \Zimbra\Struct\EntrySearchFilterMultiCond(false, true, array($singleCond));
        $conds = new \Zimbra\Struct\EntrySearchFilterMultiCond(true, false, array($cond, $multiConds));
        $filter = new \Zimbra\Struct\EntrySearchFilterInfo($conds);

        $locale = self::randomName();
        $ref = self::randomName();
        $name = self::randomName();
        $galAcctId = self::randomName();
        $limit = mt_rand(1, 100);
        $offset = mt_rand(0, 100);

        $this->_api->searchGal(
            $locale, $cursor, $filter, $ref, $name, SearchType::ALL(),
            true, false, MemberOf::ALL(), true, $galAcctId, false, SortBy::NONE(), $limit, $offset
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:SearchGalRequest ref="' . $ref . '" name="' . $name . '" type="' . SearchType::ALL() . '" needExp="true" needIsOwner="false" needIsMember="' . MemberOf::ALL() . '" needSMIMECerts="true" galAcctId="' . $galAcctId . '" quick="false" sortBy="' . SortBy::NONE() . '" limit="' . $limit . '" offset="' . $offset . '">'
                        . '<urn1:locale>' . $locale . '</urn1:locale>'
                        . '<urn1:cursor id="' . $id . '" sortVal="' . $sortVal . '" endSortVal="' . $endSortVal . '" includeOffset="true" />'
                        . '<urn1:searchFilter>'
                            . '<urn1:conds not="true" or="false">'
                                . '<urn1:conds not="false" or="true">'
                                    . '<urn1:cond attr="' . $attr . '" op="' . CondOp::GE() . '" value="' . $value . '" not="false" />'
                                . '</urn1:conds>'
                                . '<urn1:cond attr="' . $attr . '" op="' . CondOp::EQ() . '" value="' . $value . '" not="true" />'
                            . '</urn1:conds>'
                        . '</urn1:searchFilter>'
                    . '</urn1:SearchGalRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $filter = new \Zimbra\Struct\EntrySearchFilterInfo($cond);
        $this->_api->searchGal(
            $locale, $cursor, $filter, $ref, $name, SearchType::ALL(),
            true, false, MemberOf::ALL(), true, $galAcctId, false, SortBy::NONE(), $limit, $offset
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:SearchGalRequest ref="' . $ref . '" name="' . $name . '" type="' . SearchType::ALL() . '" needExp="true" needIsOwner="false" needIsMember="' . MemberOf::ALL() . '" needSMIMECerts="true" galAcctId="' . $galAcctId . '" quick="false" sortBy="' . SortBy::NONE() . '" limit="' . $limit . '" offset="' . $offset . '">'
                        . '<urn1:locale>' . $locale . '</urn1:locale>'
                        . '<urn1:cursor id="' . $id . '" sortVal="' . $sortVal . '" endSortVal="' . $endSortVal . '" includeOffset="true" />'
                        . '<urn1:searchFilter>'
                            . '<urn1:cond attr="' . $attr . '" op="' . CondOp::EQ() . '" value="' . $value . '" not="true" />'
                        . '</urn1:searchFilter>'
                    . '</urn1:SearchGalRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testSubscribeDistributionList()
    {
        $value = md5(self::randomString());
        $dl = new \Zimbra\Account\Struct\DistributionListSelector(DLBy::NAME(), $value);

        $this->_api->subscribeDistributionList(DLSubscribeOp::SUBSCRIBE(), $dl);

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:SubscribeDistributionListRequest op="' . DLSubscribeOp::SUBSCRIBE() . '">'
                        . '<urn1:dl by="' . DLBy::NAME() . '">' . $value . '</urn1:dl>'
                    . '</urn1:SubscribeDistributionListRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testSyncGal()
    {
        $token = self::randomName();
        $galAcctId = self::randomName();
        $this->_api->syncGal($token, $galAcctId, true);

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:SyncGalRequest token="' . $token . '" galAcctId="' . $galAcctId . '" idOnly="true" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
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
