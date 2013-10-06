<?php

namespace Zimbra\Tests\API;

use Zimbra\Tests\ZimbraTestCase;
use Zimbra\Utils\SimpleXML;

/**
 * Testcase class for account api soap request.
 */
class AccountRequestTest extends ZimbraTestCase
{
    public function testAuth()
    {

        $account = new \Zimbra\Soap\Struct\AccountSelector('name', 'value');
        $preauth = new \Zimbra\Soap\Struct\PreAuth(1000, 'value', 1000);
        $authToken = new \Zimbra\Soap\Struct\AuthToken('value', true);
        $pref = new \Zimbra\Soap\Struct\Pref('name', 'value', 1000);
        $attr = new \Zimbra\Soap\Struct\Attr('name', 'value', true);

        $req = new \Zimbra\API\Account\Request\Auth(
            $account, 'password', $preauth, $authToken, 'virtualHost',
            array($pref), array($attr), 'requestedSkin', false
        );
        $this->assertSame($account, $req->account());
        $this->assertSame('password', $req->password());
        $this->assertSame($preauth, $req->preauth());
        $this->assertSame($authToken, $req->authToken());
        $this->assertSame('virtualHost', $req->virtualHost());
        $this->assertSame(array($pref), $req->prefs());
        $this->assertSame(array($attr), $req->attrs());
        $this->assertSame('requestedSkin', $req->requestedSkin());
        $this->assertFalse($req->persistAuthTokenCookie());

        $req->account($account)
            ->password('password')
            ->preauth($preauth)
            ->authToken($authToken)
            ->virtualHost('virtualHost')
            ->prefs(array($pref))
            ->attrs(array($attr))
            ->requestedSkin('requestedSkin')
            ->persistAuthTokenCookie(true);
        $this->assertSame($account, $req->account());
        $this->assertSame('password', $req->password());
        $this->assertSame($preauth, $req->preauth());
        $this->assertSame($authToken, $req->authToken());
        $this->assertSame('virtualHost', $req->virtualHost());
        $this->assertSame(array($pref), $req->prefs());
        $this->assertSame(array($attr), $req->attrs());
        $this->assertSame('requestedSkin', $req->requestedSkin());
        $this->assertTrue($req->persistAuthTokenCookie());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<AuthRequest persistAuthTokenCookie="1">'
                .'<account by="name">value</account>'
                .'<password>password</password>'
                .'<preauth timestamp="1000" expiresTimestamp="1000">value</preauth>'
                .'<authToken verifyAccount="1">value</authToken>'
                .'<virtualHost>virtualHost</virtualHost>'
                .'<prefs>'
                    .'<pref name="name" modified="1000">value</pref>'
                .'</prefs>'
                .'<attrs>'
                    .'<attr name="name" pd="1">value</attr>'
                .'</attrs>'
                .'<requestedSkin>requestedSkin</requestedSkin>'
            .'</AuthRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'AuthRequest' => array(
                'account' => array(
                    'by' => 'name',
                    '_' => 'value',
                ),
                'password' => 'password',
                'preauth' => array(
                    'timestamp' => 1000,
                    'expiresTimestamp' => 1000,
                    '_' => 'value',
                ),
                'authToken' => array(
                    'verifyAccount' => 1,
                    '_' => 'value',
                ),
                'virtualHost' => 'virtualHost',
                'prefs' => array(
                    'pref' => array(
                        array(
                            'name' => 'name',
                            'modified' => 1000,
                            '_' => 'value',
                        ),
                    ),
                ),
                'attrs' => array(
                    'attr' => array(
                        array(
                            'name' => 'name',
                            'pd' => 1,
                            '_' => 'value',
                        ),
                    ),
                ),
                'requestedSkin' => 'requestedSkin',
                'persistAuthTokenCookie' => 1,
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testAutoCompleteGal()
    {
        $req = new \Zimbra\API\Account\Request\AutoCompleteGal('name', true, 'all', 'id', 100);
        $this->assertSame('name', $req->name());
        $this->assertTrue($req->needExp());
        $this->assertSame('all', $req->type());
        $this->assertSame('id', $req->galAcctId());
        $this->assertSame(100, $req->limit());

        $req->name('name')
            ->needExp(false)
            ->type('account')
            ->galAcctId('galAcctId')
            ->limit(10);
        $this->assertSame('name', $req->name());
        $this->assertFalse($req->needExp());
        $this->assertSame('account', $req->type());
        $this->assertSame('galAcctId', $req->galAcctId());
        $this->assertSame(10, $req->limit());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<AutoCompleteGalRequest '
                .'name="name" needExp="0" type="account" galAcctId="galAcctId" limit="10" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'AutoCompleteGalRequest' => array(
                'name' => 'name',
                'needExp' => 0,
                'type' => 'account',
                'galAcctId' =>'galAcctId',
                'limit' => 10,
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testChangePassword()
    {
        $account = new \Zimbra\Soap\Struct\AccountSelector('name', 'value');
        $req = new \Zimbra\API\Account\Request\ChangePassword(
            $account, 'oldPassword', 'password', 'virtualHost'
        );

        $this->assertSame($account, $req->account());
        $this->assertSame('oldPassword', $req->oldPassword());
        $this->assertSame('password', $req->password());
        $this->assertSame('virtualHost', $req->virtualHost());

        $req->account($account)
            ->oldPassword('oldPassword')
            ->password('password')
            ->virtualHost('virtualHost');

        $this->assertSame($account, $req->account());
        $this->assertSame('oldPassword', $req->oldPassword());
        $this->assertSame('password', $req->password());
        $this->assertSame('virtualHost', $req->virtualHost());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ChangePasswordRequest>'
                .'<account by="name">value</account>'
                .'<oldPassword>oldPassword</oldPassword>'
                .'<password>password</password>'
                .'<virtualHost>virtualHost</virtualHost>'
            .'</ChangePasswordRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ChangePasswordRequest' => array(
                'account' => array(
                    'by' => 'name',
                    '_' => 'value',
                ),
                'oldPassword' => 'oldPassword',
                'password' =>'password',
                'virtualHost' => 'virtualHost',
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCheckRights()
    {
        $target = new \Zimbra\Soap\Struct\CheckRightsTargetSpec(
            'domain', 'id', 'key', array('right1', 'right2')
        );
        $req = new \Zimbra\API\Account\Request\CheckRights(array($target));
        $this->assertSame(array($target), $req->targets());

        $req->targets(array($target))
            ->addTarget($target);
        $this->assertSame(array($target, $target), $req->targets());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CheckRightsRequest>'
                .'<target type="domain" by="id" key="key">'
                    .'<right>right1</right>'
                    .'<right>right2</right>'
                .'</target>'
                .'<target type="domain" by="id" key="key">'
                    .'<right>right1</right>'
                    .'<right>right2</right>'
                .'</target>'
            .'</CheckRightsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CheckRightsRequest' => array(
                'target' => array(
                    array(
                        'type' => 'domain',
                        'by' => 'id',
                        'key' => 'key',
                        'right' => array(
                            'right1',
                            'right2',
                        ),
                    ),
                    array(
                        'type' => 'domain',
                        'by' => 'id',
                        'key' => 'key',
                        'right' => array(
                            'right1',
                            'right2',
                        ),
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateDistributionList()
    {
        $attr = new \Zimbra\Soap\Struct\KeyValuePair('key', 'value');
        $req = new \Zimbra\API\Account\Request\CreateDistributionList('n', false, array($attr));        
        $this->assertSame('n', $req->name());
        $this->assertFalse($req->dynamic());

        $req->name('name')
            ->dynamic(true);
        $this->assertSame('name', $req->name());
        $this->assertTrue($req->dynamic());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CreateDistributionListRequest name="name" dynamic="1">'
                .'<a n="key">value</a>'
            .'</CreateDistributionListRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CreateDistributionListRequest' => array(
                'name' => 'name',
                'dynamic' => 1,
                'a' => array(
                    array('n' => 'key', '_' => 'value'),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateIdentity()
    {
        $attr1 = new \Zimbra\Soap\Struct\Attr('name1', 'value1', true);
        $attr2 = new \Zimbra\Soap\Struct\Attr('name2', 'value2', false);
        $identity = new \Zimbra\Soap\Struct\Identity('name', 'id', array($attr1, $attr2));

        $req = new \Zimbra\API\Account\Request\CreateIdentity($identity);
        $this->assertSame($identity, $req->identity());

        $req->identity($identity);
        $this->assertSame($identity, $req->identity());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CreateIdentityRequest>'
                .'<identity name="name" id="id">'
                    .'<a name="name1" pd="1">value1</a>'
                    .'<a name="name2" pd="0">value2</a>'
                .'</identity>'
            .'</CreateIdentityRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CreateIdentityRequest' => array(
                'identity' => array(
                    'name' => 'name',
                    'id' => 'id',
                    'a' => array(
                        array('name' => 'name1', 'pd' => 1, '_' => 'value1'),
                        array('name' => 'name2', 'pd' => 0, '_' => 'value2'),
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateSignature()
    {
        $content = new \Zimbra\Soap\Struct\SignatureContent('value', 'text/plain');
        $signature = new \Zimbra\Soap\Struct\Signature('name', 'id', 'cid', array($content));

        $req = new \Zimbra\API\Account\Request\CreateSignature($signature);
        $this->assertSame($signature, $req->signature());

        $req->signature($signature);
        $this->assertSame($signature, $req->signature());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CreateSignatureRequest>'
                .'<signature id="id" name="name">'
                    .'<cid>cid</cid>'
                    .'<content type="text/plain">value</content>'
                .'</signature>'
            .'</CreateSignatureRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CreateSignatureRequest' => array(
                'signature' => array(
                    'name' => 'name',
                    'id' => 'id',
                    'cid' => 'cid',
                    'content' => array(
                        array('type' => 'text/plain', '_' => 'value'),
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testDeleteIdentity()
    {
        $identity = new \Zimbra\Soap\Struct\NameId('name', 'id');
        $req = new \Zimbra\API\Account\Request\DeleteIdentity($identity);
        $this->assertSame($identity, $req->identity());

        $req->identity($identity);
        $this->assertSame($identity, $req->identity());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<DeleteIdentityRequest>'
                .'<identity name="name" id="id" />'
            .'</DeleteIdentityRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'DeleteIdentityRequest' => array(
                'identity' => array(
                    'name' => 'name',
                    'id' => 'id',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testDeleteSignature()
    {
        $signature = new \Zimbra\Soap\Struct\NameId('name', 'id');
        $req = new \Zimbra\API\Account\Request\DeleteSignature($signature);
        $this->assertSame($signature, $req->signature());

        $req->signature($signature);
        $this->assertSame($signature, $req->signature());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<DeleteSignatureRequest>'
                .'<signature name="name" id="id" />'
            .'</DeleteSignatureRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'DeleteSignatureRequest' => array(
                'signature' => array(
                    'name' => 'name',
                    'id' => 'id',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testDiscoverRights()
    {
        $req = new \Zimbra\API\Account\Request\DiscoverRights(array('right1', 'right2'));
        $this->assertSame(array('right1', 'right2'), $req->rights());

        $req->rights(array('right1', 'right2'));
        $this->assertSame(array('right1', 'right2'), $req->rights());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<DiscoverRightsRequest>'
                .'<right>right1</right>'
                .'<right>right2</right>'
            .'</DiscoverRightsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'DiscoverRightsRequest' => array(
                'right' => array(
                    'right1',
                    'right2',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testDistributionListAction()
    {
        $subsReq = new \Zimbra\Soap\Struct\DistributionListSubscribeReq('subscribe', 'value', true);
        $owner = new \Zimbra\Soap\Struct\DistributionListGranteeSelector('usr', 'id', 'value');
        $grantee = new \Zimbra\Soap\Struct\DistributionListGranteeSelector('all', 'name', 'value');
        $right = new \Zimbra\Soap\Struct\DistributionListRightSpec('right', array($grantee));
        $kpv = new \Zimbra\Soap\Struct\KeyValuePair('key', 'value');
        $action = new \Zimbra\Soap\Struct\DistributionListAction('modify', 'newName', $subsReq, array('dlm'), array($owner), array($right), array($kpv));

        $dl = new \Zimbra\Soap\Struct\DistributionListSelector('name', 'value');
        $attr = new \Zimbra\Soap\Struct\Attr('name', 'value', true);

        $req = new \Zimbra\API\Account\Request\DistributionListAction($dl, $action, array($attr));
        $this->assertSame($dl, $req->dl());
        $this->assertSame($action, $req->action());
        $this->assertSame(array($attr), $req->attrs());

        $req->dl($dl)
            ->action($action)
            ->attrs(array($attr))
            ->addAttr($attr);
        $this->assertSame($dl, $req->dl());
        $this->assertSame($action, $req->action());
        $this->assertSame(array($attr, $attr), $req->attrs());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<DistributionListActionRequest>'
                .'<dl by="name">value</dl>'
                .'<action op="modify">'
                    .'<newName>newName</newName>'
                    .'<subsReq op="subscribe" bccOwners="1">value</subsReq>'
                    .'<dlm>dlm</dlm>'
                    .'<owner type="usr" by="id">value</owner>'
                    .'<right right="right">'
                        .'<grantee type="all" by="name">value</grantee>'
                    .'</right>'
                    .'<a n="key">value</a>'
                .'</action>'
                .'<a name="name" pd="1">value</a>'
                .'<a name="name" pd="1">value</a>'
            .'</DistributionListActionRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'DistributionListActionRequest' => array(
                'dl' => array(
                    'by' => 'name',
                    '_' => 'value',
                ),
                'action' => array(
                    'op' => 'modify',
                    'newName' => 'newName',
                    'subsReq' => array(
                        'op' => 'subscribe',
                        '_' => 'value',
                        'bccOwners' => 1,
                    ),
                    'dlm' => array('dlm'),
                    'owner' => array(
                        array(
                            'type' => 'usr',
                            '_' => 'value',
                            'by' => 'id',
                        ),
                    ),
                    'right' => array(
                        array(
                            'right' => 'right',
                            'grantee' => array(
                                array(
                                    'type' => 'all',
                                    '_' => 'value',
                                    'by' => 'name',
                                ),
                            ),
                        ),
                    ),
                    'a' => array(
                        array(
                            'n' => 'key',
                            '_' => 'value',
                        ),
                    ),
                ),
                'a' => array(
                    array(
                        'name' => 'name',
                        'pd' => '1',
                        '_' => 'value',
                    ),
                    array(
                        'name' => 'name',
                        'pd' => '1',
                        '_' => 'value',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testEndSession()
    {
        $req = new \Zimbra\API\Account\Request\EndSession;

        $xml = '<?xml version="1.0"?>'."\n"
            .'<EndSessionRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'EndSessionRequest' => array(),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAccountDistributionLists()
    {
        $req = new \Zimbra\API\Account\Request\GetAccountDistributionLists(false, 'directOnly', 'attr');
        $this->assertFalse($req->ownerOf());
        $this->assertSame('directOnly', $req->memberOf());
        $this->assertSame('attr', $req->attrs());

        $req->ownerOf(true)
            ->memberOf('all')
            ->attrs('attrs');
        $this->assertTrue($req->ownerOf());
        $this->assertSame('all', $req->memberOf());
        $this->assertSame('attrs', $req->attrs());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetAccountDistributionListsRequest ownerOf="1" memberOf="all" attrs="attrs" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetAccountDistributionListsRequest' => array(
                'ownerOf' => 1,
                'memberOf' => 'all',
                'attrs' => 'attrs',
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAccountInfo()
    {
        $account = new \Zimbra\Soap\Struct\AccountSelector('name', 'value');

        $req = new \Zimbra\API\Account\Request\GetAccountInfo($account);
        $this->assertSame($account, $req->account());

        $req->account($account);
        $this->assertSame($account, $req->account());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetAccountInfoRequest>'
                .'<account by="name">value</account>'
            .'</GetAccountInfoRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetAccountInfoRequest' => array(
                'account' => array(
                    'by' => 'name',
                    '_' => 'value',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAllLocales()
    {
        $req = new \Zimbra\API\Account\Request\GetAllLocales;

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetAllLocalesRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetAllLocalesRequest' => array(),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAvailableCsvFormats()
    {
        $req = new \Zimbra\API\Account\Request\GetAvailableCsvFormats;

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetAvailableCsvFormatsRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetAvailableCsvFormatsRequest' => array(),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAvailableLocales()
    {
        $req = new \Zimbra\API\Account\Request\GetAvailableLocales;

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetAvailableLocalesRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetAvailableLocalesRequest' => array(),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAvailableSkins()
    {
        $req = new \Zimbra\API\Account\Request\GetAvailableSkins;

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetAvailableSkinsRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetAvailableSkinsRequest' => array(),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetDistributionList()
    {
        $dl = new \Zimbra\Soap\Struct\DistributionListSelector('name', 'value');
        $attr = new \Zimbra\Soap\Struct\Attr('name', 'value', true);
        $req = new \Zimbra\API\Account\Request\GetDistributionList($dl, false, 'sendToDistList', array($attr));

        $this->assertSame($dl, $req->dl());
        $this->assertFalse($req->needOwners());
        $this->assertSame('sendToDistList', $req->needRights());
        $this->assertSame(array($attr), $req->attrs());

        $req->dl($dl)
            ->needOwners(true)
            ->needRights('sendToDistList,viewDistList')
            ->attrs(array($attr))
            ->addAttr($attr);
        $this->assertSame($dl, $req->dl());
        $this->assertTrue($req->needOwners());
        $this->assertSame('sendToDistList,viewDistList', $req->needRights());
        $this->assertSame(array($attr, $attr), $req->attrs());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetDistributionListRequest needOwners="1" needRights="sendToDistList,viewDistList">'
                .'<dl by="name">value</dl>'
                .'<a name="name" pd="1">value</a>'
                .'<a name="name" pd="1">value</a>'
            .'</GetDistributionListRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetDistributionListRequest' => array(
                'needOwners' => 1,
                'needRights' => 'sendToDistList,viewDistList',
                'dl' => array(
                    'by' => 'name',
                    '_' => 'value',
                ),
                'a' => array(
                    array('name' => 'name', 'pd' => 1, '_' => 'value'),
                    array('name' => 'name', 'pd' => 1, '_' => 'value'),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function getGetDistributionListMembers()
    {
        $req = new \Zimbra\API\Account\Request\GetDistributionListMembers('dl', 100, 0);
        $this->assertSame('dl', $req->dl());
        $this->assertSame(100, $req->limit());
        $this->assertSame(0, $req->offset());

        $req->dl('name')
            ->limit(10)
            ->offset(10);
        $this->assertSame('name', $req->dl());
        $this->assertSame(10, $req->limit());
        $this->assertSame(10, $req->offset());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetDistributionListMembersRequest limit="10" offset="10">'
                .'<dl>name</dl>'
            .'</GetDistributionListRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetDistributionListRequest' => array(
                'dl' => 'name',
                'limit' => 10,
                'offset' => 10,
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetIdentities()
    {
        $req = new \Zimbra\API\Account\Request\GetIdentities;

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetIdentitiesRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetIdentitiesRequest' => array(),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function getGetInfo()
    {
        $req = new \Zimbra\API\Account\Request\GetInfo('a,mbox,b,prefs,c', 'rights');
        $this->assertSame('mbox,prefs', $req->sections());
        $this->assertSame('rights', $req->rights());

        $req->sections('x,attrs,y,zimlets,z')
            ->rights('rights');
        $this->assertSame('attrs,zimlets', $req->sections());
        $this->assertSame('rights', $req->rights());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetInfoRequest sections="attrs,zimlets" rights="rights" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetInfoRequest' => array(
                'sections' => 'attrs,zimlets',
                'rights' => 'rights',
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function getGetPrefs()
    {
        $pref = \Zimbra\Soap\Struct\Pref('name', 'value', 1000);
        $req = new \Zimbra\API\Account\Request\GetPrefs(array($pref));
        $this->assertSame(array($pref), $req->prefs());

        $req->prefs(array($pref))
            ->addPref($pref);
        $this->assertSame(array($pref, $pref), $req->prefs());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetPrefsRequest>'
                .'<pref name="name" modified="1000">value</pref>'
                .'<pref name="name" modified="1000">value</pref>'
            .'</GetPrefsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetPrefsRequest' => array(
                'pref' => array(
                    array(
                        'name' => 'name', 'modified' => 1000, '_' => 'value',
                    ),
                    array(
                        'name' => 'name', 'modified' => 1000, '_' => 'value',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function getGetRights()
    {
        $right = \Zimbra\Soap\Struct\Right('right');
        $req = new \Zimbra\API\Account\Request\GetPrefs(array($right));    
        $this->assertSame(array($right), $req->rights());

        $req->rights(array($right))
            ->addPref($right);
        $this->assertSame(array($right, $right), $req->rights());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetRightsRequest>'
                .'<ace right="right" />'
                .'<ace right="right" />'
            .'</GetRightsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetRightsRequest' => array(
                'ace' => array(
                    array('right' => 'right'),
                    array('right' => 'right'),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyIdentity()
    {
        $attr = new \Zimbra\Soap\Struct\Attr('name', 'value', true);
        $identity = new \Zimbra\Soap\Struct\Identity('name', 'id', array($attr));

        $req = new \Zimbra\API\Account\Request\ModifyIdentity($identity);    
        $this->assertSame($identity, $req->identity());
        $req->identity($identity);
        $this->assertSame($identity, $req->identity());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ModifyIdentityRequest>'
                .'<identity name="name" id="id">'
                    .'<a name="name" pd="1">value</a>'
                .'</identity>'
            .'</ModifyIdentityRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ModifyIdentityRequest' => array(
                'identity' => array(
                    'name' => 'name',
                    'id' => 'id',
                    'a' => array(
                        array(
                            'name' => 'name',
                            '_' => 'value',
                            'pd' => 1,
                        ),
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyPrefs()
    {
        $pref = new \Zimbra\Soap\Struct\Pref('name', 'value', 1000);
        $req = new \Zimbra\API\Account\Request\ModifyPrefs(array($pref));
        $this->assertSame(array($pref), $req->prefs());

        $req->prefs(array($pref))
            ->addPref($pref);
        $this->assertSame(array($pref, $pref), $req->prefs());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ModifyPrefsRequest>'
                .'<pref name="name" modified="1000">value</pref>'
                .'<pref name="name" modified="1000">value</pref>'
            .'</ModifyPrefsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ModifyPrefsRequest' => array(
                'pref' => array(
                    array(
                        'name' => 'name', 'modified' => 1000, '_' => 'value',
                    ),
                    array(
                        'name' => 'name', 'modified' => 1000, '_' => 'value',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyProperties()
    {
        $prop = new \Zimbra\Soap\Struct\Prop('zimlet', 'name', 'value');
        $req = new \Zimbra\API\Account\Request\ModifyProperties(array($prop));
        $this->assertSame(array($prop), $req->props());

        $req->props(array($prop))
            ->addProp($prop);
        $this->assertSame(array($prop, $prop), $req->props());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ModifyPropertiesRequest>'
                .'<prop zimlet="zimlet" name="name">value</prop>'
                .'<prop zimlet="zimlet" name="name">value</prop>'
            .'</ModifyPropertiesRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ModifyPropertiesRequest' => array(
                'prop' => array(
                    array(
                        'zimlet' => 'zimlet', 'name' => 'name', '_' => 'value',
                    ),
                    array(
                        'zimlet' => 'zimlet', 'name' => 'name', '_' => 'value',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifySignature()
    {
        $content = new \Zimbra\Soap\Struct\SignatureContent('value', 'text/html');
        $signature = new \Zimbra\Soap\Struct\Signature('name', 'id', 'cid', array($content));

        $req = new \Zimbra\API\Account\Request\ModifySignature($signature);
        $this->assertSame($signature, $req->signature());
        $req->signature($signature);
        $this->assertSame($signature, $req->signature());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ModifySignatureRequest>'
                .'<signature name="name" id="id">'
                    .'<cid>cid</cid>'
                    .'<content type="text/html">value</content>'
                .'</signature>'
            .'</ModifySignatureRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ModifySignatureRequest' => array(
                'signature' => array(
                    'name' => 'name',
                    'id' => 'id',
                    'cid' => 'cid',
                    'content' => array(
                        array(
                            'type' => 'text/html',
                            '_' => 'value',
                        ),
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyWhiteBlackList()
    {
        $white = new \Zimbra\Soap\Struct\OpValue('+', 'white');
        $black = new \Zimbra\Soap\Struct\OpValue('-', 'black');

        $req = new \Zimbra\API\Account\Request\ModifyWhiteBlackList(array($white), array($black));
        $this->assertSame(array($white), $req->whiteList());
        $this->assertSame(array($black), $req->blackList());

        $req->whiteList(array($white))
            ->addToWhiteList($black)
            ->blackList(array($black))
            ->addToBlackList($white);
        $this->assertSame(array($white, $black), $req->whiteList());
        $this->assertSame(array($black, $white), $req->blackList());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ModifyWhiteBlackListRequest>'
                .'<whiteList>'
                    .'<addr op="+">white</addr>'
                    .'<addr op="-">black</addr>'
                .'</whiteList>'
                .'<blackList>'
                    .'<addr op="-">black</addr>'
                    .'<addr op="+">white</addr>'
                .'</blackList>'
            .'</ModifyWhiteBlackListRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ModifyWhiteBlackListRequest' => array(
                'whiteList' => array(
                    'addr' => array(
                        array(
                            'op' => '+',
                            '_' => 'white',
                        ),
                        array(
                            'op' => '-',
                            '_' => 'black',
                        ),
                    ),
                ),
                'blackList' => array(
                    'addr' => array(
                        array(
                            'op' => '-',
                            '_' => 'black',
                        ),
                        array(
                            'op' => '+',
                            '_' => 'white',
                        ),
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyZimletPrefs()
    {
        $zimlet = new \Zimbra\Soap\Struct\ZimletPrefsSpec('name', 'enabled');
        $req = new \Zimbra\API\Account\Request\ModifyZimletPrefs(array($zimlet));
        $this->assertSame(array($zimlet), $req->zimlets());

        $req->zimlets(array($zimlet))
            ->addZimlet($zimlet);
        $this->assertSame(array($zimlet, $zimlet), $req->zimlets());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ModifyZimletPrefsRequest>'
                .'<zimlet name="name" presence="enabled" />'
                .'<zimlet name="name" presence="enabled" />'
            .'</ModifyZimletPrefsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ModifyZimletPrefsRequest' => array(
                'zimlet' => array(
                    array(
                        'name' => 'name',
                        'presence' => 'enabled',
                    ),
                    array(
                        'name' => 'name',
                        'presence' => 'enabled',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testRevokeRights()
    {
        $ace = new \Zimbra\Soap\Struct\AccountACEInfo('all', 'viewFreeBusy', 'zid', 'dir', 'key', 'pw', true, false);
        $req = new \Zimbra\API\Account\Request\RevokeRights(array($ace));
        $this->assertSame(array($ace), $req->aces());

        $req->aces(array($ace))
            ->addAce($ace);
        $this->assertSame(array($ace, $ace), $req->aces());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<RevokeRightsRequest>'
                .'<ace gt="all" right="viewFreeBusy" zid="zid" d="dir" key="key" pw="pw" deny="1" chkgt="0" />'
                .'<ace gt="all" right="viewFreeBusy" zid="zid" d="dir" key="key" pw="pw" deny="1" chkgt="0" />'
            .'</RevokeRightsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'RevokeRightsRequest' => array(
                'ace' => array(
                    array(
                        'gt' => 'all',
                        'right' => 'viewFreeBusy',
                        'zid' => 'zid',
                        'd' => 'dir',
                        'key' => 'key',
                        'pw' => 'pw',
                        'deny' => 1,
                        'chkgt' => 0,
                    ),
                    array(
                        'gt' => 'all',
                        'right' => 'viewFreeBusy',
                        'zid' => 'zid',
                        'd' => 'dir',
                        'key' => 'key',
                        'pw' => 'pw',
                        'deny' => 1,
                        'chkgt' => 0,
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testSearchCalendarResources()
    {
        $cursor = new \Zimbra\Soap\Struct\CursorInfo('id','sortVal', 'endSortVal', true);

        $otherCond = new \Zimbra\Soap\Struct\EntrySearchFilterSingleCond('attr', 'ge', 'value', false);
        $otherConds = new \Zimbra\Soap\Struct\EntrySearchFilterMultiCond(0, 1, NULL, $otherCond);
        $cond = new \Zimbra\Soap\Struct\EntrySearchFilterSingleCond('a', 'eq', 'v', true);
        $conds = new \Zimbra\Soap\Struct\EntrySearchFilterMultiCond(1, 0, $otherConds, $cond);
        $filter = new \Zimbra\Soap\Struct\EntrySearchFilterInfo($conds, $cond);

        $req = new \Zimbra\API\Account\Request\SearchCalendarResources(
            $cursor, $filter, 'name', 'locale', false, 'sortBy', 100, 100, 'galAcctId', 'attrs'
        );
        $this->assertSame($cursor, $req->cursor());
        $this->assertSame($filter, $req->searchFilter());
        $this->assertSame('name', $req->name());
        $this->assertSame('locale', $req->locale());
        $this->assertFalse($req->quick());
        $this->assertSame('sortBy', $req->sortBy());
        $this->assertSame(100, $req->limit());
        $this->assertSame(100, $req->offset());
        $this->assertSame('galAcctId', $req->galAcctId());
        $this->assertSame('attrs', $req->attrs());

        $req->cursor($cursor)
            ->searchFilter($filter)
            ->name('name')
            ->locale('locale')
            ->quick(true)
            ->sortBy('sortBy')
            ->limit(10)
            ->offset(10)
            ->galAcctId('galAcctId')
            ->attrs('attrs');
        $this->assertSame($cursor, $req->cursor());
        $this->assertSame($filter, $req->searchFilter());
        $this->assertSame('name', $req->name());
        $this->assertSame('locale', $req->locale());
        $this->assertTrue($req->quick());
        $this->assertSame('sortBy', $req->sortBy());
        $this->assertSame(10, $req->limit());
        $this->assertSame(10, $req->offset());
        $this->assertSame('galAcctId', $req->galAcctId());
        $this->assertSame('attrs', $req->attrs());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<SearchCalendarResourcesRequest name="name" locale="locale" quick="1" sortBy="sortBy" limit="10" offset="10" galAcctId="galAcctId" attrs="attrs">'
                .'<cursor id="id" sortVal="sortVal" endSortVal="endSortVal" includeOffset="1" />'
                .'<searchFilter>'
                    .'<conds not="1" or="0">'
                        .'<conds not="0" or="1">'
                            .'<cond attr="attr" op="ge" value="value" not="0" />'
                        .'</conds>'
                        .'<cond attr="a" op="eq" value="v" not="1" />'
                    .'</conds>'
                    .'<cond attr="a" op="eq" value="v" not="1" />'
                .'</searchFilter>'
            .'</SearchCalendarResourcesRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'SearchCalendarResourcesRequest' => array(
                'name' => 'name',
                'locale' => 'locale',
                'quick' => 1,
                'sortBy' => 'sortBy',
                'limit' => 10,
                'offset' => 10,
                'galAcctId' => 'galAcctId',
                'attrs' => 'attrs',
                'cursor' => array(
                    'id' => 'id',
                    'sortVal' => 'sortVal',
                    'endSortVal' => 'endSortVal',
                    'includeOffset' => 1,
                ),
                'searchFilter' => array(
                    'conds' => array(
                        'not' => 1,
                        'or' => 0,
                        'conds' => array(
                            'not' => 0,
                            'or' => 1,
                            'cond' => array(
                                'attr' => 'attr',
                                'op' => 'ge',
                                'value' => 'value',
                                'not' => 0,
                            ),
                        ),
                        'cond' => array(
                            'attr' => 'a',
                            'op' => 'eq',
                            'value' => 'v',
                            'not' => 1,
                        ),
                    ),
                    'cond' => array(
                        'attr' => 'a',
                        'op' => 'eq',
                        'value' => 'v',
                        'not' => 1,
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testSearchGal()
    {
        $cursor = new \Zimbra\Soap\Struct\CursorInfo('id','sortVal', 'endSortVal', true);

        $otherCond = new \Zimbra\Soap\Struct\EntrySearchFilterSingleCond('attr', 'ge', 'value', false);
        $otherConds = new \Zimbra\Soap\Struct\EntrySearchFilterMultiCond(0, 1, NULL, $otherCond);
        $cond = new \Zimbra\Soap\Struct\EntrySearchFilterSingleCond('a', 'eq', 'v', true);
        $conds = new \Zimbra\Soap\Struct\EntrySearchFilterMultiCond(1, 0, $otherConds, $cond);
        $filter = new \Zimbra\Soap\Struct\EntrySearchFilterInfo($conds, $cond);

        $req = new \Zimbra\API\Account\Request\SearchGal(
            $cursor, $filter, 'locale', 'ref', 'name', 'all',
            true, false, 'all', true, 'galAcctId', false, 'none', 100, 100
        );
        $this->assertSame($cursor, $req->cursor());
        $this->assertSame($filter, $req->searchFilter());
        $this->assertSame('locale', $req->locale());
        $this->assertSame('ref', $req->ref());
        $this->assertSame('name', $req->name());
        $this->assertSame('all', $req->type());
        $this->assertTrue($req->needExp());
        $this->assertFalse($req->needIsOwner());
        $this->assertSame('all', $req->needIsMember());
        $this->assertTrue($req->needSMIMECerts());
        $this->assertSame('galAcctId', $req->galAcctId());
        $this->assertFalse($req->quick());
        $this->assertSame('none', $req->sortBy());
        $this->assertSame(100, $req->limit());
        $this->assertSame(100, $req->offset());

        $req->cursor($cursor)
            ->searchFilter($filter)
            ->locale('locale')
            ->ref('ref')
            ->name('name')
            ->type('account')
            ->needExp(true)
            ->needIsOwner(true)
            ->needIsMember('directOnly')
            ->needSMIMECerts(true)
            ->galAcctId('galAcctId')
            ->quick(true)
            ->sortBy('dateAsc')
            ->limit(10)
            ->offset(10);
        $this->assertSame($cursor, $req->cursor());
        $this->assertSame($filter, $req->searchFilter());
        $this->assertSame('locale', $req->locale());
        $this->assertSame('ref', $req->ref());
        $this->assertSame('name', $req->name());
        $this->assertSame('account', $req->type());
        $this->assertTrue($req->needExp());
        $this->assertTrue($req->needIsOwner());
        $this->assertSame('directOnly', $req->needIsMember());
        $this->assertTrue($req->needSMIMECerts());
        $this->assertSame('galAcctId', $req->galAcctId());
        $this->assertTrue($req->quick());
        $this->assertSame('dateAsc', $req->sortBy());
        $this->assertSame(10, $req->limit());
        $this->assertSame(10, $req->offset());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<SearchGalRequest locale="locale" ref="ref" name="name" type="account" needExp="1" needIsOwner="1" needIsMember="directOnly" needSMIMECerts="1" galAcctId="galAcctId" quick="1" sortBy="dateAsc" limit="10" offset="10">'
                .'<cursor id="id" sortVal="sortVal" endSortVal="endSortVal" includeOffset="1" />'
                .'<searchFilter>'
                    .'<conds not="1" or="0">'
                        .'<conds not="0" or="1">'
                            .'<cond attr="attr" op="ge" value="value" not="0" />'
                        .'</conds>'
                        .'<cond attr="a" op="eq" value="v" not="1" />'
                    .'</conds>'
                    .'<cond attr="a" op="eq" value="v" not="1" />'
                .'</searchFilter>'
            .'</SearchGalRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'SearchGalRequest' => array(
                'locale' => 'locale',
                'ref' => 'ref',
                'name' => 'name',
                'type' => 'account',
                'needExp' => 1,
                'needIsOwner' => 1,
                'needIsMember' => 'directOnly',
                'needSMIMECerts' => 1,
                'galAcctId' => 'galAcctId',
                'quick' => 1,
                'sortBy' => 'dateAsc',
                'limit' => 10,
                'offset' => 10,
                'cursor' => array(
                    'id' => 'id',
                    'sortVal' => 'sortVal',
                    'endSortVal' => 'endSortVal',
                    'includeOffset' => 1,
                ),
                'searchFilter' => array(
                    'conds' => array(
                        'not' => 1,
                        'or' => 0,
                        'conds' => array(
                            'not' => 0,
                            'or' => 1,
                            'cond' => array(
                                'attr' => 'attr',
                                'op' => 'ge',
                                'value' => 'value',
                                'not' => 0,
                            ),
                        ),
                        'cond' => array(
                            'attr' => 'a',
                            'op' => 'eq',
                            'value' => 'v',
                            'not' => 1,
                        ),
                    ),
                    'cond' => array(
                        'attr' => 'a',
                        'op' => 'eq',
                        'value' => 'v',
                        'not' => 1,
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testSubscribeDistributionList()
    {
        $dl = new \Zimbra\Soap\Struct\DistributionListSelector('name', 'value');
        $req = new \Zimbra\API\Account\Request\SubscribeDistributionList('unsubscribe', $dl);
        $this->assertSame('unsubscribe', $req->op());
        $this->assertSame($dl, $req->dl());

        $req->op('subscribe ')
            ->dl($dl);
        $this->assertSame('subscribe', $req->op());
        $this->assertSame($dl, $req->dl());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<SubscribeDistributionListRequest op="subscribe">'
                .'<dl by="name">value</dl>'
            .'</SubscribeDistributionListRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'SubscribeDistributionListRequest' => array(
                'op' => 'subscribe',
                'dl' => array(
                    'by' => 'name',
                    '_' => 'value',
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testSyncGal()
    {
        $req = new \Zimbra\API\Account\Request\SyncGal('token', 'galAcctId', false);
        $this->assertSame('token', $req->token());
        $this->assertSame('galAcctId', $req->galAcctId());
        $this->assertFalse($req->idOnly());

        $req->token('token ')
            ->galAcctId('galAcctId')
            ->idOnly(true);
        $this->assertSame('token', $req->token());
        $this->assertSame('galAcctId', $req->galAcctId());
        $this->assertTrue($req->idOnly());


        $xml = '<?xml version="1.0"?>'."\n"
            .'<SyncGalRequest token="token" galAcctId="galAcctId" idOnly="1" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'SyncGalRequest' => array(
                'token' => 'token',
                'galAcctId' => 'galAcctId',
                'idOnly' => 1,
            )
        );
        $this->assertEquals($array, $req->toArray());
    }
}
