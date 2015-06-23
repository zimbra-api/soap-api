<?php

namespace Zimbra\Tests\Account;

use Zimbra\Tests\ZimbraTestCase;

use Zimbra\Enum\AceRightType;
use Zimbra\Enum\ContentType;
use Zimbra\Enum\DistributionListBy as DLBy;
use Zimbra\Enum\DistributionListGranteeBy as DLGranteeBy;
use Zimbra\Enum\DistributionListSubscribeOp as DLSubscribeOp;
use Zimbra\Enum\GranteeType;
use Zimbra\Enum\Operation;
use Zimbra\Enum\TargetBy;
use Zimbra\Enum\TargetType;
use Zimbra\Enum\ZimletStatus;

/**
 * Testcase class for account struct.
 */
class StructTest extends ZimbraTestCase
{
    public function testAccountACEInfo()
    {
        $zid = md5(self::randomString());
        $d = md5(self::randomString());
        $key = md5(self::randomString());
        $pw = md5(self::randomString());

        $ace = new \Zimbra\Account\Struct\AccountACEInfo(
            GranteeType::USR(), AceRightType::INVITE(), $zid, $d, $key, $pw, false, true
        );
        $this->assertTrue($ace->getGranteeType()->is('usr'));
        $this->assertTrue($ace->getRight()->is('invite'));
        $this->assertSame($zid, $ace->getZimbraId());
        $this->assertSame($d, $ace->getDisplayName());
        $this->assertSame($key, $ace->getAccessKey());
        $this->assertSame($pw, $ace->getPassword());
        $this->assertFalse($ace->getDeny());
        $this->assertTrue($ace->getCheckGranteeType());

        $ace->setGranteeType(GranteeType::USR())
            ->setRight(AceRightType::INVITE())
            ->setZimbraId($zid)
            ->setDisplayName($d)
            ->setAccessKey($key)
            ->setPassword($pw)
            ->setDeny(true)
            ->setCheckGranteeType(false);

        $this->assertTrue($ace->getGranteeType()->is('usr'));
        $this->assertTrue($ace->getRight()->is('invite'));
        $this->assertSame($zid, $ace->getZimbraId());
        $this->assertSame($d, $ace->getDisplayName());
        $this->assertSame($key, $ace->getAccessKey());
        $this->assertSame($pw, $ace->getPassword());
        $this->assertTrue($ace->getDeny());
        $this->assertFalse($ace->getCheckGranteeType());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ace gt="' . GranteeType::USR() . '" right="' . AceRightType::INVITE() . '" zid="' . $zid . '" d="' . $d . '" key="' . $key . '" pw="' . $pw . '" deny="true" chkgt="false" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $ace);

        $array = [
            'ace' => [
                'gt' => GranteeType::USR()->value(),
                'right' => AceRightType::INVITE()->value(),
                'zid' => $zid,
                'd' => $d,
                'key' => $key,
                'pw' => $pw,
                'deny' => true,
                'chkgt' => false,
            ],
        ];
        $this->assertEquals($array, $ace->toArray());
    }

    public function testAccountKeyValuePairs()
    {
        $key = self::randomName();
        $value = md5(self::randomString());

        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);
        $attrs = $this->getMockForAbstractClass('Zimbra\Account\Struct\AccountKeyValuePairs');

        $attrs->addAttr($attr);
        $this->assertSame([$attr], $attrs->getAttrs()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<attrs>'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</attrs>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $attrs);

        $array = [
            'attrs' => [
                'a' => [
                    [
                        'n' => $key,
                        '_content' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $attrs->toArray());
    }

    public function testAttr()
    {
        $name = self::randomName();
        $value = md5(self::randomString());

        $attr = new \Zimbra\Account\Struct\Attr($name, $value, false);
        $this->assertSame($name, $attr->getName());
        $this->assertSame($value, $attr->getValue());
        $this->assertFalse($attr->getPermDenied());

        $attr->setName($name)
             ->setPermDenied(true);
        $this->assertSame($name, $attr->getName());
        $this->assertTrue($attr->getPermDenied());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<attr name="' . $name . '" pd="true">' . $value . '</attr>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $attr);

        $array = [
            'attr' => [
                'name' => $name,
                '_content' => $value,
                'pd' => true,
            ],
        ];
        $this->assertEquals($array, $attr->toArray());
    }

    public function testAttrsImpl()
    {
        $name = self::randomName();
        $value = md5(self::randomString());

        $attr = new \Zimbra\Account\Struct\Attr($name, $value, true);
        $attrs = $this->getMockForAbstractClass('Zimbra\Account\Struct\AttrsImpl');
 
        $attrs->addAttr($attr);
        $this->assertSame([$attr], $attrs->getAttrs()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<attrs>'
                . '<a name="' . $name . '" pd="true">' . $value . '</a>'
            . '</attrs>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $attrs);

        $array = [
            'attrs' => [
                'a' => [
                    [
                        'name' => $name,
                        '_content' => $value,
                        'pd' => true,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $attrs->toArray());
    }

    public function testAuthAttrs()
    {
        $name = self::randomName();
        $value = md5(self::randomString());
        $attr = new \Zimbra\Account\Struct\Attr($name, $value, true);

        $attrs = new \Zimbra\Account\Struct\AuthAttrs([$attr]);
        $this->assertSame([$attr], $attrs->getAttrs()->all());

        $name1 = self::randomName();
        $value1 = md5(self::randomString());
        $attr1 = new \Zimbra\Account\Struct\Attr($name1, $value1, false);

        $attrs->addAttr($attr1);
        $this->assertSame([$attr, $attr1], $attrs->getAttrs()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<attrs>'
                . '<attr name="' . $name . '" pd="true">' . $value . '</attr>'
                . '<attr name="' . $name1 . '" pd="false">' . $value1 . '</attr>'
            . '</attrs>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $attrs);

        $array = [
            'attrs' => [
                'attr' => [
                    [
                        'name' => $name,
                        '_content' => $value,
                        'pd' => true,
                    ],
                    [
                        'name' => $name1,
                        '_content' => $value1,
                        'pd' => false,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $attrs->toArray());
    }

    public function testAuthPrefs()
    {
        $name = self::randomName();
        $value = md5(self::randomString());
        $modified = mt_rand(1, 100);
        $pref = new \Zimbra\Account\Struct\Pref($name, $value, $modified);

        $prefs = new \Zimbra\Account\Struct\AuthPrefs([$pref]);
        $this->assertSame([$pref], $prefs->getPrefs()->all());

        $name1 = self::randomName();
        $value1 = md5(self::randomString());
        $modified1 = mt_rand(1, 100);
        $pref1 = new \Zimbra\Account\Struct\Pref($name1, $value1, $modified1);

        $prefs->addPref($pref1);
        $this->assertSame([$pref, $pref1], $prefs->getPrefs()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<prefs>'
                . '<pref name="' . $name . '" modified="' . $modified . '">' . $value . '</pref>'
                . '<pref name="' . $name1 . '" modified="' . $modified1 . '">' . $value1 . '</pref>'
            . '</prefs>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $prefs);

        $array = [
            'prefs' => [
                'pref' => [
                    [
                        'name' => $name,
                        '_content' => $value,
                        'modified' => $modified,
                    ],
                    [
                        'name' => $name1,
                        '_content' => $value1,
                        'modified' => $modified1,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $prefs->toArray());
    }

    public function testAuthToken()
    {
        $value = md5(self::randomString());
        $token = new \Zimbra\Account\Struct\AuthToken($value, false);
        $this->assertSame($value, $token->getValue());
        $this->assertFalse($token->getVerifyAccount());

        $token->setVerifyAccount(true);
        $this->assertTrue($token->getVerifyAccount());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<authToken verifyAccount="true">' . $value . '</authToken>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $token);

        $array = [
            'authToken' => [
                'verifyAccount' => true,
                '_content' => $value,
            ],
        ];
        $this->assertEquals($array, $token->toArray());
    }

    public function testBlackList()
    {
        $value = md5(self::randomString());
        $addr = new \Zimbra\Struct\OpValue('+', $value);

        $blackList = new \Zimbra\Account\Struct\BlackList([$addr]);
        $this->assertSame([$addr], $blackList->getAddrs()->all());

        $value1 = md5(self::randomString());
        $addr1 = new \Zimbra\Struct\OpValue('-', $value1);

        $blackList->addAddr($addr1);
        $this->assertSame([$addr, $addr1], $blackList->getAddrs()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<blackList>'
                . '<addr op="+">' . $value . '</addr>'
                . '<addr op="-">' . $value1 . '</addr>'
            . '</blackList>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $blackList);

        $array = [
            'blackList' => [
                'addr' => [
                    [
                        'op' => '+',
                        '_content' => $value,
                    ],
                    [
                        'op' => '-',
                        '_content' => $value1,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $blackList->toArray());
    }

    public function testCheckRightsTargetSpec()
    {
        $key = self::randomName();
        $right1 = md5(self::randomString());
        $right2 = md5(self::randomString());
        $right3 = md5(self::randomString());

        $target = new \Zimbra\Account\Struct\CheckRightsTargetSpec(
            TargetType::DOMAIN(), TargetBy::ID(), $key, [$right1, $right2]
        );
        $this->assertTrue($target->getTargetType()->is('domain'));
        $this->assertTrue($target->getTargetBy()->is('id'));
        $this->assertSame($key, $target->getTargetKey());
        $this->assertSame([$right1, $right2], $target->getRights()->all());

        $target->setTargetType(TargetType::ACCOUNT())
               ->setTargetBy(TargetBy::NAME())
               ->setTargetKey($key)
               ->addRight($right3);

        $this->assertTrue($target->getTargetType()->is('account'));
        $this->assertTrue($target->getTargetBy()->is('name'));
        $this->assertSame($key, $target->getTargetKey());
        $this->assertSame([$right1, $right2, $right3], $target->getRights()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<target type="' . TargetType::ACCOUNT() . '" by="' . TargetBy::NAME() . '" key="' . $key . '">'
                . '<right>' . $right1 . '</right>'
                . '<right>' . $right2 . '</right>'
                . '<right>' . $right3 . '</right>'
            . '</target>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $target);

        $array = [
            'target' => [
                'type' => TargetType::ACCOUNT()->value(),
                'by' => TargetBy::NAME()->value(),
                'key' => $key,
                'right' => [
                    $right1,
                    $right2,
                    $right3,
                ],
            ],
        ];
        $this->assertEquals($array, $target->toArray());
    }

    public function testDistributionListSubscribeReq()
    {
        $value = md5(self::randomString());
        $subsReq = new \Zimbra\Account\Struct\DistributionListSubscribeReq(DLSubscribeOp::UNSUBSCRIBE(), $value, false);
        $this->assertTrue($subsReq->getOp()->is('unsubscribe'));
        $this->assertSame($value, $subsReq->getValue());
        $this->assertFalse($subsReq->getBccOwners());

        $subsReq->setOp(DLSubscribeOp::SUBSCRIBE())
                ->setBccOwners(true);
        $this->assertTrue($subsReq->getOp()->is('subscribe'));
        $this->assertTrue($subsReq->getBccOwners());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<subsReq op="' . DLSubscribeOp::SUBSCRIBE() . '" bccOwners="true">' . $value . '</subsReq>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $subsReq);

        $array = [
            'subsReq' => [
                'op' => DLSubscribeOp::SUBSCRIBE()->value(),
                '_content' => $value,
                'bccOwners' => true,
            ],
        ];
        $this->assertEquals($array, $subsReq->toArray());
    }

    public function testDistributionListGranteeSelector()
    {
        $value = md5(self::randomString());
        $grantee = new \Zimbra\Account\Struct\DistributionListGranteeSelector(GranteeType::ALL(), DLGranteeBy::ID(), $value);
        $this->assertTrue($grantee->getType()->is('all'));
        $this->assertTrue($grantee->getBy()->is('id'));
        $this->assertSame($value, $grantee->getValue());

        $grantee->setType(GranteeType::USR())
                ->setBy(DLGranteeBy::NAME());
        $this->assertTrue($grantee->getType()->is('usr'));
        $this->assertTrue($grantee->getBy()->is('name'));

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<grantee type="' . GranteeType::USR() . '" by="' . DLGranteeBy::NAME() . '">' . $value . '</grantee>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $grantee);

        $array = [
            'grantee' => [
                'type' => GranteeType::USR()->value(),
                '_content' => $value,
                'by' => DLGranteeBy::NAME()->value(),
            ],
        ];
        $this->assertEquals($array, $grantee->toArray());
    }

    public function testDistributionListRightSpec()
    {
        $name = self::randomName();
        $value1 = md5(self::randomString());
        $value2 = md5(self::randomString());
        $value3 = md5(self::randomString());
        $grantee1 = new \Zimbra\Account\Struct\DistributionListGranteeSelector(GranteeType::ALL(), DLGranteeBy::NAME(), $value1);
        $grantee2 = new \Zimbra\Account\Struct\DistributionListGranteeSelector(GranteeType::USR(), DLGranteeBy::ID(), $value2);
        $grantee3 = new \Zimbra\Account\Struct\DistributionListGranteeSelector(GranteeType::GRP(), DLGranteeBy::NAME(), $value3);

        $right = new \Zimbra\Account\Struct\DistributionListRightSpec($name, [$grantee1, $grantee2]);
        $this->assertSame($name, $right->getRight());
        $this->assertSame([$grantee1, $grantee2], $right->getGrantees()->all());

        $right->setRight($name)
              ->addGrantee($grantee3);
        $this->assertSame($name, $right->getRight());
        $this->assertSame([$grantee1, $grantee2, $grantee3], $right->getGrantees()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<right right="' . $name . '">'
                . '<grantee type="' . GranteeType::ALL() . '" by="' . DLGranteeBy::NAME() . '">' . $value1 . '</grantee>'
                . '<grantee type="' . GranteeType::USR() . '" by="' . DLGranteeBy::ID() . '">' . $value2 . '</grantee>'
                . '<grantee type="' . GranteeType::GRP() . '" by="' . DLGranteeBy::NAME() . '">' . $value3 . '</grantee>'
            . '</right>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $right);

        $array = [
            'right' => [
                'right' => $name,
                'grantee' => [
                    [
                        'type' => GranteeType::ALL()->value(),
                        '_content' => $value1,
                        'by' => DLGranteeBy::NAME()->value(),
                    ],
                    [
                        'type' => GranteeType::USR()->value(),
                        '_content' => $value2,
                        'by' => DLGranteeBy::ID()->value(),
                    ],
                    [
                        'type' => GranteeType::GRP()->value(),
                        '_content' => $value3,
                        'by' => DLGranteeBy::NAME()->value(),
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $right->toArray());
    }

    public function testDistributionListSelector()
    {
        $value = md5(self::randomString());
        $dl = new \Zimbra\Account\Struct\DistributionListSelector(DLBy::ID(), $value);
        $this->assertTrue($dl->getBy()->is('id'));
        $this->assertSame($value, $dl->getValue());

        $dl->setBy(DLBy::NAME());
        $this->assertTrue($dl->getBy()->is('name'));

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<dl by="' . DLBy::NAME() . '">' . $value . '</dl>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $dl);

        $array = [
            'dl' => [
                'by' => DLBy::NAME()->value(),
                '_content' => $value,
            ],
        ];
        $this->assertEquals($array, $dl->toArray());
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
        $attr = new \Zimbra\Struct\KeyValuePair($name, $value);

        $dl = new \Zimbra\Account\Struct\DistributionListAction(
            Operation::MODIFY(), $name, $subsReq, [$member], [$owner], [$right]
        );
        $this->assertTrue($dl->getOp()->is('modify'));
        $this->assertSame($name, $dl->getNewName());
        $this->assertSame($subsReq, $dl->getSubsReq());
        $this->assertSame([$member], $dl->getMembers()->all());
        $this->assertSame([$owner], $dl->getOwners()->all());
        $this->assertSame([$right], $dl->getRights()->all());

        $dl = new \Zimbra\Account\Struct\DistributionListAction(Operation::MODIFY());
        $dl->setOp(Operation::DELETE())
           ->setNewName($name)
           ->setSubsReq($subsReq)
           ->addMember($member)
           ->addOwner($owner)
           ->addRight($right)
           ->addAttr($attr);

        $this->assertTrue($dl->getOp()->is('delete'));
        $this->assertSame($name, $dl->getNewName());
        $this->assertSame($subsReq, $dl->getSubsReq());
        $this->assertSame([$member], $dl->getMembers()->all());
        $this->assertSame([$owner], $dl->getOwners()->all());
        $this->assertSame([$right], $dl->getRights()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<action op="' . Operation::DELETE() . '">'
                . '<newName>' . $name . '</newName>'
                . '<subsReq op="' . DLSubscribeOp::SUBSCRIBE() . '" bccOwners="true">' . $value . '</subsReq>'
                . '<a n="' . $name . '">' . $value . '</a>'
                . '<dlm>' . $member . '</dlm>'
                . '<owner type="' . GranteeType::USR() . '" by="' . DLGranteeBy::ID() . '">' . $value . '</owner>'
                . '<right right="' . $name . '">'
                    . '<grantee type="' . GranteeType::ALL() . '" by="' . DLGranteeBy::NAME() . '">' . $value . '</grantee>'
                . '</right>'
            . '</action>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $dl);

        $array = [
            'action' => [
                'op' => Operation::DELETE()->value(),
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
        ];
        $this->assertEquals($array, $dl->toArray());
    }

    public function testIdentity()
    {
        $name = self::randomName();
        $value = md5(self::randomString());
        $id = self::randomName();

        $attr1 = new \Zimbra\Account\Struct\Attr($name, $value, true);
        $attr2 = new \Zimbra\Account\Struct\Attr($name, $value, false);

        $identity = new \Zimbra\Account\Struct\Identity($name, $id, [$attr1]);
        $this->assertSame($name, $identity->getName());
        $this->assertSame($id, $identity->getId());
        $this->assertSame([$attr1], $identity->getAttrs()->all());

        $identity->setName($name)
                 ->setId($id)
                 ->addAttr($attr2);

        $this->assertSame($name, $identity->getName());
        $this->assertSame($id, $identity->getId());
        $this->assertSame([$attr1, $attr2], $identity->getAttrs()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<identity name="' . $name . '" id="' . $id . '">'
                . '<a name="' . $name . '" pd="true">' . $value . '</a>'
                . '<a name="' . $name . '" pd="false">' . $value . '</a>'
            . '</identity>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $identity);

        $array = [
            'identity' => [
                'name' => $name,
                'id' => $id,
                'a' => [
                    [
                        'name' => $name,
                        '_content' => $value,
                        'pd' => true,
                    ],
                    [
                        'name' => $name,
                        '_content' => $value,
                        'pd' => false,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $identity->toArray());
    }

    public function testNameId()
    {
        $name = self::randomName();
        $id = self::randomName();

        $nameId = new \Zimbra\Account\Struct\NameId($name, $id);
        $this->assertSame($name, $nameId->getName());
        $this->assertSame($id, $nameId->getId());

        $nameId->setName($name)
               ->setId($id);
        $this->assertSame($name, $nameId->getName());
        $this->assertSame($id, $nameId->getId());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<nameid name="' . $name . '" id="' . $id . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $nameId);

        $array = [
            'nameid' => [
                'name' => $name,
                'id' => $id,
            ],
        ];
        $this->assertEquals($array, $nameId->toArray());
    }

    public function testPreAuth()
    {
        $now = time();
        $value = md5(self::randomString());
        $expire = mt_rand(0, 1000);

        $pre = new \Zimbra\Account\Struct\PreAuth($now, $value, $expire);
        $this->assertSame($now, $pre->getTimestamp());
        $this->assertSame($value, $pre->getValue());
        $this->assertSame($expire, $pre->getExpiresTimestamp());

        $pre->setTimestamp($now + 1000)
            ->setExpiresTimestamp($expire);
        $this->assertSame($now + 1000, $pre->getTimestamp());
        $this->assertSame($expire, $pre->getExpiresTimestamp());

        $preauth = 'account' . '|name|' . $pre->getExpiresTimestamp() . '|' . $pre->getTimestamp();
        $computeValue = hash_hmac('sha1', $preauth, $value);
        $this->assertSame($computeValue, $pre->computeValue('account', $value)->getValue());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<preauth timestamp="' .($now + 1000). '" expiresTimestamp="' . $expire . '">' .$computeValue. '</preauth>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $pre);

        $array = [
            'preauth' => [
                'timestamp' => $now + 1000,
                'expiresTimestamp' => $expire,
                '_content' => $computeValue,
            ],
        ];
        $this->assertEquals($array, $pre->toArray());
    }

    public function testPref()
    {
        $name = self::randomName();
        $value = md5(self::randomString());
        $modified = mt_rand(1, 100);

        $pref = new \Zimbra\Account\Struct\Pref($name, $value, $modified);
        $this->assertSame($name, $pref->getName());
        $this->assertSame($value, $pref->getValue());
        $this->assertSame($modified, $pref->getModified());

        $modified = mt_rand(1, 1000);
        $pref->setName($name)
             ->setModified($modified);
        $this->assertSame($name, $pref->getName());
        $this->assertSame($modified, $pref->getModified());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<pref name="' . $name . '" modified="' .$modified . '">' . $value . '</pref>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $pref);

        $array = [
            'pref' => [
                'name' => $name,
                'modified' => $modified,
                '_content' => $value,
            ],
        ];
        $this->assertEquals($array, $pref->toArray());
    }

    public function testProp()
    {
        $zimlet = self::randomName();
        $name = self::randomName();
        $value = md5(self::randomString());

        $prop = new \Zimbra\Account\Struct\Prop($zimlet, $name, $value);
        $this->assertSame($zimlet, $prop->getZimlet());
        $this->assertSame($name, $prop->getName());
        $this->assertSame($value, $prop->getValue());

        $prop->setZimlet($zimlet)
             ->setName($name);
        $this->assertSame($zimlet, $prop->getZimlet());
        $this->assertSame($name, $prop->getName());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<prop zimlet="' . $zimlet . '" name="' . $name . '">'  .$value . '</prop>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $prop);

        $array = [
            'prop' => [
                'zimlet' => $zimlet,
                'name' => $name,
                '_content' => $value,
            ],
        ];
        $this->assertEquals($array, $prop->toArray());
    }

    public function testRight()
    {
        $name = self::randomName();
        $right = new \Zimbra\Account\Struct\Right($name);
        $this->assertSame($name, $right->getRight());

        $right->setRight($name);
        $this->assertSame($name, $right->getRight());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ace right="' . $name . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $right);

        $array = [
            'ace' => [
                'right' => $name,
            ],
        ];
        $this->assertEquals($array, $right->toArray());
    }

    public function testSignatureContent()
    {
        $value = md5(self::randomString());

        $content = new \Zimbra\Account\Struct\SignatureContent($value, ContentType::TEXT_PLAIN());
        $this->assertSame($value, $content->getValue());
        $this->assertSame('text/plain', $content->getContentType()->value());

        $content->setContentType(ContentType::TEXT_HTML());
        $this->assertSame('text/html', $content->getContentType()->value());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<content type="' . ContentType::TEXT_HTML() . '">' . $value . '</content>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $content);

        $array = [
            'content' => [
                'type' => ContentType::TEXT_HTML()->value(),
                '_content' => $value,
            ],
        ];
        $this->assertEquals($array, $content->toArray());
    }

    public function testSignature()
    {
        $value = md5(self::randomString());
        $name = self::randomName();
        $id = self::randomName();
        $cid = self::randomName();

        $content1 = new \Zimbra\Account\Struct\SignatureContent($value, ContentType::TEXT_PLAIN());
        $content2 = new \Zimbra\Account\Struct\SignatureContent($value, ContentType::TEXT_HTML());

        $sig = new \Zimbra\Account\Struct\Signature($name, $id, $cid, [$content1]);
        $this->assertSame($name, $sig->getName());
        $this->assertSame($id, $sig->getId());
        $this->assertSame($cid, $sig->getCid());
        $this->assertSame([$content1], $sig->getContents()->all());

        $sig->setName($name)
            ->setId($id)
            ->setCid($cid)
            ->addContent($content2);
        $this->assertSame($name, $sig->getName());
        $this->assertSame($id, $sig->getId());
        $this->assertSame($cid, $sig->getCid());
        $this->assertSame([$content1, $content2], $sig->getContents()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<signature name="' . $name . '" id="' . $id . '">'
                . '<cid>' . $cid . '</cid>'
                . '<content type="' . ContentType::TEXT_PLAIN() . '">' . $value . '</content>'
                . '<content type="' . ContentType::TEXT_HTML() . '">' . $value . '</content>'
            . '</signature>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $sig);

        $array = [
            'signature' => [
                'name' => $name,
                'id' => $id,
                'cid' => $cid,
                'content' => [
                    [
                        'type' => ContentType::TEXT_PLAIN()->value(),
                        '_content' => $value,
                    ],
                    [
                        'type' => ContentType::TEXT_HTML()->value(),
                        '_content' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $sig->toArray());
    }

    public function testWhiteList()
    {
        $value = md5(self::randomString());

        $addr1 = new \Zimbra\Struct\OpValue('+', $value);
        $addr2 = new \Zimbra\Struct\OpValue('-', $value);

        $whiteList = new \Zimbra\Account\Struct\WhiteList([$addr1]);
        $this->assertSame([$addr1], $whiteList->getAddrs()->all());

        $whiteList->addAddr($addr2);
        $this->assertSame([$addr1, $addr2], $whiteList->getAddrs()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<whiteList>'
                . '<addr op="+">' . $value . '</addr>'
                . '<addr op="-">' . $value . '</addr>'
            . '</whiteList>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $whiteList);

        $array = [
            'whiteList' => [
                'addr' => [
                    [
                        'op' => '+',
                        '_content' => $value,
                    ],
                    [
                        'op' => '-',
                        '_content' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $whiteList->toArray());
    }

    public function testZimletPrefsSpec()
    {
        $name = self::randomName();

        $zimlet = new \Zimbra\Account\Struct\ZimletPrefsSpec($name, ZimletStatus::ENABLED());
        $this->assertSame($name, $zimlet->getName());
        $this->assertSame('enabled', $zimlet->getPresence()->value());

        $zimlet->setName($name)
               ->setPresence(ZimletStatus::DISABLED());
        $this->assertSame($name, $zimlet->getName());
        $this->assertSame('disabled', $zimlet->getPresence()->value());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<zimlet name="' . $name . '" presence="' . ZimletStatus::DISABLED() . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $zimlet);

        $array = [
            'zimlet' => [
                'name' => $name,
                'presence' => ZimletStatus::DISABLED()->value(),
            ],
        ];
        $this->assertEquals($array, $zimlet->toArray());
    }
}
