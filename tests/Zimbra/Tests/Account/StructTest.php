<?php

namespace Zimbra\Tests\Account;

use Zimbra\Tests\ZimbraTestCase;

use Zimbra\Enum\AceRightType;
use Zimbra\Enum\ConditionOperator as CondOp;
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
        $ace = new \Zimbra\Account\Struct\AccountACEInfo(
            GranteeType::USR(), AceRightType::INVITE(), 'zid', 'd', 'key', 'pw', false, true
        );
        $this->assertTrue($ace->gt()->is('usr'));
        $this->assertTrue($ace->right()->is('invite'));
        $this->assertSame('zid', $ace->zid());
        $this->assertSame('d', $ace->d());
        $this->assertSame('key', $ace->key());
        $this->assertSame('pw', $ace->pw());
        $this->assertFalse($ace->deny());
        $this->assertTrue($ace->chkgt());

        $ace->gt(GranteeType::USR())
            ->right(AceRightType::INVITE())
            ->zid('zid')
            ->d('d')
            ->key('key')
            ->pw('pw')
            ->deny(true)
            ->chkgt(false);

        $this->assertTrue($ace->gt()->is('usr'));
        $this->assertTrue($ace->right()->is('invite'));
        $this->assertSame('zid', $ace->zid());
        $this->assertSame('d', $ace->d());
        $this->assertSame('key', $ace->key());
        $this->assertSame('pw', $ace->pw());
        $this->assertTrue($ace->deny());
        $this->assertFalse($ace->chkgt());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ace gt="usr" right="invite" zid="zid" d="d" key="key" pw="pw" deny="true" chkgt="false" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $ace);

        $array = array(
            'ace' => array(
                'gt' => 'usr',
                'right' => 'invite',
                'zid' => 'zid',
                'd' => 'd',
                'key' => 'key',
                'pw' => 'pw',
                'deny' => true,
                'chkgt' => false,
            ),
        );
        $this->assertEquals($array, $ace->toArray());
    }

    public function testAccountKeyValuePairs()
    {
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');
        $attrs = $this->getMockForAbstractClass('Zimbra\Account\Struct\AccountKeyValuePairs');

        $attrs->addAttr($attr);
        $this->assertSame(array($attr), $attrs->attr()->all());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<attrs>'
                .'<a n="key">value</a>'
            .'</attrs>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $attrs);

        $array = array(
            'attrs' => array(
                'a' => array(
                    array(
                        'n' => 'key',
                        '_' => 'value',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $attrs->toArray());
    }

    public function testAttr()
    {
        $attr = new \Zimbra\Account\Struct\Attr('name', 'value', false);
        $this->assertSame('name', $attr->name());
        $this->assertSame('value', $attr->value());
        $this->assertFalse($attr->pd());

        $attr->name('name')
             ->value('value')
             ->pd(true);
        $this->assertSame('name', $attr->name());
        $this->assertSame('value', $attr->value());
        $this->assertTrue($attr->pd());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<attr name="name" pd="true">value</attr>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $attr);

        $array = array(
            'attr' => array(
                'name' => 'name',
                '_' => 'value',
                'pd' => true,
            ),
        );
        $this->assertEquals($array, $attr->toArray());
    }

    public function testAttrsImpl()
    {
        $attr = new \Zimbra\Account\Struct\Attr('name', 'value', true);
        $attrs = $this->getMockForAbstractClass('Zimbra\Account\Struct\AttrsImpl');
 
        $attrs->addAttr($attr);
        $this->assertSame(array($attr), $attrs->attr()->all());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<attrs>'
                .'<a name="name" pd="true">value</a>'
            .'</attrs>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $attrs);

        $array = array(
            'attrs' => array(
                'a' => array(
                    array(
                        'name' => 'name',
                        '_' => 'value',
                        'pd' => true,
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $attrs->toArray());
    }

    public function testAuthAttrs()
    {
        $attr = new \Zimbra\Account\Struct\Attr('name', 'value', true);
        $attrs = new \Zimbra\Account\Struct\AuthAttrs(array($attr));
        $this->assertSame(array($attr), $attrs->attr()->all());

        $attrs->addAttr($attr);
        $this->assertSame(array($attr, $attr), $attrs->attr()->all());
        $attrs->attr()->remove(1);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<attrs>'
                .'<attr name="name" pd="true">value</attr>'
            .'</attrs>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $attrs);

        $array = array(
            'attrs' => array(
                'attr' => array(
                    array(
                        'name' => 'name',
                        '_' => 'value',
                        'pd' => true,
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $attrs->toArray());
    }

    public function testAuthPrefs()
    {
        $pref = new \Zimbra\Account\Struct\Pref('name', 'value', 100);
        $prefs = new \Zimbra\Account\Struct\AuthPrefs(array($pref));
        $this->assertSame(array($pref), $prefs->pref()->all());

        $prefs->addPref($pref);
        $this->assertSame(array($pref, $pref), $prefs->pref()->all());
        $prefs->pref()->remove(1);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<prefs>'
                .'<pref name="name" modified="100">value</pref>'
            .'</prefs>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $prefs);

        $array = array(
            'prefs' => array(
                'pref' => array(
                    array(
                        'name' => 'name',
                        '_' => 'value',
                        'modified' => 100,
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $prefs->toArray());
    }

    public function testAuthToken()
    {
        $token = new \Zimbra\Account\Struct\AuthToken('token', false);
        $this->assertSame('token', $token->value());
        $this->assertFalse($token->verifyAccount());

        $token->value('token')
              ->verifyAccount(true);
        $this->assertSame('token', $token->value());
        $this->assertTrue($token->verifyAccount());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<authToken verifyAccount="true">token</authToken>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $token);

        $array = array(
            'authToken' => array(
                'verifyAccount' => true,
                '_' => 'token',
            ),
        );
        $this->assertEquals($array, $token->toArray());
    }

    public function testBlackList()
    {
        $addr = new \Zimbra\Struct\OpValue('+', 'value');
        $blackList = new \Zimbra\Account\Struct\BlackList(array($addr));
        $this->assertSame(array($addr), $blackList->addr()->all());

        $blackList->addAddr($addr);
        $this->assertSame(array($addr, $addr), $blackList->addr()->all());
        $blackList->addr()->remove(1);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<blackList>'
                .'<addr op="+">value</addr>'
            .'</blackList>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $blackList);

        $array = array(
            'blackList' => array(
                'addr' => array(
                    array(
                        'op' => '+',
                        '_' => 'value',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $blackList->toArray());
    }

    public function testCheckRightsTargetSpec()
    {
        $target = new \Zimbra\Account\Struct\CheckRightsTargetSpec(
            TargetType::DOMAIN(), TargetBy::ID(), 'key', array('right1', 'right2')
        );
        $this->assertTrue($target->type()->is('domain'));
        $this->assertTrue($target->by()->is('id'));
        $this->assertSame('key', $target->key());
        $this->assertSame(array('right1', 'right2'), $target->right()->all());

        $target->type(TargetType::ACCOUNT())
               ->by(TargetBy::NAME())
               ->key('key')
               ->addRight('right3');

        $this->assertTrue($target->type()->is('account'));
        $this->assertTrue($target->by()->is('name'));
        $this->assertSame('key', $target->key());
        $this->assertSame(array('right1', 'right2', 'right3'), $target->right()->all());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<target type="account" by="name" key="key">'
                .'<right>right1</right>'
                .'<right>right2</right>'
                .'<right>right3</right>'
            .'</target>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $target);

        $array = array(
            'target' => array(
                'type' => 'account',
                'by' => 'name',
                'key' => 'key',
                'right' => array(
                    'right1',
                    'right2',
                    'right3',
                ),
            ),
        );
        $this->assertEquals($array, $target->toArray());
    }

    public function testDistributionListSubscribeReq()
    {
        $subsReq = new \Zimbra\Account\Struct\DistributionListSubscribeReq(DLSubscribeOp::UNSUBSCRIBE(), 'value', false);
        $this->assertTrue($subsReq->op()->is('unsubscribe'));
        $this->assertSame('value', $subsReq->value());
        $this->assertFalse($subsReq->bccOwners());

        $subsReq->op(DLSubscribeOp::SUBSCRIBE())
                ->value('value')
                ->bccOwners(true);
        $this->assertTrue($subsReq->op()->is('subscribe'));
        $this->assertSame('value', $subsReq->value());
        $this->assertTrue($subsReq->bccOwners());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<subsReq op="subscribe" bccOwners="true">value</subsReq>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $subsReq);

        $array = array(
            'subsReq' => array(
                'op' => 'subscribe',
                '_' => 'value',
                'bccOwners' => true,
            ),
        );
        $this->assertEquals($array, $subsReq->toArray());
    }

    public function testDistributionListGranteeSelector()
    {
        $grantee = new \Zimbra\Account\Struct\DistributionListGranteeSelector(GranteeType::ALL(), DLGranteeBy::ID(), 'grantee');
        $this->assertTrue($grantee->type()->is('all'));
        $this->assertTrue($grantee->by()->is('id'));
        $this->assertSame('grantee', $grantee->value());

        $grantee->type(GranteeType::USR())
                ->by(DLGranteeBy::NAME())
                ->value('value');
        $this->assertTrue($grantee->type()->is('usr'));
        $this->assertTrue($grantee->by()->is('name'));
        $this->assertSame('value', $grantee->value());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<grantee type="usr" by="name">value</grantee>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $grantee);

        $array = array(
            'grantee' => array(
                'type' => 'usr',
                '_' => 'value',
                'by' => 'name',
            ),
        );
        $this->assertEquals($array, $grantee->toArray());
    }

    public function testDistributionListRightSpec()
    {
        $grantee1 = new \Zimbra\Account\Struct\DistributionListGranteeSelector(GranteeType::ALL(), DLGranteeBy::NAME(), 'value1');
        $grantee2 = new \Zimbra\Account\Struct\DistributionListGranteeSelector(GranteeType::USR(), DLGranteeBy::ID(), 'value2');
        $grantee3 = new \Zimbra\Account\Struct\DistributionListGranteeSelector(GranteeType::GRP(), DLGranteeBy::NAME(), 'value3');

        $right = new \Zimbra\Account\Struct\DistributionListRightSpec('name', array($grantee1, $grantee2));
        $this->assertSame('name', $right->right());
        $this->assertSame(array($grantee1, $grantee2), $right->grantee()->all());

        $right->right('right')
              ->addGrantee($grantee3);
        $this->assertSame('right', $right->right());
        $this->assertSame(array($grantee1, $grantee2, $grantee3), $right->grantee()->all());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<right right="right">'
                .'<grantee type="all" by="name">value1</grantee>'
                .'<grantee type="usr" by="id">value2</grantee>'
                .'<grantee type="grp" by="name">value3</grantee>'
            .'</right>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $right);

        $array = array(
            'right' => array(
                'right' => 'right',
                'grantee' => array(
                    array(
                        'type' => 'all',
                        '_' => 'value1',
                        'by' => 'name',
                    ),
                    array(
                        'type' => 'usr',
                        '_' => 'value2',
                        'by' => 'id',
                    ),
                    array(
                        'type' => 'grp',
                        '_' => 'value3',
                        'by' => 'name',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $right->toArray());
    }

    public function testDistributionListSelector()
    {
        $dl = new \Zimbra\Account\Struct\DistributionListSelector(DLBy::ID(), 'dl');
        $this->assertTrue($dl->by()->is('id'));
        $this->assertSame('dl', $dl->value());

        $dl->by(DLBy::NAME())
           ->value('value');
        $this->assertTrue($dl->by()->is('name'));
        $this->assertSame('value', $dl->value());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<dl by="name">value</dl>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $dl);

        $array = array(
            'dl' => array(
                'by' => 'name',
                '_' => 'value',
            ),
        );
        $this->assertEquals($array, $dl->toArray());
    }

    public function testDistributionListAction()
    {
        $subsReq = new \Zimbra\Account\Struct\DistributionListSubscribeReq(DLSubscribeOp::SUBSCRIBE(), 'value', true);

        $owner = new \Zimbra\Account\Struct\DistributionListGranteeSelector(GranteeType::USR(), DLGranteeBy::ID(), 'value');
        $grantee = new \Zimbra\Account\Struct\DistributionListGranteeSelector(GranteeType::ALL(), DLGranteeBy::NAME(), 'value');

        $right = new \Zimbra\Account\Struct\DistributionListRightSpec('right', array($grantee));
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');

        $dl = new \Zimbra\Account\Struct\DistributionListAction(
            Operation::MODIFY(), 'name', $subsReq, array('dlm'), array($owner), array($right)
        );
        $this->assertTrue($dl->op()->is('modify'));
        $this->assertSame('name', $dl->newName());
        $this->assertSame($subsReq, $dl->subsReq());
        $this->assertSame(array('dlm'), $dl->dlm()->all());
        $this->assertSame(array($owner), $dl->owner()->all());
        $this->assertSame(array($right), $dl->right()->all());

        $dl = new \Zimbra\Account\Struct\DistributionListAction(Operation::RENAME());
        $dl->op(Operation::DELETE())
           ->newName('newName')
           ->subsReq($subsReq)
           ->addDlm('dlm')
           ->addOwner($owner)
           ->addRight($right)
           ->addAttr($attr);

        $this->assertTrue($dl->op()->is('delete'));
        $this->assertSame('newName', $dl->newName());
        $this->assertSame($subsReq, $dl->subsReq());
        $this->assertSame(array('dlm'), $dl->dlm()->all());
        $this->assertSame(array($owner), $dl->owner()->all());
        $this->assertSame(array($right), $dl->right()->all());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<action op="delete">'
                .'<newName>newName</newName>'
                .'<subsReq op="subscribe" bccOwners="true">value</subsReq>'
                .'<a n="key">value</a>'
                .'<dlm>dlm</dlm>'
                .'<owner type="usr" by="id">value</owner>'
                .'<right right="right">'
                    .'<grantee type="all" by="name">value</grantee>'
                .'</right>'
            .'</action>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $dl);

        $array = array(
            'action' => array(
                'op' => 'delete',
                'newName' => 'newName',
                'subsReq' => array(
                    'op' => 'subscribe',
                    '_' => 'value',
                    'bccOwners' => true,
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
        );
        $this->assertEquals($array, $dl->toArray());
    }

    public function testEntrySearchFilterSingleCond()
    {
        $cond = new \Zimbra\Account\Struct\EntrySearchFilterSingleCond('attr', CondOp::EQ(), 'value', false);
        $this->assertSame('attr', $cond->attr());
        $this->assertTrue($cond->op()->is('eq'));
        $this->assertSame('value', $cond->value());
        $this->assertFalse($cond->notFlag());

        $cond->attr('attr')
             ->op(CondOp::EQ())
             ->value('value')
             ->notFlag(true);
        $this->assertSame('attr', $cond->attr());
        $this->assertTrue($cond->op()->is('eq'));
        $this->assertSame('value', $cond->value());
        $this->assertTrue($cond->notFlag());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<cond attr="attr" op="eq" value="value" not="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $cond);

        $array = array(
            'cond' => array(
                'attr' => 'attr',
                'op' => 'eq',
                'value' => 'value',
                'not' => true,
            ),
        );
        $this->assertEquals($array, $cond->toArray());
    }

    public function testEntrySearchFilterMultiCond()
    {
        $otherCond = new \Zimbra\Account\Struct\EntrySearchFilterSingleCond('attr', CondOp::GE(), 'value', false);
        $otherConds = new \Zimbra\Account\Struct\EntrySearchFilterMultiCond(false, true, NULL, $otherCond);
        $cond = new \Zimbra\Account\Struct\EntrySearchFilterSingleCond('a', CondOp::EQ(), 'v', true);
        $conds = new \Zimbra\Account\Struct\EntrySearchFilterMultiCond(false, true, $otherConds, $cond);

        $this->assertFalse($conds->notFlag());
        $this->assertTrue($conds->orFlag());
        $this->assertSame($cond, $conds->cond());
        $this->assertSame($otherConds, $conds->conds());

        $conds->notFlag(true)
              ->orFlag(false)
              ->conds($otherConds)
              ->cond($cond);
    
        $this->assertTrue($conds->notFlag());
        $this->assertFalse($conds->orFlag());
        $this->assertSame($cond, $conds->cond());
        $this->assertSame($otherConds, $conds->conds());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<conds not="true" or="false">'
                .'<conds not="false" or="true">'
                    .'<cond attr="attr" op="ge" value="value" not="false" />'
                .'</conds>'
                .'<cond attr="a" op="eq" value="v" not="true" />'
            .'</conds>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $conds);

        $array = array(
            'conds' => array(
                'not' => true,
                'or' => false,
                'conds' => array(
                    'not' => false,
                    'or' => true,
                    'cond' => array(
                        'attr' => 'attr',
                        'op' => 'ge',
                        'value' => 'value',
                        'not' => false,
                    ),                    
                ),
                'cond' => array(
                    'attr' => 'a',
                    'op' => 'eq',
                    'value' => 'v',
                    'not' => true,
                ),                    
            ),
        );
        $this->assertEquals($array, $conds->toArray());
    }

    public function testEntrySearchFilterInfo()
    {
        $otherCond = new \Zimbra\Account\Struct\EntrySearchFilterSingleCond('attr', CondOp::GE(), 'value', false);
        $otherConds = new \Zimbra\Account\Struct\EntrySearchFilterMultiCond(false, true, NULL, $otherCond);
        $cond = new \Zimbra\Account\Struct\EntrySearchFilterSingleCond('a', CondOp::EQ(), 'v', true);
        $conds = new \Zimbra\Account\Struct\EntrySearchFilterMultiCond(true, false, $otherConds, $cond);

        $filter = new \Zimbra\Account\Struct\EntrySearchFilterInfo($conds, $cond);
        $this->assertSame($conds, $filter->conds());
        $this->assertSame($cond, $filter->cond());

        $filter->conds($conds)
               ->cond($cond);

        $this->assertSame($conds, $filter->conds());
        $this->assertSame($cond, $filter->cond());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<searchFilter>'
                .'<conds not="true" or="false">'
                    .'<conds not="false" or="true">'
                        .'<cond attr="attr" op="ge" value="value" not="false" />'
                    .'</conds>'
                    .'<cond attr="a" op="eq" value="v" not="true" />'
                .'</conds>'
                .'<cond attr="a" op="eq" value="v" not="true" />'
            .'</searchFilter>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $filter);

        $array = array(
            'searchFilter' => array(
                'conds' => array(
                    'not' => true,
                    'or' => false,
                    'conds' => array(
                        'not' => false,
                        'or' => true,
                        'cond' => array(
                            'attr' => 'attr',
                            'op' => 'ge',
                            'value' => 'value',
                            'not' => false,
                        ),
                    ),
                    'cond' => array(
                        'attr' => 'a',
                        'op' => 'eq',
                        'value' => 'v',
                        'not' => true,
                    ),
                ),
                'cond' => array(
                    'attr' => 'a',
                    'op' => 'eq',
                    'value' => 'v',
                    'not' => true,
                ),
            ),
        );
        $this->assertEquals($array, $filter->toArray());
    }

    public function testIdentity()
    {
        $attr1 = new \Zimbra\Account\Struct\Attr('name1', 'value1', true);
        $attr2 = new \Zimbra\Account\Struct\Attr('name2', 'value2', false);
        $attr3 = new \Zimbra\Account\Struct\Attr('name3', 'value3', true);

        $identity = new \Zimbra\Account\Struct\Identity('name', 'id', array($attr1, $attr2));
        $this->assertSame('name', $identity->name());
        $this->assertSame('id', $identity->id());
        $this->assertSame(array($attr1, $attr2), $identity->attr()->all());

        $identity->name('name')
                 ->id('id')
                 ->addAttr($attr3);

        $this->assertSame('name', $identity->name());
        $this->assertSame('id', $identity->id());
        $this->assertSame(array($attr1, $attr2, $attr3), $identity->attr()->all());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<identity name="name" id="id">'
                .'<a name="name1" pd="true">value1</a>'
                .'<a name="name2" pd="false">value2</a>'
                .'<a name="name3" pd="true">value3</a>'
            .'</identity>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $identity);

        $array = array(
            'identity' => array(
                'name' => 'name',
                'id' => 'id',
                'a' => array(
                    array(
                        'name' => 'name1',
                        '_' => 'value1',
                        'pd' => true,
                    ),
                    array(
                        'name' => 'name2',
                        '_' => 'value2',
                        'pd' => false,
                    ),
                    array(
                        'name' => 'name3',
                        '_' => 'value3',
                        'pd' => true,
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $identity->toArray());
    }

    public function testNameId()
    {
        $nameId = new \Zimbra\Account\Struct\NameId('name', 'id');
        $this->assertSame('name', $nameId->name());
        $this->assertSame('id', $nameId->id());

        $nameId->name('name')
               ->id('id');
        $this->assertSame('name', $nameId->name());
        $this->assertSame('id', $nameId->id());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<nameid name="name" id="id" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $nameId);

        $array = array(
            'nameid' => array(
                'name' => 'name',
                'id' => 'id',
            ),
        );
        $this->assertEquals($array, $nameId->toArray());
    }

    public function testPreAuth()
    {
        $now = time();
        $pre = new \Zimbra\Account\Struct\PreAuth($now, 'value', 100);
        $this->assertSame($now, $pre->timestamp());
        $this->assertSame('value', $pre->value());
        $this->assertSame(100, $pre->expiresTimestamp());

        $pre->timestamp($now + 1000)
            ->value('value')
            ->expiresTimestamp(1000);
        $this->assertSame($now + 1000, $pre->timestamp());
        $this->assertSame('value', $pre->value());
        $this->assertSame(1000, $pre->expiresTimestamp());

        $preauth = 'account' . '|name|' . $pre->expiresTimestamp() . '|' . $pre->timestamp();
        $computeValue = hash_hmac('sha1', $preauth, 'value');
        $this->assertSame($computeValue, $pre->computeValue('account', 'value')->value());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<preauth timestamp="'.($now + 1000).'" expiresTimestamp="1000">'.$computeValue.'</preauth>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $pre);

        $array = array(
            'preauth' => array(
                'timestamp' => $now + 1000,
                'expiresTimestamp' => 1000,
                '_' => $computeValue,
            ),
        );
        $this->assertEquals($array, $pre->toArray());
    }

    public function testPref()
    {
        $pref = new \Zimbra\Account\Struct\Pref('name', 'value', 100);
        $this->assertSame('name', $pref->name());
        $this->assertSame('value', $pref->value());
        $this->assertSame(100, $pref->modified());

        $pref->name('name')
             ->value('value')
             ->modified(1000);
        $this->assertSame('name', $pref->name());
        $this->assertSame('value', $pref->value());
        $this->assertSame(1000, $pref->modified());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<pref name="name" modified="1000">value</pref>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $pref);

        $array = array(
            'pref' => array(
                'name' => 'name',
                'modified' => 1000,
                '_' => 'value',
            ),
        );
        $this->assertEquals($array, $pref->toArray());
    }

    public function testProp()
    {
        $prop = new \Zimbra\Account\Struct\Prop('zimlet', 'name', 'value');
        $this->assertSame('zimlet', $prop->zimlet());
        $this->assertSame('name', $prop->name());
        $this->assertSame('value', $prop->value());

        $prop->zimlet('zimlet')
             ->name('name')
             ->value('value');
        $this->assertSame('zimlet', $prop->zimlet());
        $this->assertSame('name', $prop->name());
        $this->assertSame('value', $prop->value());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<prop zimlet="zimlet" name="name">value</prop>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $prop);

        $array = array(
            'prop' => array(
                'zimlet' => 'zimlet',
                'name' => 'name',
                '_' => 'value',
            ),
        );
        $this->assertEquals($array, $prop->toArray());
    }

    public function testRight()
    {
        $right = new \Zimbra\Account\Struct\Right('right');
        $this->assertSame('right', $right->right());

        $right->right('right');
        $this->assertSame('right', $right->right());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ace right="right" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $right);

        $array = array(
            'ace' => array(
                'right' => 'right',
            ),
        );
        $this->assertEquals($array, $right->toArray());
    }

    public function testSignatureContent()
    {
        $content = new \Zimbra\Account\Struct\SignatureContent('v', ContentType::TEXT_PLAIN());
        $this->assertSame('v', $content->value());
        $this->assertSame('text/plain', $content->type()->value());

        $content->value('value')
                ->type(ContentType::TEXT_HTML());
        $this->assertSame('value', $content->value());
        $this->assertSame('text/html', $content->type()->value());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<content type="text/html">value</content>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $content);

        $array = array(
            'content' => array(
                'type' => 'text/html',
                '_' => 'value',
            ),
        );
        $this->assertEquals($array, $content->toArray());
    }

    public function testSignature()
    {
        $content1 = new \Zimbra\Account\Struct\SignatureContent('value1', ContentType::TEXT_PLAIN());
        $content2 = new \Zimbra\Account\Struct\SignatureContent('value2', ContentType::TEXT_HTML());

        $sig = new \Zimbra\Account\Struct\Signature('n', 'i', 'c', array($content1));
        $this->assertSame('n', $sig->name());
        $this->assertSame('i', $sig->id());
        $this->assertSame('c', $sig->cid());
        $this->assertSame(array($content1), $sig->content()->all());

        $sig->name('name')
            ->id('id')
            ->cid('cid')
            ->addContent($content2);
        $this->assertSame('name', $sig->name());
        $this->assertSame('id', $sig->id());
        $this->assertSame('cid', $sig->cid());
        $this->assertSame(array($content1, $content2), $sig->content()->all());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<signature name="name" id="id">'
                .'<cid>cid</cid>'
                .'<content type="text/plain">value1</content>'
                .'<content type="text/html">value2</content>'
            .'</signature>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $sig);

        $array = array(
            'signature' => array(
                'name' => 'name',
                'id' => 'id',
                'cid' => 'cid',
                'content' => array(
                    array(
                        'type' => 'text/plain',
                        '_' => 'value1',
                    ),
                    array(
                        'type' => 'text/html',
                        '_' => 'value2',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $sig->toArray());
    }

    public function testWhiteList()
    {
        $addr = new \Zimbra\Struct\OpValue('+', 'value');
        $whiteList = new \Zimbra\Account\Struct\WhiteList(array($addr));
        $this->assertSame(array($addr), $whiteList->addr()->all());

        $whiteList->addAddr($addr);
        $this->assertSame(array($addr, $addr), $whiteList->addr()->all());
        $whiteList->addr()->remove(1);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<whiteList>'
                .'<addr op="+">value</addr>'
            .'</whiteList>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $whiteList);

        $array = array(
            'whiteList' => array(
                'addr' => array(
                    array(
                        'op' => '+',
                        '_' => 'value',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $whiteList->toArray());
    }

    public function testZimletPrefsSpec()
    {
        $zimlet = new \Zimbra\Account\Struct\ZimletPrefsSpec('name', ZimletStatus::ENABLED());
        $this->assertSame('name', $zimlet->name());
        $this->assertSame('enabled', $zimlet->presence()->value());

        $zimlet->name('name')
               ->presence(ZimletStatus::DISABLED());
        $this->assertSame('name', $zimlet->name());
        $this->assertSame('disabled', $zimlet->presence()->value());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<zimlet name="name" presence="disabled" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $zimlet);

        $array = array(
            'zimlet' => array(
                'name' => 'name',
                'presence' => 'disabled',
            ),
        );
        $this->assertEquals($array, $zimlet->toArray());
    }
}
