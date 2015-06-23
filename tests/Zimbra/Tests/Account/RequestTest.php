<?php

namespace Zimbra\Tests\Account;

use Zimbra\Tests\ZimbraTestCase;

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

/**
 * Testcase class for account request.
 */
class RequestTest extends ZimbraTestCase
{
    public function testAuth()
    {
        $name = self::randomName();
        $value = md5(self::randomString());
        $password = md5(self::randomString());
        $virtualHost = self::randomName();
        $requestedSkin = self::randomName();
        $time = time();

        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), $value);
        $preauth = new \Zimbra\Account\Struct\PreAuth($time, $value, $time);
        $authToken = new \Zimbra\Account\Struct\AuthToken($value, true);

        $attr = new \Zimbra\Account\Struct\Attr($name, $value, true);
        $attrs = new \Zimbra\Account\Struct\AuthAttrs([$attr]);

        $pref = new \Zimbra\Account\Struct\Pref($name, $value, $time);
        $prefs = new \Zimbra\Account\Struct\AuthPrefs([$pref]);

        $req = new \Zimbra\Account\Request\Auth(
            $account, $password, $preauth, $authToken, $virtualHost,
            $prefs, $attrs, $requestedSkin, false
        );
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertSame($account, $req->getAccount());
        $this->assertSame($password, $req->getPassword());
        $this->assertSame($preauth, $req->getPreAuth());
        $this->assertSame($authToken, $req->getAuthToken());
        $this->assertSame($virtualHost, $req->getVirtualHost());
        $this->assertSame($prefs, $req->getPrefs());
        $this->assertSame($attrs, $req->getAttrs());
        $this->assertSame($requestedSkin, $req->getRequestedSkin());
        $this->assertFalse($req->getPersistAuthTokenCookie());

        $req->setAccount($account)
            ->setPassword($password)
            ->setPreAuth($preauth)
            ->setAuthToken($authToken)
            ->setVirtualHost($virtualHost)
            ->setPrefs($prefs)
            ->setAttrs($attrs)
            ->setRequestedSkin($requestedSkin)
            ->setPersistAuthTokenCookie(true);
        $this->assertSame($account, $req->getAccount());
        $this->assertSame($password, $req->getPassword());
        $this->assertSame($preauth, $req->getPreAuth());
        $this->assertSame($authToken, $req->getAuthToken());
        $this->assertSame($virtualHost, $req->getVirtualHost());
        $this->assertSame($prefs, $req->getPrefs());
        $this->assertSame($attrs, $req->getAttrs());
        $this->assertSame($requestedSkin, $req->getRequestedSkin());
        $this->assertTrue($req->getPersistAuthTokenCookie());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AuthRequest persistAuthTokenCookie="true">'
                . '<account by="' . AccountBy::NAME() . '">' . $value . '</account>'
                . '<password>' . $password . '</password>'
                . '<preauth timestamp="' . $time . '" expiresTimestamp="' . $time . '">' . $value . '</preauth>'
                . '<authToken verifyAccount="true">' . $value . '</authToken>'
                . '<virtualHost>' . $virtualHost . '</virtualHost>'
                . '<prefs>'
                    . '<pref name="' . $name . '" modified="' . $time . '">' . $value . '</pref>'
                . '</prefs>'
                . '<attrs>'
                    . '<attr name="' . $name . '" pd="true">' . $value . '</attr>'
                . '</attrs>'
                . '<requestedSkin>' . $requestedSkin . '</requestedSkin>'
            . '</AuthRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'AuthRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'account' => [
                    'by' => AccountBy::NAME()->value(),
                    '_content' => $value,
                ],
                'password' => $password,
                'preauth' => [
                    'timestamp' => $time,
                    'expiresTimestamp' => $time,
                    '_content' => $value,
                ],
                'authToken' => [
                    'verifyAccount' => true,
                    '_content' => $value,
                ],
                'virtualHost' => $virtualHost,
                'prefs' => [
                    'pref' => [
                        [
                            'name' => $name,
                            'modified' => $time,
                            '_content' => $value,
                        ],
                    ],
                ],
                'attrs' => [
                    'attr' => [
                        [
                            'name' => $name,
                            'pd' => true,
                            '_content' => $value,
                        ],
                    ],
                ],
                'requestedSkin' => $requestedSkin,
                'persistAuthTokenCookie' => true,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testAutoCompleteGal()
    {
        $name = self::randomName();
        $id = md5(self::randomString());
        $limit = mt_rand(0, 100);

        $req = new \Zimbra\Account\Request\AutoCompleteGal($name, true, SearchType::ALL(), $id, $limit);
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertSame($name, $req->getName());
        $this->assertTrue($req->getNeedExp());
        $this->assertSame('all', $req->getType()->value());
        $this->assertSame($id, $req->getGalAccountId());
        $this->assertSame($limit, $req->getLimit());

        $req->setName($name)
            ->setNeedExp(false)
            ->setType(SearchType::ACCOUNT())
            ->setGalAccountId($id)
            ->setLimit($limit);
        $this->assertSame($name, $req->getName());
        $this->assertFalse($req->getNeedExp());
        $this->assertSame('account', $req->getType()->value());
        $this->assertSame($id, $req->getGalAccountId());
        $this->assertSame($limit, $req->getLimit());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AutoCompleteGalRequest '
                . 'needExp="false" name="' . $name . '" type="' .SearchType::ACCOUNT() . '" galAcctId="' . $id . '" limit="' . $limit . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'AutoCompleteGalRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'name' => $name,
                'needExp' => false,
                'type' => SearchType::ACCOUNT()->value(),
                'galAcctId' => $id,
                'limit' => $limit,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testBaseRequest()
    {
        $req = $this->getMockForAbstractClass('\Zimbra\Account\Request\Base');
        $this->assertInstanceOf('Zimbra\Soap\Request', $req);
        $this->assertEquals('urn:zimbraAccount', $req->getXmlNamespace());

        $req = $this->getMockForAbstractClass('\Zimbra\Account\Request\BaseAttr');
        $this->assertInstanceOf('Zimbra\Soap\Request', $req);
        $this->assertEquals('urn:zimbraAccount', $req->getXmlNamespace());
    }

    public function testChangePassword()
    {
        $value = md5(self::randomString());
        $oldPassword = md5(self::randomString());
        $password = md5(self::randomString());
        $virtualHost = self::randomName();

        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), $value);
        $req = new \Zimbra\Account\Request\ChangePassword(
            $account, $oldPassword, $password, $virtualHost
        );
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);

        $this->assertSame($account, $req->getAccount());
        $this->assertSame($oldPassword, $req->getOldPassword());
        $this->assertSame($password, $req->getPassword());
        $this->assertSame($virtualHost, $req->getVirtualHost());

        $req->setAccount($account)
            ->setOldPassword($oldPassword)
            ->setPassword($password)
            ->setVirtualHost($virtualHost);

        $this->assertSame($account, $req->getAccount());
        $this->assertSame($oldPassword, $req->getOldPassword());
        $this->assertSame($password, $req->getPassword());
        $this->assertSame($virtualHost, $req->getVirtualHost());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ChangePasswordRequest>'
                . '<account by="' . AccountBy::NAME() . '">' . $value . '</account>'
                . '<oldPassword>' . $oldPassword . '</oldPassword>'
                . '<password>' . $password . '</password>'
                . '<virtualHost>' . $virtualHost . '</virtualHost>'
            . '</ChangePasswordRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ChangePasswordRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'account' => [
                    'by' => AccountBy::NAME()->value(),
                    '_content' => $value,
                ],
                'oldPassword' => $oldPassword,
                'password' => $password,
                'virtualHost' => $virtualHost,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testCheckRights()
    {
        $key = self::randomName();
        $right1 = self::randomName();
        $right2 = self::randomName();

        $target = new \Zimbra\Account\Struct\CheckRightsTargetSpec(
            TargetType::DOMAIN(), TargetBy::ID(), $key, [$right1, $right2]
        );
        $req = new \Zimbra\Account\Request\CheckRights([$target]);
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertSame([$target], $req->getTargets()->all());

        $req->addTarget($target);
        $this->assertSame([$target, $target], $req->getTargets()->all());
        $req->getTargets()->remove(1);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CheckRightsRequest>'
                . '<target type="' . TargetType::DOMAIN() . '" by="' . TargetBy::ID() . '" key="' . $key . '">'
                    . '<right>' . $right1 . '</right>'
                    . '<right>' . $right2 . '</right>'
                . '</target>'
            . '</CheckRightsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'CheckRightsRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'target' => [
                    [
                        'type' => TargetType::DOMAIN()->value(),
                        'by' => TargetBy::ID()->value(),
                        'key' => $key,
                        'right' => [
                            $right1,
                            $right2,
                        ],
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateDistributionList()
    {
        $key = self::randomName();
        $value = md5(self::randomString());
        $name = self::randomName();

        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);
        $req = new \Zimbra\Account\Request\CreateDistributionList($name, false, [$attr]);        
        $this->assertInstanceOf('Zimbra\Account\Request\BaseAttr', $req);
        $this->assertSame($name, $req->getName());
        $this->assertFalse($req->getDynamic());

        $req->setName($name)
            ->setDynamic(true);
        $this->assertSame($name, $req->getName());
        $this->assertTrue($req->getDynamic());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CreateDistributionListRequest name="' . $name . '" dynamic="true">'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</CreateDistributionListRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'CreateDistributionListRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'name' => $name,
                'dynamic' => true,
                'a' => [
                    [
                        'n' => $key,
                        '_content' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateIdentity()
    {
        $value = md5(self::randomString());
        $name = self::randomName();
        $id = self::randomName();

        $attr = new \Zimbra\Account\Struct\Attr($name, $value, true);
        $identity = new \Zimbra\Account\Struct\Identity($name, $id, [$attr]);

        $req = new \Zimbra\Account\Request\CreateIdentity($identity);
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertSame($identity, $req->getIdentity());

        $req->setIdentity($identity);
        $this->assertSame($identity, $req->getIdentity());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CreateIdentityRequest>'
                . '<identity name="' . $name . '" id="' . $id . '">'
                    . '<a name="' . $name . '" pd="true">' . $value . '</a>'
                . '</identity>'
            . '</CreateIdentityRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'CreateIdentityRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'identity' => [
                    'name' => $name,
                    'id' => $id,
                    'a' => [
                        [
                            'name' => $name,
                            'pd' => true,
                            '_content' => $value,
                        ],
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateSignature()
    {
        $value = md5(self::randomString());
        $name = self::randomName();
        $id = self::randomName();
        $cid = self::randomName();

        $content = new \Zimbra\Account\Struct\SignatureContent($value, ContentType::TEXT_PLAIN());
        $signature = new \Zimbra\Account\Struct\Signature($name, $id, $cid, [$content]);

        $req = new \Zimbra\Account\Request\CreateSignature($signature);
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertSame($signature, $req->getSignature());

        $req->setSignature($signature);
        $this->assertSame($signature, $req->getSignature());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CreateSignatureRequest>'
                . '<signature id="' . $id . '" name="' . $name . '">'
                    . '<cid>' . $cid . '</cid>'
                    . '<content type="text/plain">' . $value . '</content>'
                . '</signature>'
            . '</CreateSignatureRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'CreateSignatureRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'signature' => [
                    'name' => $name,
                    'id' => $id,
                    'cid' => $cid,
                    'content' => [
                        [
                            'type' => 'text/plain',
                            '_content' => $value,
                        ],
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testDeleteIdentity()
    {
        $name = self::randomName();
        $id = self::randomName();

        $identity = new \Zimbra\Account\Struct\NameId($name, $id);
        $req = new \Zimbra\Account\Request\DeleteIdentity($identity);
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertSame($identity, $req->getIdentity());

        $req->setIdentity($identity);
        $this->assertSame($identity, $req->getIdentity());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<DeleteIdentityRequest>'
                . '<identity name="' . $name . '" id="' . $id . '" />'
            . '</DeleteIdentityRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'DeleteIdentityRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'identity' => [
                    'name' => $name,
                    'id' => $id,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testDeleteSignature()
    {
        $name = self::randomName();
        $id = self::randomName();

        $signature = new \Zimbra\Account\Struct\NameId($name, $id);
        $req = new \Zimbra\Account\Request\DeleteSignature($signature);
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertSame($signature, $req->getSignature());

        $req->setSignature($signature);
        $this->assertSame($signature, $req->getSignature());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<DeleteSignatureRequest>'
                . '<signature name="' . $name . '" id="' . $id . '" />'
            . '</DeleteSignatureRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'DeleteSignatureRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'signature' => [
                    'name' => $name,
                    'id' => $id,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testDiscoverRights()
    {
        $right1 = self::randomName();
        $right2 = self::randomName();
        $right3 = self::randomName();

        $req = new \Zimbra\Account\Request\DiscoverRights([$right1, $right2]);
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertSame([$right1, $right2], $req->getRights()->all());

        $req->addRight($right3);
        $this->assertSame([$right1, $right2, $right3], $req->getRights()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<DiscoverRightsRequest>'
                . '<right>' . $right1 . '</right>'
                . '<right>' . $right2 . '</right>'
                . '<right>' . $right3 . '</right>'
            . '</DiscoverRightsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'DiscoverRightsRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'right' => [
                    $right1,
                    $right2,
                    $right3,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testDistributionListAction()
    {
        $name = self::randomName();
        $value = md5(self::randomString());
        $member = self::randomName();

        $subsReq = new \Zimbra\Account\Struct\DistributionListSubscribeReq(DLSubscribeOp::SUBSCRIBE(), $value, true);
        $owner = new \Zimbra\Account\Struct\DistributionListGranteeSelector(GranteeType::USR(), DLGranteeBy::ID(), $value);
        $grantee = new \Zimbra\Account\Struct\DistributionListGranteeSelector(GranteeType::ALL(), DLGranteeBy::NAME(), $value);
        $right = new \Zimbra\Account\Struct\DistributionListRightSpec($name, [$grantee]);
        $a = new \Zimbra\Struct\KeyValuePair($name, $value);
        $action = new \Zimbra\Account\Struct\DistributionListAction(Operation::MODIFY(), $name, $subsReq, [$member], [$owner], [$right], [$a]);

        $dl = new \Zimbra\Account\Struct\DistributionListSelector(DLBy::NAME(), $value);
        $attr = new \Zimbra\Account\Struct\Attr($name, $value, true);

        $req = new \Zimbra\Account\Request\DistributionListAction($dl, $action, [$attr]);
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertSame($dl, $req->getDl());
        $this->assertSame($action, $req->getAction());
        $this->assertSame([$attr], $req->getAttrs()->all());

        $req->setDl($dl)
            ->setAction($action)
            ->addAttr($attr);
        $this->assertSame($dl, $req->getDl());
        $this->assertSame($action, $req->getAction());
        $this->assertSame([$attr, $attr], $req->getAttrs()->all());
        $req->getAttrs()->remove(1);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<DistributionListActionRequest>'
                . '<dl by="' . DLBy::NAME() . '">' . $value . '</dl>'
                . '<action op="' . Operation::MODIFY() . '">'
                    . '<newName>' . $name . '</newName>'
                    . '<subsReq op="' . DLSubscribeOp::SUBSCRIBE() . '" bccOwners="true">' . $value . '</subsReq>'
                    . '<a n="' . $name . '">' . $value . '</a>'
                    . '<dlm>' . $member . '</dlm>'
                    . '<owner type="' . GranteeType::USR() . '" by="' . DLGranteeBy::ID() . '">' . $value . '</owner>'
                    . '<right right="' . $name . '">'
                        . '<grantee type="' . GranteeType::ALL() . '" by="' . DLGranteeBy::NAME() . '">' . $value . '</grantee>'
                    . '</right>'
                . '</action>'
                . '<a name="' . $name . '" pd="true">' . $value . '</a>'
            . '</DistributionListActionRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'DistributionListActionRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'dl' => [
                    'by' => DLBy::NAME()->value(),
                    '_content' => $value,
                ],
                'action' => [
                    'op' => Operation::MODIFY()->value(),
                    'newName' => $name,
                    'subsReq' => [
                        'op' => DLSubscribeOp::SUBSCRIBE()->value(),
                        '_content' => $value,
                        'bccOwners' => true,
                    ],
                    'dlm' => [$member],
                    'owner' => [
                        [
                            'type' => GranteeType::USR()->value(),
                            '_content' => $value,
                            'by' => DLGranteeBy::ID()->value(),
                        ],
                    ],
                    'right' => [
                        [
                            'right' => $name,
                            'grantee' => [
                                [
                                    'type' => GranteeType::ALL()->value(),
                                    '_content' => $value,
                                    'by' => DLGranteeBy::NAME()->value(),
                                ],
                            ],
                        ],
                    ],
                    'a' => [
                        [
                            'n' => $name,
                            '_content' => $value,
                        ],
                    ],
                ],
                'a' => [
                    [
                        'name' => $name,
                        'pd' => true,
                        '_content' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testEndSession()
    {
        $req = new \Zimbra\Account\Request\EndSession;
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<EndSessionRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'EndSessionRequest' => [
                '_jsns' => 'urn:zimbraAccount',
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAccountDistributionLists()
    {
        $attrs = self::randomName();

        $req = new \Zimbra\Account\Request\GetAccountDistributionLists(false, MemberOf::DIRECT_ONLY(), [$attrs]);
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertFalse($req->getOwnerOf());
        $this->assertSame('directOnly', $req->getMemberOf()->value());
        $this->assertSame($attrs, $req->getAttrs());

        $req->setOwnerOf(true)
            ->setMemberOf(MemberOf::ALL());
        $this->assertTrue($req->getOwnerOf());
        $this->assertSame('all', $req->getMemberOf()->value());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetAccountDistributionListsRequest ownerOf="true" memberOf="' . MemberOf::ALL() . '" attrs="' . $attrs . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetAccountDistributionListsRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'ownerOf' => true,
                'memberOf' => MemberOf::ALL()->value(),
                'attrs' => $attrs,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAccountInfo()
    {
        $value = md5(self::randomString());

        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), $value);

        $req = new \Zimbra\Account\Request\GetAccountInfo($account);
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertSame($account, $req->getAccount());

        $req->setAccount($account);
        $this->assertSame($account, $req->getAccount());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetAccountInfoRequest>'
                . '<account by="' . AccountBy::NAME() . '">' . $value . '</account>'
            . '</GetAccountInfoRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetAccountInfoRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'account' => [
                    'by' => AccountBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAllLocales()
    {
        $req = new \Zimbra\Account\Request\GetAllLocales;
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetAllLocalesRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetAllLocalesRequest' => [
                '_jsns' => 'urn:zimbraAccount',
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAvailableCsvFormats()
    {
        $req = new \Zimbra\Account\Request\GetAvailableCsvFormats;
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetAvailableCsvFormatsRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetAvailableCsvFormatsRequest' => [
                '_jsns' => 'urn:zimbraAccount',
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAvailableLocales()
    {
        $req = new \Zimbra\Account\Request\GetAvailableLocales;
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetAvailableLocalesRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetAvailableLocalesRequest' => [
                '_jsns' => 'urn:zimbraAccount',
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAvailableSkins()
    {
        $req = new \Zimbra\Account\Request\GetAvailableSkins;
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetAvailableSkinsRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetAvailableSkinsRequest' => [
                '_jsns' => 'urn:zimbraAccount',
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetDistributionList()
    {
        $name = self::randomName();
        $value = md5(self::randomString());

        $dl = new \Zimbra\Account\Struct\DistributionListSelector(DLBy::NAME(), $value);
        $attr = new \Zimbra\Account\Struct\Attr($name, $value, true);
        $req = new \Zimbra\Account\Request\GetDistributionList($dl, false, 'sendToDistList', [$attr]);
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);

        $this->assertSame($dl, $req->getDl());
        $this->assertFalse($req->getNeedOwners());
        $this->assertSame('sendToDistList', $req->getNeedRights());
        $this->assertSame([$attr], $req->getAttrs()->all());

        $req->setDl($dl)
            ->setNeedOwners(true)
            ->setNeedRights('sendToDistList,viewDistList')
            ->addAttr($attr);
        $this->assertSame($dl, $req->getDl());
        $this->assertTrue($req->getNeedOwners());
        $this->assertSame('sendToDistList,viewDistList', $req->getNeedRights());
        $this->assertSame([$attr, $attr], $req->getAttrs()->all());
        $req->getAttrs()->remove(1);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetDistributionListRequest needOwners="true" needRights="sendToDistList,viewDistList">'
                . '<dl by="' . DLBy::NAME() . '">' . $value . '</dl>'
                . '<a name="' . $name . '" pd="true">' . $value . '</a>'
            . '</GetDistributionListRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetDistributionListRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'needOwners' => true,
                'needRights' => 'sendToDistList,viewDistList',
                'dl' => [
                    'by' => DLBy::NAME()->value(),
                    '_content' => $value,
                ],
                'a' => [
                    [
                        'name' => $name,
                        'pd' => true,
                        '_content' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function getGetDistributionListMembers()
    {
        $name = self::randomName();
        $limit = mt_rand(1, 100);
        $offset = mt_rand(0, 100);

        $req = new \Zimbra\Account\Request\GetDistributionListMembers($name, $limit, $offset);
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertSame($name, $req->getDl());
        $this->assertSame($limit, $req->getLimit());
        $this->assertSame($offset, $req->getOffset());

        $req->setDl($name)
            ->setLimit($limit)
            ->setOffset($offset);
        $this->assertSame($name, $req->getDl());
        $this->assertSame($limit, $req->getLimit());
        $this->assertSame($offset, $req->getOffset());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetDistributionListMembersRequest limit="' . $limit . '" offset="' . $offset . '">'
                . '<dl>' . $name . '</dl>'
            . '</GetDistributionListRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetDistributionListRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'dl' => $name,
                'limit' => $limit,
                'offset' => $offset,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetIdentities()
    {
        $req = new \Zimbra\Account\Request\GetIdentities();
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetIdentitiesRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetIdentitiesRequest' => [
                '_jsns' => 'urn:zimbraAccount',
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function getGetInfo()
    {
        $name = self::randomName();

        $req = new \Zimbra\Account\Request\GetInfo('a,mbox,b,prefs,c', $name);
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertSame('mbox,prefs', $req->getSections());
        $this->assertSame($name, $req->getRights());

        $req->setSections('x,attrs,y,zimlets,z')
            ->setRights($name);
        $this->assertSame('attrs,zimlets', $req->getSections());
        $this->assertSame($name, $req->getRights());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetInfoRequest sections="attrs,zimlets" rights="' . $name . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetInfoRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'sections' => 'attrs,zimlets',
                'rights' => $name,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function getGetPrefs()
    {
        $name = self::randomName();
        $value = md5(self::randomString());
        $modified = mt_rand(0, 1000);

        $pref = new \Zimbra\Account\Struct\Pref($name, $value, $modified);
        $req = new \Zimbra\Account\Request\GetPrefs([$pref]);
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertSame([$pref], $req->getPrefs()->all());

        $req->addPref($pref);
        $this->assertSame([$pref, $pref], $req->getPrefs()->all());
        $req->getPrefs()->remove(1);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetPrefsRequest>'
                . '<pref name="' . $name . '" modified="' . $modified . '">' . $value . '</pref>'
            . '</GetPrefsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetPrefsRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'pref' => [
                    [
                        'name' => $name,
                        'modified' => $modified,
                        '_content' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetRights()
    {
        $name = self::randomName();

        $ace = new \Zimbra\Account\Struct\Right($name);
        $req = new \Zimbra\Account\Request\GetRights([$ace]);
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertSame([$ace], $req->getAces()->all());

        $req->addAce($ace);
        $this->assertSame([$ace, $ace], $req->getAces()->all());
        $req->getAces()->remove(1);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetRightsRequest>'
                . '<ace right="' . $name . '" />'
            . '</GetRightsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetRightsRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'ace' => [
                    ['right' => $name],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetShareInfo()
    {
        $value = md5(self::randomString());
        $name = self::randomName();
        $type = self::randomName();
        $id = self::randomName();

        $owner = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), $value);
        $grantee = new \Zimbra\Struct\GranteeChooser($type, $id, $name);

        $req = new \Zimbra\Account\Request\GetShareInfo($grantee, $owner, true, false);
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertSame($grantee, $req->getGrantee());
        $this->assertSame($owner, $req->getOwner());
        $this->assertTrue($req->getInternal());
        $this->assertFalse($req->getIncludeSelf());

        $req->setGrantee($grantee)
            ->setOwner($owner)
            ->setInternal(false)
            ->setIncludeSelf(true);
        $this->assertSame($grantee, $req->getGrantee());
        $this->assertSame($owner, $req->getOwner());
        $this->assertFalse($req->getInternal());
        $this->assertTrue($req->getIncludeSelf());


        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetShareInfoRequest internal="false" includeSelf="true" >'
                . '<grantee type="' . $type . '" id="' . $id . '" name="' . $name . '" />'
                . '<owner by="' . AccountBy::NAME() . '">' . $value . '</owner>'
            . '</GetShareInfoRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetShareInfoRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'internal' => false,
                'includeSelf' => true,
                'grantee' => [
                    'type' => $type,
                    'id' => $id,
                    'name' => $name,
                ],
                'owner' => [
                    'by' => AccountBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetSignatures()
    {
        $req = new \Zimbra\Account\Request\GetSignatures;
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetSignaturesRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetSignaturesRequest' => [
                '_jsns' => 'urn:zimbraAccount',
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetVersionInfo()
    {
        $req = new \Zimbra\Account\Request\GetVersionInfo;
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetVersionInfoRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetVersionInfoRequest' => [
                '_jsns' => 'urn:zimbraAccount',
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetWhiteBlackList()
    {
        $req = new \Zimbra\Account\Request\GetWhiteBlackList;
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetWhiteBlackListRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetWhiteBlackListRequest' => [
                '_jsns' => 'urn:zimbraAccount',
            ],
        ];
        $this->assertEquals($array, $req->toArray());
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
        $req = new \Zimbra\Account\Request\GrantRights([$ace]);
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertSame([$ace], $req->getAces()->all());

        $req->addAce($ace);
        $this->assertSame([$ace, $ace], $req->getAces()->all());
        $req->getAces()->remove(1);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GrantRightsRequest>'
                . '<ace gt="' . GranteeType::ALL() . '" right="' . AceRightType::VIEW_FREE_BUSY() . '" zid="' . $zid . '" d="' . $dir . '" key="' . $key . '" pw="' . $pw . '" deny="true" chkgt="false" />'
            . '</GrantRightsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GrantRightsRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'ace' => [
                    [
                        'gt' => GranteeType::ALL()->value(),
                        'right' => AceRightType::VIEW_FREE_BUSY()->value(),
                        'zid' => $zid,
                        'd' => $dir,
                        'key' => $key,
                        'pw' => $pw,
                        'deny' => true,
                        'chkgt' => false,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyIdentity()
    {
        $name = self::randomName();
        $id = self::randomName();
        $value = md5(self::randomString());

        $attr = new \Zimbra\Account\Struct\Attr($name, $value, true);
        $identity = new \Zimbra\Account\Struct\Identity($name, $id, [$attr]);

        $req = new \Zimbra\Account\Request\ModifyIdentity($identity);    
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertSame($identity, $req->getIdentity());
        $req->setIdentity($identity);
        $this->assertSame($identity, $req->getIdentity());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ModifyIdentityRequest>'
                . '<identity name="' . $name . '" id="' . $id . '">'
                    . '<a name="' . $name . '" pd="true">' . $value . '</a>'
                . '</identity>'
            . '</ModifyIdentityRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ModifyIdentityRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'identity' => [
                    'name' => $name,
                    'id' => $id,
                    'a' => [
                        [
                            'name' => $name,
                            '_content' => $value,
                            'pd' => true,
                        ],
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyPrefs()
    {
        $name = self::randomName();
        $value = md5(self::randomString());
        $modified = mt_rand(1, 1000);

        $pref = new \Zimbra\Account\Struct\Pref($name, $value, $modified);
        $req = new \Zimbra\Account\Request\ModifyPrefs([$pref]);
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertSame([$pref], $req->getPrefs()->all());

        $req->addPref($pref);
        $this->assertSame([$pref, $pref], $req->getPrefs()->all());
        $req->getPrefs()->remove(1);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ModifyPrefsRequest>'
                . '<pref name="' . $name . '" modified="' . $modified . '">' . $value . '</pref>'
            . '</ModifyPrefsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ModifyPrefsRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'pref' => [
                    [
                        'name' => $name,
                        'modified' => $modified,
                        '_content' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyProperties()
    {
        $zimlet = self::randomName();
        $name = self::randomName();
        $value = md5(self::randomString());

        $prop = new \Zimbra\Account\Struct\Prop($zimlet, $name, $value);
        $req = new \Zimbra\Account\Request\ModifyProperties([$prop]);
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertSame([$prop], $req->getProps()->all());

        $req->addProp($prop);
        $this->assertSame([$prop, $prop], $req->getProps()->all());
        $req->getProps()->remove(1);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ModifyPropertiesRequest>'
                . '<prop zimlet="' . $zimlet . '" name="' . $name . '">' . $value . '</prop>'
            . '</ModifyPropertiesRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ModifyPropertiesRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'prop' => [
                    [
                        'zimlet' => $zimlet,
                        'name' => $name,
                        '_content' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifySignature()
    {
        $value = md5(self::randomString());
        $name = self::randomName();
        $id = self::randomName();
        $cid = self::randomName();

        $content = new \Zimbra\Account\Struct\SignatureContent($value, ContentType::TEXT_HTML());
        $signature = new \Zimbra\Account\Struct\Signature($name, $id, $cid, [$content]);

        $req = new \Zimbra\Account\Request\ModifySignature($signature);
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertSame($signature, $req->getSignature());
        $req->setSignature($signature);
        $this->assertSame($signature, $req->getSignature());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ModifySignatureRequest>'
                . '<signature name="' . $name . '" id="' . $id . '">'
                    . '<cid>' . $cid . '</cid>'
                    . '<content type="' . ContentType::TEXT_HTML() . '">' . $value . '</content>'
                . '</signature>'
            . '</ModifySignatureRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ModifySignatureRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'signature' => [
                    'name' => $name,
                    'id' => $id,
                    'cid' => $cid,
                    'content' => [
                        [
                            'type' => ContentType::TEXT_HTML()->value(),
                            '_content' => $value,
                        ],
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyWhiteBlackList()
    {
        $value = md5(self::randomString());
        $white = new \Zimbra\Struct\OpValue('+', $value);
        $black = new \Zimbra\Struct\OpValue('-', $value);
        $whiteList = new \Zimbra\Account\Struct\WhiteList([$white]);
        $blackList = new \Zimbra\Account\Struct\BlackList([$black]);

        $req = new \Zimbra\Account\Request\ModifyWhiteBlackList($whiteList, $blackList);
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertSame($whiteList, $req->getWhiteList());
        $this->assertSame($blackList, $req->getBlackList());

        $req->setWhiteList($whiteList)
            ->setBlackList($blackList);
        $this->assertSame($whiteList, $req->getWhiteList());
        $this->assertSame($blackList, $req->getBlackList());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ModifyWhiteBlackListRequest>'
                . '<whiteList>'
                    . '<addr op="+">' . $value . '</addr>'
                . '</whiteList>'
                . '<blackList>'
                    . '<addr op="-">' . $value . '</addr>'
                . '</blackList>'
            . '</ModifyWhiteBlackListRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ModifyWhiteBlackListRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'whiteList' => [
                    'addr' => [
                        [
                            'op' => '+',
                            '_content' => $value,
                        ],
                    ],
                ],
                'blackList' => [
                    'addr' => [
                        [
                            'op' => '-',
                            '_content' => $value,
                        ],
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyZimletPrefs()
    {
        $name = self::randomName();
        $zimlet = new \Zimbra\Account\Struct\ZimletPrefsSpec($name, ZimletStatus::ENABLED());
        $req = new \Zimbra\Account\Request\ModifyZimletPrefs([$zimlet]);
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertSame([$zimlet], $req->getZimlets()->all());

        $req->addZimlet($zimlet);
        $this->assertSame([$zimlet, $zimlet], $req->getZimlets()->all());
        $req->getZimlets()->remove(1);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ModifyZimletPrefsRequest>'
                . '<zimlet name="' . $name . '" presence="' . ZimletStatus::ENABLED() . '" />'
            . '</ModifyZimletPrefsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ModifyZimletPrefsRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'zimlet' => [
                    [
                        'name' => $name,
                        'presence' => ZimletStatus::ENABLED()->value(),
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testRevokeRights()
    {
        $zid = md5(self::randomString());
        $dir = md5(self::randomString());
        $key = md5(self::randomString());
        $pw = md5(self::randomString());

        $ace = new \Zimbra\Account\Struct\AccountACEInfo(GranteeType::ALL(), AceRightType::VIEW_FREE_BUSY(), $zid, $dir, $key, $pw, true, false);
        $req = new \Zimbra\Account\Request\RevokeRights([$ace]);
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertSame([$ace], $req->getAces()->all());

        $req->addAce($ace);
        $this->assertSame([$ace, $ace], $req->getAces()->all());
        $req->getAces()->remove(1);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<RevokeRightsRequest>'
                . '<ace gt="' . GranteeType::ALL() . '" right="' . AceRightType::VIEW_FREE_BUSY() . '" zid="' . $zid . '" d="' . $dir . '" key="' . $key . '" pw="' . $pw . '" deny="true" chkgt="false" />'
            . '</RevokeRightsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'RevokeRightsRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'ace' => [
                    [
                        'gt' => GranteeType::ALL()->value(),
                        'right' => AceRightType::VIEW_FREE_BUSY()->value(),
                        'zid' => $zid,
                        'd' => $dir,
                        'key' => $key,
                        'pw' => $pw,
                        'deny' => true,
                        'chkgt' => false,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
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
        $multiConds = new \Zimbra\Struct\EntrySearchFilterMultiCond(false, true, [$singleCond]);
        $conds = new \Zimbra\Struct\EntrySearchFilterMultiCond(true, false, [$cond, $multiConds]);
        $filter = new \Zimbra\Struct\EntrySearchFilterInfo($conds);

        $locale = self::randomName();
        $name = self::randomName();
        $sortBy = self::randomName();
        $galAcctId = self::randomName();
        $attrs = self::randomName();
        $limit = mt_rand(1, 100);
        $offset = mt_rand(0, 100);

        $req = new \Zimbra\Account\Request\SearchCalendarResources(
            $locale, $cursor, $name, $filter, false, $sortBy, $limit, $offset, $galAcctId, [$attrs]
        );
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertSame($locale, $req->getLocale());
        $this->assertSame($cursor, $req->getCursor());
        $this->assertSame($name, $req->getName());
        $this->assertSame($filter, $req->getSearchFilter());
        $this->assertFalse($req->getQuick());
        $this->assertSame($sortBy, $req->getSortBy());
        $this->assertSame($limit, $req->getLimit());
        $this->assertSame($offset, $req->getOffset());
        $this->assertSame($galAcctId, $req->getGalAccountId());

        $req->setLocale($locale)
            ->setCursor($cursor)
            ->setName($name)
            ->setSearchFilter($filter)
            ->setQuick(true)
            ->setSortBy($sortBy)
            ->setLimit($limit)
            ->setOffset($offset)
            ->setGalAccountId($galAcctId);
        $this->assertSame($locale, $req->getLocale());
        $this->assertSame($cursor, $req->getCursor());
        $this->assertSame($name, $req->getName());
        $this->assertSame($filter, $req->getSearchFilter());
        $this->assertTrue($req->getQuick());
        $this->assertSame($sortBy, $req->getSortBy());
        $this->assertSame($limit, $req->getLimit());
        $this->assertSame($offset, $req->getOffset());
        $this->assertSame($galAcctId, $req->getGalAccountId());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<SearchCalendarResourcesRequest quick="true" sortBy="' . $sortBy . '" limit="' . $limit . '" offset="' . $offset . '" galAcctId="' . $galAcctId . '" attrs="' . $attrs . '">'
                . '<locale>' . $locale . '</locale>'
                . '<cursor id="' . $id . '" sortVal="' . $sortVal . '" endSortVal="' . $endSortVal . '" includeOffset="true" />'
                . '<name>' . $name . '</name>'
                . '<searchFilter>'
                    . '<conds not="true" or="false">'
                        . '<conds not="false" or="true">'
                            . '<cond attr="' . $attr . '" op="' . CondOp::GE() . '" value="' . $value . '" not="false" />'
                        . '</conds>'
                        . '<cond attr="' . $attr . '" op="' . CondOp::EQ() . '" value="' . $value . '" not="true" />'
                    . '</conds>'
                . '</searchFilter>'
            . '</SearchCalendarResourcesRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'SearchCalendarResourcesRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'name' => $name,
                'locale' => $locale,
                'quick' => true,
                'sortBy' => $sortBy,
                'limit' => $limit,
                'offset' => $offset,
                'galAcctId' => $galAcctId,
                'attrs' => $attrs,
                'cursor' => [
                    'id' => $id,
                    'sortVal' => $sortVal,
                    'endSortVal' => $endSortVal,
                    'includeOffset' => true,
                ],
                'searchFilter' => [
                    'conds' => [
                        'not' => true,
                        'or' => false,
                        'conds' => [
                            [
                                'not' => false,
                                'or' => true,
                                'cond' => [
                                    [
                                        'attr' => $attr,
                                        'op' => CondOp::GE()->value(),
                                        'value' => $value,
                                        'not' => false,
                                    ],
                                ],
                            ],
                        ],
                        'cond' => [
                            [
                                'attr' => $attr,
                                'op' => CondOp::EQ()->value(),
                                'value' => $value,
                                'not' => true,
                            ],
                        ],
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
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
        $multiConds = new \Zimbra\Struct\EntrySearchFilterMultiCond(false, true, [$singleCond]);
        $conds = new \Zimbra\Struct\EntrySearchFilterMultiCond(true, false, [$cond, $multiConds]);
        $filter = new \Zimbra\Struct\EntrySearchFilterInfo($conds);

        $locale = self::randomName();
        $ref = self::randomName();
        $name = self::randomName();
        $galAcctId = self::randomName();
        $limit = mt_rand(1, 100);
        $offset = mt_rand(0, 100);

        $req = new \Zimbra\Account\Request\SearchGal(
            $locale, $cursor, $filter, $ref, $name, SearchType::ALL(),
            true, false, MemberOf::ALL(), true, $galAcctId, false, SortBy::NONE(), $limit, $offset
        );
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertSame($cursor, $req->getCursor());
        $this->assertSame($filter, $req->getSearchFilter());
        $this->assertSame($locale, $req->getLocale());
        $this->assertSame($ref, $req->getRef());
        $this->assertSame($name, $req->getName());
        $this->assertSame('all', $req->getType()->value());
        $this->assertTrue($req->getNeedExp());
        $this->assertFalse($req->getNeedIsOwner());
        $this->assertSame('all', $req->getNeedIsMember()->value());
        $this->assertTrue($req->getNeedSMIMECerts());
        $this->assertSame($galAcctId, $req->getGalAccountId());
        $this->assertFalse($req->getQuick());
        $this->assertSame('none', $req->getSortBy()->value());
        $this->assertSame($limit, $req->getLimit());
        $this->assertSame($offset, $req->getOffset());

        $req->setLocale($locale)
            ->setCursor($cursor)
            ->setSearchFilter($filter)
            ->setRef($ref)
            ->setName($name)
            ->setType(SearchType::ACCOUNT())
            ->setNeedExp(true)
            ->setNeedIsOwner(true)
            ->setNeedIsMember(MemberOf::DIRECT_ONLY())
            ->setNeedSMIMECerts(true)
            ->setGalAccountId($galAcctId)
            ->setQuick(true)
            ->setSortBy(SortBy::DATE_ASC())
            ->setLimit($limit)
            ->setOffset($offset);
        $this->assertSame($cursor, $req->getCursor());
        $this->assertSame($filter, $req->getSearchFilter());
        $this->assertSame($locale, $req->getLocale());
        $this->assertSame($ref, $req->getRef());
        $this->assertSame($name, $req->getName());
        $this->assertSame('account', $req->getType()->value());
        $this->assertTrue($req->getNeedExp());
        $this->assertTrue($req->getNeedIsOwner());
        $this->assertSame('directOnly', $req->getNeedIsMember()->value());
        $this->assertTrue($req->getNeedSMIMECerts());
        $this->assertSame($galAcctId, $req->getGalAccountId());
        $this->assertTrue($req->getQuick());
        $this->assertSame('dateAsc', $req->getSortBy()->value());
        $this->assertSame($limit, $req->getLimit());
        $this->assertSame($offset, $req->getOffset());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<SearchGalRequest ref="' . $ref . '" name="' . $name . '" type="' . SearchType::ACCOUNT() . '" needExp="true" needIsOwner="true" needIsMember="' . MemberOf::DIRECT_ONLY() . '" needSMIMECerts="true" galAcctId="' . $galAcctId . '" quick="true" sortBy="' . SortBy::DATE_ASC() . '" limit="' . $limit . '" offset="' . $offset . '">'
                . '<locale>' . $locale . '</locale>'
                . '<cursor id="' . $id . '" sortVal="' . $sortVal . '" endSortVal="' . $endSortVal . '" includeOffset="true" />'
                . '<searchFilter>'
                    . '<conds not="true" or="false">'
                        . '<conds not="false" or="true">'
                            . '<cond attr="' . $attr . '" op="' . CondOp::GE() . '" value="' . $value . '" not="false" />'
                        . '</conds>'
                        . '<cond attr="' . $attr . '" op="' . CondOp::EQ() . '" value="' . $value . '" not="true" />'
                    . '</conds>'
                . '</searchFilter>'
            . '</SearchGalRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'SearchGalRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'locale' => $locale,
                'ref' => $ref,
                'name' => $name,
                'type' => SearchType::ACCOUNT()->value(),
                'needExp' => true,
                'needIsOwner' => true,
                'needIsMember' => MemberOf::DIRECT_ONLY()->value(),
                'needSMIMECerts' => true,
                'galAcctId' => $galAcctId,
                'quick' => true,
                'sortBy' => SortBy::DATE_ASC()->value(),
                'limit' => $limit,
                'offset' => $offset,
                'cursor' => [
                    'id' => $id,
                    'sortVal' => $sortVal,
                    'endSortVal' => $endSortVal,
                    'includeOffset' => true,
                ],
                'searchFilter' => [
                    'conds' => [
                        'not' => true,
                        'or' => false,
                        'conds' => [
                            [
                                'not' => false,
                                'or' => true,
                                'cond' => [
                                    [
                                        'attr' => $attr,
                                        'op' => CondOp::GE()->value(),
                                        'value' => $value,
                                        'not' => false,
                                    ],
                                ],
                            ],
                        ],
                        'cond' => [
                            [
                                'attr' => $attr,
                                'op' => CondOp::EQ()->value(),
                                'value' => $value,
                                'not' => true,
                            ],
                        ],
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testSubscribeDistributionList()
    {
        $value = md5(self::randomString());
        $dl = new \Zimbra\Account\Struct\DistributionListSelector(DLBy::NAME(), $value);

        $req = new \Zimbra\Account\Request\SubscribeDistributionList(DLSubscribeOp::UNSUBSCRIBE(), $dl);
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertSame('unsubscribe', $req->getOp()->value());
        $this->assertSame($dl, $req->getDl());

        $req->setOp(DLSubscribeOp::SUBSCRIBE())
            ->setDl($dl);
        $this->assertSame('subscribe', $req->getOp()->value());
        $this->assertSame($dl, $req->getDl());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<SubscribeDistributionListRequest op="' . DLSubscribeOp::SUBSCRIBE() . '">'
                . '<dl by="' . DLBy::NAME() . '">' . $value . '</dl>'
            . '</SubscribeDistributionListRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'SubscribeDistributionListRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'op' => DLSubscribeOp::SUBSCRIBE()->value(),
                'dl' => [
                    'by' => DLBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testSyncGal()
    {
        $token = self::randomName();
        $galAcctId = self::randomName();

        $req = new \Zimbra\Account\Request\SyncGal($token, $galAcctId, false);
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertSame($token, $req->getToken());
        $this->assertSame($galAcctId, $req->getGalAccountId());
        $this->assertFalse($req->getIdOnly());

        $req->setGalAccountId($token)
            ->setGalAccountId($galAcctId)
            ->setIdOnly(true);
        $this->assertSame($token, $req->getToken());
        $this->assertSame($galAcctId, $req->getGalAccountId());
        $this->assertTrue($req->getIdOnly());


        $xml = '<?xml version="1.0"?>' . "\n"
            . '<SyncGalRequest token="' . $token . '" galAcctId="' . $galAcctId . '" idOnly="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'SyncGalRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'token' => $token,
                'galAcctId' => $galAcctId,
                'idOnly' => true,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }
}
