<?php

namespace Zimbra\Tests\Soap;

use Zimbra\Tests\ZimbraTestCase;
use Zimbra\Utils\SimpleXML;

use Zimbra\Soap\Enum\AccountBy;
use Zimbra\Soap\Enum\AceRightType;
use Zimbra\Soap\Enum\AclType;
use Zimbra\Soap\Enum\AlarmAction;
use Zimbra\Soap\Enum\AuthScheme;
use Zimbra\Soap\Enum\AutoProvPrincipalBy as PrincipalBy;
use Zimbra\Soap\Enum\CacheEntryBy;
use Zimbra\Soap\Enum\CalendarResourceBy as CalResBy;
use Zimbra\Soap\Enum\ContentType;
use Zimbra\Soap\Enum\CosBy;
use Zimbra\Soap\Enum\DataSourceBy;
use Zimbra\Soap\Enum\DataSourceType;
use Zimbra\Soap\Enum\DistributionListBy as DLBy;
use Zimbra\Soap\Enum\DistributionListGranteeBy as DLGranteeBy;
use Zimbra\Soap\Enum\DistributionListSubscribeOp as DLSubscribeOp;
use Zimbra\Soap\Enum\DomainBy;
use Zimbra\Soap\Enum\FreeBusyStatus;
use Zimbra\Soap\Enum\Frequency;
use Zimbra\Soap\Enum\GranteeType;
use Zimbra\Soap\Enum\GranteeBy;
use Zimbra\Soap\Enum\InterestType;
use Zimbra\Soap\Enum\InviteChange;
use Zimbra\Soap\Enum\InviteClass;
use Zimbra\Soap\Enum\InviteStatus;
use Zimbra\Soap\Enum\LoggingLevel;
use Zimbra\Soap\Enum\Operation;
use Zimbra\Soap\Enum\ParticipationStatus as PartStatus;
use Zimbra\Soap\Enum\QueueAction;
use Zimbra\Soap\Enum\QueueActionBy;
use Zimbra\Soap\Enum\ServerBy;
use Zimbra\Soap\Enum\TargetType;
use Zimbra\Soap\Enum\TargetBy;
use Zimbra\Soap\Enum\Transparency;
use Zimbra\Soap\Enum\Type;
use Zimbra\Soap\Enum\UcServiceBy;
use Zimbra\Soap\Enum\WeekDay;
use Zimbra\Soap\Enum\XmppComponentBy as XmppBy;
use Zimbra\Soap\Enum\ZimletStatus;

/**
 * Testcase class for soap struct.
 */
class StructTest extends ZimbraTestCase
{
    public function testAccountACEInfo()
    {
        $ace = new \Zimbra\Soap\Struct\AccountACEInfo(
            GranteeType::USR(), AceRightType::INVITE(), 'z', 'd', 'k', 'p', false, true
        );
        $this->assertTrue($ace->gt()->is('usr'));
        $this->assertTrue($ace->right()->is('invite'));
        $this->assertSame('z', $ace->zid());
        $this->assertSame('d', $ace->d());
        $this->assertSame('k', $ace->key());
        $this->assertSame('p', $ace->pw());
        $this->assertFalse($ace->deny());
        $this->assertTrue($ace->chkgt());

        $ace->gt(GranteeType::ALL())
            ->right(AceRightType::VIEW_FREE_BUSY())
            ->zid('zid')
            ->d('dir')
            ->key('key')
            ->pw('pw')
            ->deny(true)
            ->chkgt(false);

        $this->assertTrue($ace->gt()->is('all'));
        $this->assertTrue($ace->right()->is('viewFreeBusy'));
        $this->assertSame('zid', $ace->zid());
        $this->assertSame('dir', $ace->d());
        $this->assertSame('key', $ace->key());
        $this->assertSame('pw', $ace->pw());
        $this->assertTrue($ace->deny());
        $this->assertFalse($ace->chkgt());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ace gt="all" right="viewFreeBusy" zid="zid" d="dir" key="key" pw="pw" deny="1" chkgt="0" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $ace);

        $array = array(
            'ace' => array(
                'gt' => 'all',
                'right' => 'viewFreeBusy',
                'zid' => 'zid',
                'd' => 'dir',
                'key' => 'key',
                'pw' => 'pw',
                'deny' => 1,
                'chkgt' => 0,
            ),
        );
        $this->assertEquals($array, $ace->toArray());
    }

    public function testAccountSelector()
    {
        $acc = new \Zimbra\Soap\Struct\AccountSelector(AccountBy::ID(), 'value');
        $this->assertTrue($acc->by()->is('id'));
        $this->assertSame('value', $acc->value());

        $acc->value('name')
            ->by(AccountBy::ADMIN_NAME());
        $this->assertTrue($acc->by()->is('adminName'));
        $this->assertSame('name', $acc->value());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<account by="adminName">name</account>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $acc);

        $array = array(
            'account' => array(
                'by' => 'adminName',
                '_' => 'name',
            ),
        );
        $this->assertEquals($array, $acc->toArray());
    }

    public function testAttachmentIdAttrib()
    {
        $content = new \Zimbra\Soap\Struct\AttachmentIdAttrib('id');
        $this->assertSame('id', $content->aid());
        $content->aid('aid');
        $this->assertSame('aid', $content->aid());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<content aid="aid" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $content);

        $array = array(
            'content' => array(
                'aid' => 'aid',
            ),
        );
        $this->assertEquals($array, $content->toArray());
    }

    public function testAttr()
    {
        $attr = new \Zimbra\Soap\Struct\Attr('n', 'v', false);
        $this->assertSame('n', $attr->name());
        $this->assertSame('v', $attr->value());
        $this->assertFalse($attr->pd());

        $attr->name('name')
             ->value('value')
             ->pd(true);
        $this->assertSame('name', $attr->name());
        $this->assertSame('value', $attr->value());
        $this->assertTrue($attr->pd());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<attr name="name" pd="1">value</attr>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $attr);

        $array = array(
            'attr' => array(
                'name' => 'name',
                '_' => 'value',
                'pd' => 1,
            ),
        );
        $this->assertEquals($array, $attr->toArray());
    }

    public function testKeyValuePair()
    {
        $kpv = new \Zimbra\Soap\Struct\KeyValuePair('k', 'v');
        $this->assertSame('k', $kpv->key());
        $this->assertSame('v', $kpv->value());

        $kpv->key('key')
            ->value('value');
        $this->assertSame('key', $kpv->key());
        $this->assertSame('value', $kpv->value());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<a n="key">value</a>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $kpv);

        $array = array(
            'a' => array(
                'n' => 'key',
                '_' => 'value',
            ),
        );
        $this->assertEquals($array, $kpv->toArray());
    }

    public function testAttrsImpl()
    {
        $stub = $this->getMockForAbstractClass('\Zimbra\Soap\Struct\AttrsImpl');

        $attr1 = new \Zimbra\Soap\Struct\KeyValuePair('key1', 'value1');
        $attr2 = new \Zimbra\Soap\Struct\KeyValuePair('key2', 'value2');
        $attr3 = new \Zimbra\Soap\Struct\KeyValuePair('key3', 'value3');
        $stub->addAttr($attr1)->attr()->addAll(array($attr2, $attr3));
        foreach ($stub->attr() as $attr)
        {
            $this->assertInstanceOf('\Zimbra\Soap\Struct\KeyValuePair', $attr);
        }

        $arr = array('a' => array(
            array('n' => 'key1', '_' => 'value1'),
            array('n' => 'key2', '_' => 'value2'),
            array('n' => 'key3', '_' => 'value3'),
        ));
        $this->assertEquals($arr, $stub->toArray());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<attrs>'
                .'<a n="key1">value1</a>'
                .'<a n="key2">value2</a>'
                .'<a n="key3">value3</a>'
            .'</attrs>';
        $this->assertXmlStringEqualsXmlString($xml, $stub->appendAttrs(new SimpleXML('<attrs />'))->asXml());
    }

    public function testAuthToken()
    {
        $token = new \Zimbra\Soap\Struct\AuthToken('t', false);
        $this->assertSame('t', $token->value());
        $this->assertFalse($token->verifyAccount());

        $token->value('token')
              ->verifyAccount(true);
        $this->assertSame('token', $token->value());
        $this->assertTrue($token->verifyAccount());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<authToken verifyAccount="1">token</authToken>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $token);

        $array = array(
            'authToken' => array(
                'verifyAccount' => 1,
                '_' => 'token',
            ),
        );
        $this->assertEquals($array, $token->toArray());
    }

    public function testCacheEntrySelector()
    {
        $entry = new \Zimbra\Soap\Struct\CacheEntrySelector(CacheEntryBy::NAME(), 'cache');
        $this->assertTrue($entry->by()->is('name'));
        $this->assertSame('cache', $entry->value());

        $entry->by(CacheEntryBy::ID())
              ->value('value');
        $this->assertTrue($entry->by()->is('id'));
        $this->assertSame('value', $entry->value());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<entry by="id">value</entry>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $entry);

        $array = array(
            'entry' => array(
                'by' => 'id',
                '_' => 'value',
            ),
        );
        $this->assertEquals($array, $entry->toArray());
    }

    public function testCacheSelector()
    {
        $entry1 = new \Zimbra\Soap\Struct\CacheEntrySelector(CacheEntryBy::ID(), 'value1');
        $entry2 = new \Zimbra\Soap\Struct\CacheEntrySelector(CacheEntryBy::NAME(), 'value2');

        $cache = new \Zimbra\Soap\Struct\CacheSelector('skin,abc,locale,xyz,account', false, array($entry1));
        $this->assertSame('skin,locale,account', $cache->type());
        $this->assertFalse($cache->allServers());
        $this->assertSame(array($entry1), $cache->entry()->all());

        $cache->type('abc,skin,account,xyz')
              ->allServers(true)
              ->addEntry($entry2);
        $this->assertSame('skin,account', $cache->type());
        $this->assertTrue($cache->allServers());
        $this->assertSame(array($entry1, $entry2), $cache->entry()->all());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<cache type="skin,account" allServers="1">'
                .'<entry by="id">value1</entry>'
                .'<entry by="name">value2</entry>'
            .'</cache>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $cache);

        $array = array(
            'cache' => array(
                'type' => 'skin,account',
                'allServers' => 1,
                'entry' => array(
                    array(
                        'by' => 'id',
                        '_' => 'value1',
                    ),
                    array(
                        'by' => 'name',
                        '_' => 'value2',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $cache->toArray());
    }

    public function testXParam()
    {
        $xparam = new \Zimbra\Soap\Struct\XParam('n', 'v');
        $this->assertSame('n', $xparam->name());
        $this->assertSame('v', $xparam->value());

        $xparam->name('name')
               ->value('value');
        $this->assertSame('name', $xparam->name());
        $this->assertSame('value', $xparam->value());


        $xml = '<?xml version="1.0"?>'."\n"
            .'<xparam name="name" value="value" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $xparam);

        $array = array(
            'xparam' => array(
                'name' => 'name',
                'value' => 'value',
            ),
        );
        $this->assertEquals($array, $xparam->toArray());
    }

    public function testCalendarAttendee()
    {
        $xparam1 = new \Zimbra\Soap\Struct\XParam('name1', 'value1');
        $xparam2 = new \Zimbra\Soap\Struct\XParam('name2', 'value2');
        $cal = new \Zimbra\Soap\Struct\CalendarAttendee(array($xparam1)
            , 'a', 'url', 'd', 'sentBy', 'dir', 'lang', 'cutype', 'role', PartStatus::NE(), true, 'member', 'delTo', 'delFrom'
        );
        $this->assertSame(array($xparam1), $cal->xparam()->all());
        $this->assertSame('a', $cal->a());
        $this->assertSame('url', $cal->url());
        $this->assertSame('d', $cal->d());
        $this->assertSame('sentBy', $cal->sentBy());
        $this->assertSame('dir', $cal->dir());
        $this->assertSame('lang', $cal->lang());
        $this->assertSame('cutype', $cal->cutype());
        $this->assertSame('role', $cal->role());
        $this->assertTrue($cal->ptst()->is('NE'));
        $this->assertTrue($cal->rsvp());
        $this->assertSame('member', $cal->member());
        $this->assertSame('delTo', $cal->delTo());
        $this->assertSame('delFrom', $cal->delFrom());

        $cal->addXParam($xparam2);
        $this->assertSame(array($xparam1, $xparam2), $cal->xparam()->all());
        $cal->a('a')
            ->url('url')
            ->d('d')
            ->sentBy('sentBy')
            ->dir('dir')
            ->lang('lang')
            ->cutype('cutype')
            ->role('role')
            ->ptst(PartStatus::AC())
            ->rsvp(true)
            ->member('member')
            ->delTo('delTo')
            ->delFrom('delFrom');
        $this->assertSame('a', $cal->a());
        $this->assertSame('url', $cal->url());
        $this->assertSame('d', $cal->d());
        $this->assertSame('sentBy', $cal->sentBy());
        $this->assertSame('dir', $cal->dir());
        $this->assertSame('lang', $cal->lang());
        $this->assertSame('cutype', $cal->cutype());
        $this->assertSame('role', $cal->role());
        $this->assertTrue($cal->ptst()->is('AC'));
        $this->assertTrue($cal->rsvp());
        $this->assertSame('member', $cal->member());
        $this->assertSame('delTo', $cal->delTo());
        $this->assertSame('delFrom', $cal->delFrom());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<at a="a" url="url" d="d" sentBy="sentBy" dir="dir" lang="lang" cutype="cutype" role="role" ptst="AC" rsvp="1" member="member" delTo="delTo" delFrom="delFrom">'
                .'<xparam name="name1" value="value1" />'
                .'<xparam name="name2" value="value2" />'
            .'</at>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $cal);

        $array = array(
            'at' => array(
                'a' => 'a',
                'url' => 'url',
                'd' => 'd',
                'sentBy' => 'sentBy',
                'dir' => 'dir',
                'lang' => 'lang',
                'cutype' => 'cutype',
                'role' => 'role',
                'ptst' => 'AC',
                'rsvp' => 1,
                'member' => 'member',
                'delTo' => 'delTo',
                'delFrom' => 'delFrom',
                'xparam' => array(
                    array(
                        'name' => 'name1',
                        'value' => 'value1',
                    ),
                    array(
                        'name' => 'name2',
                        'value' => 'value2',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $cal->toArray());
    }

    public function testCalendarResourceSelector()
    {
        $cal = new \Zimbra\Soap\Struct\CalendarResourceSelector(CalResBy::ID(), 'calRes');
        $this->assertTrue($cal->by()->is('id'));
        $this->assertSame('calRes', $cal->value());

        $cal->by(CalResBy::NAME())
            ->value('value');
        $this->assertTrue($cal->by()->is('name'));
        $this->assertSame('value', $cal->value());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<calresource by="name">value</calresource>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $cal);

        $array = array(
            'calresource' => array(
                'by' => 'name',
                '_' => 'value',
            ),
        );
        $this->assertEquals($array, $cal->toArray());
    }

    public function testTzOnsetInfo()
    {
        $tzo = new \Zimbra\Soap\Struct\TzOnsetInfo(4, 3, 2, 1, 7, -1, 5);
        $this->assertSame(4, $tzo->mon());
        $this->assertSame(3, $tzo->hour());
        $this->assertSame(2, $tzo->min());
        $this->assertSame(1, $tzo->sec());
        $this->assertSame(7, $tzo->mday());
        $this->assertSame(-1, $tzo->week());
        $this->assertSame(5, $tzo->wkday());

        $tzo->mon(1)
            ->hour(2)
            ->min(3)
            ->sec(4)
            ->mday(5)
            ->week(6)
            ->wkday(7);
        $this->assertSame(1, $tzo->mon());
        $this->assertSame(2, $tzo->hour());
        $this->assertSame(3, $tzo->min());
        $this->assertSame(4, $tzo->sec());
        $this->assertSame(5, $tzo->mday());
        $this->assertSame(-1, $tzo->week());
        $this->assertSame(7, $tzo->wkday());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<info mon="1" hour="2" min="3" sec="4" mday="5" week="-1" wkday="7" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $tzo);
        $array = array(
            'info' => array(
                'mon' => 1,
                'hour' => 2,
                'min' => 3,
                'sec' => 4,
                'mday' => 5,
                'week' => -1,
                'wkday' => 7,
            ),
        );
        $this->assertEquals($array, $tzo->toArray());
    }

    public function testCalTZInfo()
    {
        $standard = new \Zimbra\Soap\Struct\TzOnsetInfo(1, 2, 3, 4);
        $daylight = new \Zimbra\Soap\Struct\TzOnsetInfo(4, 3, 2, 1);

        $tzi = new \Zimbra\Soap\Struct\CalTZInfo('i', 2, 3, 'std', 'day', $daylight, $standard);
        $this->assertSame('i', $tzi->id());
        $this->assertSame(2, $tzi->stdoff());
        $this->assertSame(3, $tzi->dayoff());
        $this->assertSame('std', $tzi->stdname());
        $this->assertSame('day', $tzi->dayname());
        $this->assertSame($daylight, $tzi->standard());
        $this->assertSame($standard, $tzi->daylight());

        $tzi->id('id')
            ->stdoff(1)
            ->dayoff(1)
            ->stdname('stdname')
            ->dayname('dayname')
            ->standard($standard)
            ->daylight($daylight);
        $this->assertSame('id', $tzi->id());
        $this->assertSame(1, $tzi->stdoff());
        $this->assertSame(1, $tzi->dayoff());
        $this->assertSame('stdname', $tzi->stdname());
        $this->assertSame('dayname', $tzi->dayname());
        $this->assertSame($standard, $tzi->standard());
        $this->assertSame($daylight, $tzi->daylight());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<tz id="id" stdoff="1" dayoff="1" stdname="stdname" dayname="dayname">'
                .'<standard mon="1" hour="2" min="3" sec="4" />'
                .'<daylight mon="4" hour="3" min="2" sec="1" />'
            .'</tz>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $tzi);

        $array = array(
            'tz' => array(
                'id' => 'id',
                'stdoff' => 1,
                'dayoff' => 1,
                'stdname' => 'stdname',
                'dayname' => 'dayname',
                'standard' => array(
                    'mon' => 1,
                    'hour' => 2,
                    'min' => 3,
                    'sec' => 4,
                ),
                'daylight' => array(
                    'mon' => 4,
                    'hour' => 3,
                    'min' => 2,
                    'sec' => 1,
                ),
            ),
        );
        $this->assertEquals($array, $tzi->toArray());
    }

    public function testCheckDirSelector()
    {
        $dir = new \Zimbra\Soap\Struct\CheckDirSelector('dir', false);
        $this->assertSame('dir', $dir->path());
        $this->assertFalse($dir->create());

        $dir->path('path')
            ->create(true);
        $this->assertSame('path', $dir->path());
        $this->assertTrue($dir->create());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<directory path="path" create="1" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $dir);

        $array = array(
            'directory' => array(
                'path' => 'path',
                'create' => 1,
            ),
        );
        $this->assertEquals($array, $dir->toArray());
    }

    public function testCheckRightsTargetSpec()
    {
        $target = new \Zimbra\Soap\Struct\CheckRightsTargetSpec(TargetType::DOMAIN(), TargetBy::ID(), 'key', array('right1', 'right2'));
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

    public function testConstraintInfo()
    {
        $constraint = new \Zimbra\Soap\Struct\ConstraintInfo('max', 'min', array('value'));
        $this->assertSame('max', $constraint->min());
        $this->assertSame('min', $constraint->max());
        $this->assertSame(array('value'), $constraint->value()->all());

        $constraint->min('min')
            ->max('max')
            ->addValue('value1');
        $this->assertSame('min', $constraint->min());
        $this->assertSame('max', $constraint->max());
        $this->assertSame(array('value', 'value1'), $constraint->value()->all());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<constraint>'
                .'<min>min</min>'
                .'<max>max</max>'
                .'<values>'
                    .'<v>value</v>'
                    .'<v>value1</v>'
                .'</values>'
            .'</constraint>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $constraint);

        $array = array(
            'constraint' => array(
                'min' => 'min',
                'max' => 'max',
                'values' => array(
                    'v' => array(
                        'value',
                        'value1',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $constraint->toArray());
    }

    public function testConstraintAttr()
    {
        $constraint = new \Zimbra\Soap\Struct\ConstraintInfo('min', 'max', array('value1', 'value2'));
        $attr = new \Zimbra\Soap\Struct\ConstraintAttr('attr', $constraint);
        $this->assertSame('attr', $attr->name());
        $this->assertSame($constraint, $attr->constraint());

        $attr->name('name')
            ->constraint($constraint);

        $this->assertSame('name', $attr->name());
        $this->assertSame($constraint, $attr->constraint());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<a name="name">'
                .'<constraint>'
                    .'<min>min</min>'
                    .'<max>max</max>'
                    .'<values>'
                        .'<v>value1</v>'
                        .'<v>value2</v>'
                    .'</values>'
                .'</constraint>'
            .'</a>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $attr);

        $array = array(
            'a' => array(
                'name' => 'name',
                'constraint' => array(
                    'min' => 'min',
                    'max' => 'max',
                    'values' => array(
                        'v' => array(
                            'value1',
                            'value2',
                        ),
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $attr->toArray());
    }

    public function testCookieSpec()
    {
        $cookie = new \Zimbra\Soap\Struct\CookieSpec('cookie');
        $this->assertSame('cookie', $cookie->name());

        $cookie->name('name');
        $this->assertSame('name', $cookie->name());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<cookie name="name" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $cookie);

        $array = array(
            'cookie' => array(
                'name' => 'name',
            ),
        );
        $this->assertEquals($array, $cookie->toArray());
    }

    public function testCosSelector()
    {
        $cos = new \Zimbra\Soap\Struct\CosSelector(CosBy::ID(), 'cos');
        $this->assertTrue($cos->by()->is('id'));
        $this->assertSame('cos', $cos->value());

        $cos->by(CosBy::NAME())
            ->value('value');
        $this->assertTrue($cos->by()->is('name'));
        $this->assertSame('value', $cos->value());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<cos by="name">value</cos>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $cos);

        $array = array(
            'cos' => array(
                'by' => 'name',
                '_' => 'value',
            ),
        );
        $this->assertEquals($array, $cos->toArray());
    }

    public function testCursorInfo()
    {
        $cursor = new \Zimbra\Soap\Struct\CursorInfo('i','sort', 'end', false);
        $this->assertSame('i', $cursor->id());
        $this->assertSame('sort', $cursor->sortVal());
        $this->assertSame('end', $cursor->endSortVal());
        $this->assertFalse($cursor->includeOffset());

        $cursor->id('id')
               ->sortVal('sortVal')
               ->endSortVal('endSortVal')
               ->includeOffset(true);
        $this->assertSame('id', $cursor->id());
        $this->assertSame('sortVal', $cursor->sortVal());
        $this->assertSame('endSortVal', $cursor->endSortVal());
        $this->assertTrue($cursor->includeOffset());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<cursor id="id" sortVal="sortVal" endSortVal="endSortVal" includeOffset="1" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $cursor);

        $array = array(
            'cursor' => array(
                'id' => 'id',
                'sortVal' => 'sortVal',
                'endSortVal' => 'endSortVal',
                'includeOffset' => 1,
            ),
        );
        $this->assertEquals($array, $cursor->toArray());
    }

    public function testDataSourceSpecifier()
    {
        $ds = new \Zimbra\Soap\Struct\DataSourceSpecifier(DataSourceType::IMAP(), 'n');
        $this->assertTrue($ds->type()->is('imap'));
        $this->assertSame('n', $ds->name());

        $attr = new \Zimbra\Soap\Struct\KeyValuePair('key', 'value');
        $ds->type(DataSourceType::POP3())
           ->name('name')
           ->addAttr($attr);
        $this->assertTrue($ds->type()->is('pop3'));
        $this->assertSame('name', $ds->name());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<dataSource type="pop3" name="name">'
                .'<a n="key">value</a>'
            .'</dataSource>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $ds);

        $array = array(
            'dataSource' => array(
                'type' => 'pop3',
                'name' => 'name',
                'a' => array(
                    array(
                        'n' => 'key',
                        '_' => 'value',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $ds->toArray());
    }

    public function testDeviceId()
    {
        $device = new \Zimbra\Soap\Struct\DeviceId('i');
        $this->assertSame('i', $device->id());

        $device->id('id');
        $this->assertSame('id', $device->id());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<device id="id" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $device);

        $array = array(
            'device' => array(
                'id' => 'id',
            ),
        );
        $this->assertEquals($array, $device->toArray());
    }

    public function testDistributionListSubscribeReq()
    {
        $subsReq = new \Zimbra\Soap\Struct\DistributionListSubscribeReq(DLSubscribeOp::UNSUBSCRIBE(), 'v', false);
        $this->assertTrue($subsReq->op()->is('unsubscribe'));
        $this->assertSame('v', $subsReq->value());
        $this->assertFalse($subsReq->bccOwners());

        $subsReq->op(DLSubscribeOp::SUBSCRIBE())
                ->value('value')
                ->bccOwners(true);
        $this->assertTrue($subsReq->op()->is('subscribe'));
        $this->assertSame('value', $subsReq->value());
        $this->assertTrue($subsReq->bccOwners());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<subsReq op="subscribe" bccOwners="1">value</subsReq>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $subsReq);

        $array = array(
            'subsReq' => array(
                'op' => 'subscribe',
                '_' => 'value',
                'bccOwners' => 1,
            ),
        );
        $this->assertEquals($array, $subsReq->toArray());
    }

    public function testDistributionListGranteeSelector()
    {
        $grantee = new \Zimbra\Soap\Struct\DistributionListGranteeSelector(GranteeType::ALL(), DLGranteeBy::ID(), 'grantee');
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
        $grantee1 = new \Zimbra\Soap\Struct\DistributionListGranteeSelector(GranteeType::ALL(), DLGranteeBy::NAME(), 'value1');
        $grantee2 = new \Zimbra\Soap\Struct\DistributionListGranteeSelector(GranteeType::USR(), DLGranteeBy::ID(), 'value2');
        $grantee3 = new \Zimbra\Soap\Struct\DistributionListGranteeSelector(GranteeType::GRP(), DLGranteeBy::NAME(), 'value3');

        $right = new \Zimbra\Soap\Struct\DistributionListRightSpec('name', array($grantee1, $grantee2));
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

    public function testDistributionListAction()
    {
        $subsReq = new \Zimbra\Soap\Struct\DistributionListSubscribeReq(DLSubscribeOp::SUBSCRIBE(), 'value', true);

        $owner = new \Zimbra\Soap\Struct\DistributionListGranteeSelector(GranteeType::USR(), DLGranteeBy::ID(), 'value');
        $grantee = new \Zimbra\Soap\Struct\DistributionListGranteeSelector(GranteeType::ALL(), DLGranteeBy::NAME(), 'value');

        $right = new \Zimbra\Soap\Struct\DistributionListRightSpec('right', array($grantee));
        $attr = new \Zimbra\Soap\Struct\KeyValuePair('key', 'value');

        $dl = new \Zimbra\Soap\Struct\DistributionListAction(
            Operation::MODIFY(), 'name', $subsReq, array('dlm'), array($owner), array($right)
        );
        $this->assertTrue($dl->op()->is('modify'));
        $this->assertSame('name', $dl->newName());
        $this->assertSame($subsReq, $dl->subsReq());
        $this->assertSame(array('dlm'), $dl->dlm()->all());
        $this->assertSame(array($owner), $dl->owner()->all());
        $this->assertSame(array($right), $dl->right()->all());

        $dl = new \Zimbra\Soap\Struct\DistributionListAction(Operation::RENAME());
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
                .'<subsReq op="subscribe" bccOwners="1">value</subsReq>'
                .'<dlm>dlm</dlm>'
                .'<owner type="usr" by="id">value</owner>'
                .'<right right="right">'
                    .'<grantee type="all" by="name">value</grantee>'
                .'</right>'
                .'<a n="key">value</a>'
            .'</action>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $dl);

        $array = array(
            'action' => array(
                'op' => 'delete',
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
        );
        $this->assertEquals($array, $dl->toArray());
    }

    public function testDistributionListSelector()
    {
        $dl = new \Zimbra\Soap\Struct\DistributionListSelector(DLBy::ID(), 'dl');
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

    public function testDomainSelector()
    {
        $domain = new \Zimbra\Soap\Struct\DomainSelector(DomainBy::ID(), 'domain');
        $this->assertTrue($domain->by()->is('id'));
        $this->assertSame('domain', $domain->value());

        $domain->by(DomainBy::NAME())
               ->value('value');
        $this->assertTrue($domain->by()->is('name'));
        $this->assertSame('value', $domain->value());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<domain by="name">value</domain>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $domain);

        $array = array(
            'domain' => array(
                'by' => 'name',
                '_' => 'value',
            ),
        );
        $this->assertEquals($array, $domain->toArray());
    }

    public function testEffectiveRightsTargetSelector()
    {
        $target = new \Zimbra\Soap\Struct\EffectiveRightsTargetSelector(
            TargetType::DOMAIN(), 'target', TargetBy::ID()
        );
        $this->assertTrue($target->type()->is('domain'));
        $this->assertSame('target', $target->value());
        $this->assertSame('id', $target->by()->value());

        $target->type(TargetType::ACCOUNT())
               ->value('value')
               ->by(TargetBy::NAME());

        $this->assertSame('account', $target->type()->value());
        $this->assertSame('value', $target->value());
        $this->assertSame('name', $target->by()->value());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<target type="account" by="name">value</target>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $target);

        $array = array(
            'target' => array(
                'type' => 'account',
                '_' => 'value',
                'by' => 'name',
            ),
        );
        $this->assertEquals($array, $target->toArray());
    }

    public function testEntrySearchFilterSingleCond()
    {
        $cond = new \Zimbra\Soap\Struct\EntrySearchFilterSingleCond('a', 'has', 'v', false);
        $this->assertSame('a', $cond->attr());
        $this->assertSame('has', $cond->op());
        $this->assertSame('v', $cond->value());
        $this->assertFalse($cond->notFlag());

        $cond->attr('attr')
             ->op('eq')
             ->value('value')
             ->notFlag(true);
        $this->assertSame('attr', $cond->attr());
        $this->assertSame('eq', $cond->op());
        $this->assertSame('value', $cond->value());
        $this->assertTrue($cond->notFlag());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<cond attr="attr" op="eq" value="value" not="1" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $cond);

        $array = array(
            'cond' => array(
                'attr' => 'attr',
                'op' => 'eq',
                'value' => 'value',
                'not' => 1,
            ),
        );
        $this->assertEquals($array, $cond->toArray());
    }

    public function testEntrySearchFilterMultiCond()
    {
        $otherCond = new \Zimbra\Soap\Struct\EntrySearchFilterSingleCond('attr', 'ge', 'value', false);
        $otherConds = new \Zimbra\Soap\Struct\EntrySearchFilterMultiCond(0, 1, NULL, $otherCond);
        $cond = new \Zimbra\Soap\Struct\EntrySearchFilterSingleCond('a', 'eq', 'v', true);
        $conds = new \Zimbra\Soap\Struct\EntrySearchFilterMultiCond(false, true, $otherConds, $cond);

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
            .'<conds not="1" or="0">'
                .'<conds not="0" or="1">'
                    .'<cond attr="attr" op="ge" value="value" not="0" />'
                .'</conds>'
                .'<cond attr="a" op="eq" value="v" not="1" />'
            .'</conds>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $conds);

        $array = array(
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
        );
        $this->assertEquals($array, $conds->toArray());
    }

    public function testEntrySearchFilterInfo()
    {
        $otherCond = new \Zimbra\Soap\Struct\EntrySearchFilterSingleCond('attr', 'ge', 'value', false);
        $otherConds = new \Zimbra\Soap\Struct\EntrySearchFilterMultiCond(0, 1, NULL, $otherCond);
        $cond = new \Zimbra\Soap\Struct\EntrySearchFilterSingleCond('a', 'eq', 'v', true);
        $conds = new \Zimbra\Soap\Struct\EntrySearchFilterMultiCond(1, 0, $otherConds, $cond);

        $filter = new \Zimbra\Soap\Struct\EntrySearchFilterInfo($conds, $cond);
        $this->assertSame($conds, $filter->conds());
        $this->assertSame($cond, $filter->cond());

        $filter->conds($conds)
               ->cond($cond);

        $this->assertSame($conds, $filter->conds());
        $this->assertSame($cond, $filter->cond());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<searchFilter>'
                .'<conds not="1" or="0">'
                    .'<conds not="0" or="1">'
                        .'<cond attr="attr" op="ge" value="value" not="0" />'
                    .'</conds>'
                    .'<cond attr="a" op="eq" value="v" not="1" />'
                .'</conds>'
                .'<cond attr="a" op="eq" value="v" not="1" />'
            .'</searchFilter>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $filter);

        $array = array(
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
        );
        $this->assertEquals($array, $filter->toArray());
    }

    public function testExchangeAuthSpec()
    {
        $exc = new \Zimbra\Soap\Struct\ExchangeAuthSpec('u', 'u', 'p', AuthScheme::BASIC(), 't');
        $this->assertSame('u', $exc->url());
        $this->assertSame('u', $exc->user());
        $this->assertSame('p', $exc->pass());
        $this->assertSame('basic', $exc->scheme()->value());
        $this->assertSame('t', $exc->type());

        $exc->url('url')
            ->user('user')
            ->pass('pass')
            ->scheme(AuthScheme::FORM())
            ->type('type');

        $this->assertSame('url', $exc->url());
        $this->assertSame('user', $exc->user());
        $this->assertSame('pass', $exc->pass());
        $this->assertSame('form', $exc->scheme()->value());
        $this->assertSame('type', $exc->type());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<auth url="url" user="user" pass="pass" scheme="form" type="type" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $exc);

        $array = array(
            'auth' => array(
                'url' => 'url',
                'user' => 'user',
                'pass' => 'pass',
                'scheme' => 'form',
                'type' => 'type',
            ),
        );
        $this->assertEquals($array, $exc->toArray());
    }

    public function testExportAndDeleteItemSpec()
    {
        $item = new \Zimbra\Soap\Struct\ExportAndDeleteItemSpec(2, 1);
        $this->assertSame(2, $item->id());
        $this->assertSame(1, $item->version());

        $item->id(1)
            ->version(2);
        $this->assertSame(1, $item->id());
        $this->assertSame(2, $item->version());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<item id="1" version="2" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $item);

        $array = array(
            'item' => array(
                'id' => 1,
                'version' => 2,
            ),
        );
        $this->assertEquals($array, $item->toArray());
    }

    public function testExportAndDeleteMailboxSpec()
    {
        $item1 = new \Zimbra\Soap\Struct\ExportAndDeleteItemSpec(1, 2);
        $item2 = new \Zimbra\Soap\Struct\ExportAndDeleteItemSpec(3, 4);
        $item3 = new \Zimbra\Soap\Struct\ExportAndDeleteItemSpec(5, 6);

        $mbox = new \Zimbra\Soap\Struct\ExportAndDeleteMailboxSpec(1, array($item1, $item2));
        $this->assertSame(1, $mbox->id());
        $this->assertSame(array($item1, $item2), $mbox->item()->all());

        $mbox->id(2)
             ->addItem($item3);

        $this->assertSame(2, $mbox->id());
        $this->assertSame(array($item1, $item2, $item3), $mbox->item()->all());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<mbox id="2">'
                .'<item id="1" version="2" />'
                .'<item id="3" version="4" />'
                .'<item id="5" version="6" />'
            .'</mbox>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $mbox);

        $array = array(
            'mbox' => array(
                'id' => 2,
                'item' => array(
                    array(
                        'id' => 1,
                        'version' => 2,
                    ),
                    array(
                        'id' => 3,
                        'version' => 4,
                    ),
                    array(
                        'id' => 5,
                        'version' => 6,
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $mbox->toArray());
    }

    public function testGranteeChooser()
    {
        $grantee = new \Zimbra\Soap\Struct\GranteeChooser('t', 'i', 'n');
        $this->assertSame('t', $grantee->type());
        $this->assertSame('i', $grantee->id());
        $this->assertSame('n', $grantee->name());

        $grantee->type('type')
                ->id('id')
                ->name('name');
        $this->assertSame('type', $grantee->type());
        $this->assertSame('id', $grantee->id());
        $this->assertSame('name', $grantee->name());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<grantee type="type" id="id" name="name" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $grantee);

        $array = array(
            'grantee' => array(
                'type' => 'type',
                'id' => 'id',
                'name' => 'name',
            ),
        );
        $this->assertEquals($array, $grantee->toArray());
    }

    public function testGranteeSelector()
    {
        $grantee = new \Zimbra\Soap\Struct\GranteeSelector(
            'grantee', GranteeType::ALL(), GranteeBy::NAME(), 'secr3t', false
        );
        $this->assertSame('all', $grantee->type()->value());
        $this->assertSame('name', $grantee->by()->value());
        $this->assertSame('grantee', $grantee->value());
        $this->assertSame('secr3t', $grantee->secret());
        $this->assertFalse($grantee->all());

        $grantee->type(GranteeType::USR())
                ->by(GranteeBy::ID())
                ->value('value')
                ->secret('secret')
                ->all(true);
        $this->assertSame('usr', $grantee->type()->value());
        $this->assertSame('id', $grantee->by()->value());
        $this->assertSame('value', $grantee->value());
        $this->assertSame('secret', $grantee->secret());
        $this->assertTrue($grantee->all());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<grantee type="usr" by="id" secret="secret" all="1">value</grantee>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $grantee);

        $array = array(
            'grantee' => array(
                '_' => 'value',
                'type' => 'usr',
                'by' => 'id',
                'secret' => 'secret',
                'all' => 1,
            ),
        );
        $this->assertEquals($array, $grantee->toArray());
    }

    public function testHostName()
    {
        $host = new \Zimbra\Soap\Struct\HostName('hostName');
        $this->assertSame('hostName', $host->hn());

        $host->hn('host');
        $this->assertSame('host', $host->hn());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<hostname hn="host" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $host);

        $array = array(
            'hostname' => array(
                'hn' => 'host',
            ),
        );
        $this->assertEquals($array, $host->toArray());
    }

    public function testId()
    {
        $id = new \Zimbra\Soap\Struct\Id('string');
        $this->assertSame('string', $id->id());

        $id->id('id');
        $this->assertSame('id', $id->id());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<id id="id" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $id);

        $array = array(
            'id' => array(
                'id' => 'id',
            ),
        );
        $this->assertEquals($array, $id->toArray());
    }

    public function testIdAndAction()
    {
        $ia = new \Zimbra\Soap\Struct\IdAndAction('i', 'bug72174');
        $this->assertSame('i', $ia->id());
        $this->assertSame('bug72174', $ia->action());

        $ia->id('id')
           ->action('wiki');
        $this->assertSame('id', $ia->id());
        $this->assertSame('wiki', $ia->action());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ia id="id" action="wiki" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $ia);

        $array = array(
            'ia' => array(
                'id' => 'id',
                'action' => 'wiki',
            ),
        );
        $this->assertEquals($array, $ia->toArray());
    }

    public function testIdentity()
    {
        $attr1 = new \Zimbra\Soap\Struct\Attr('name1', 'value1', true);
        $attr2 = new \Zimbra\Soap\Struct\Attr('name2', 'value2', false);
        $attr3 = new \Zimbra\Soap\Struct\Attr('name3', 'value3', true);

        $identity = new \Zimbra\Soap\Struct\Identity('n', 'i', array($attr1, $attr2));
        $this->assertSame('n', $identity->name());
        $this->assertSame('i', $identity->id());
        $this->assertSame(array($attr1, $attr2), $identity->attr()->all());

        $identity->name('name')
                 ->id('id')
                 ->addAttr($attr3);

        $this->assertSame('name', $identity->name());
        $this->assertSame('id', $identity->id());
        $this->assertSame(array($attr1, $attr2, $attr3), $identity->attr()->all());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<identity name="name" id="id">'
                .'<a name="name1" pd="1">value1</a>'
                .'<a name="name2" pd="0">value2</a>'
                .'<a name="name3" pd="1">value3</a>'
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
                        'pd' => 1,
                    ),
                    array(
                        'name' => 'name2',
                        '_' => 'value2',
                        'pd' => 0,
                    ),
                    array(
                        'name' => 'name3',
                        '_' => 'value3',
                        'pd' => 1,
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $identity->toArray());
    }

    public function testIdStatus()
    {
        $is = new \Zimbra\Soap\Struct\IdStatus('i', 's');
        $this->assertSame('i', $is->id());
        $this->assertSame('s', $is->status());

        $is->id('id')
           ->status('status');
        $this->assertSame('id', $is->id());
        $this->assertSame('status', $is->status());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<device id="id" status="status" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $is);

        $array = array(
            'device' => array(
                'id' => 'id',
                'status' => 'status',
            ),
        );
        $this->assertEquals($array, $is->toArray());
    }

    public function testIntegerValueAttrib()
    {
        $attr = new \Zimbra\Soap\Struct\IntegerValueAttrib(1);
        $this->assertSame(1, $attr->value());

        $attr->value(10);
        $this->assertSame(10, $attr->value());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<a value="10" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $attr);

        $array = array(
            'a' => array(
                'value' => 10,
            ),
        );
        $this->assertEquals($array, $attr->toArray());
    }

    public function testIntIdAttr()
    {
        $attr = new \Zimbra\Soap\Struct\IntIdAttr(1);
        $this->assertSame(1, $attr->id());

        $attr->id(10);
        $this->assertSame(10, $attr->id());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<attr id="10" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $attr);

        $array = array(
            'attr' => array(
                'id' => 10,
            ),
        );
        $this->assertEquals($array, $attr->toArray());
    }

    public function testLimitedQuery()
    {
        $query = new \Zimbra\Soap\Struct\LimitedQuery(10, 'query');
        $this->assertSame(10, $query->limit());
        $this->assertSame('query', $query->value());

        $query->limit(100)
           ->value('value');
        $this->assertSame(100, $query->limit());
        $this->assertSame('value', $query->value());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<query limit="100">value</query>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $query);

        $array = array(
            'query' => array(
                'limit' => 100,
                '_' => 'value',
            ),
        );
        $this->assertEquals($array, $query->toArray());
    }

    public function testLoggerInfo()
    {
        $logger = new \Zimbra\Soap\Struct\LoggerInfo('cate', LoggingLevel::ERROR());
        $this->assertSame('cate', $logger->category());
        $this->assertSame('error', $logger->level()->value());

        $logger->category('category')
               ->level(LoggingLevel::INFO());
        $this->assertSame('category', $logger->category());
        $this->assertSame('info', $logger->level()->value());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<logger category="category" level="info" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $logger);

        $array = array(
            'logger' => array(
                'category' => 'category',
                'level' => 'info',
            ),
        );
        $this->assertEquals($array, $logger->toArray());
    }

    public function testMailboxByAccountIdSelector()
    {
        $mbox = new \Zimbra\Soap\Struct\MailboxByAccountIdSelector('i');
        $this->assertSame('i', $mbox->id());

        $mbox->id('id');
        $this->assertSame('id', $mbox->id());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<mbox id="id" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $mbox);

        $array = array(
            'mbox' => array(
                'id' => 'id',
            ),
        );
        $this->assertEquals($array, $mbox->toArray());
    }

    public function testValueAttrib()
    {
        $attr = new \Zimbra\Soap\Struct\ValueAttrib('v');
        $this->assertSame('v', $attr->value());

        $attr->value('value');
        $this->assertSame('value', $attr->value());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<a value="value" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $attr);

        $array = array(
            'a' => array(
                'value' => 'value',
            ),
        );
        $this->assertEquals($array, $attr->toArray());
    }

    public function testQueueQueryField()
    {
        $match1 = new \Zimbra\Soap\Struct\ValueAttrib('value1');
        $match2 = new \Zimbra\Soap\Struct\ValueAttrib('value2');

        $field = new \Zimbra\Soap\Struct\QueueQueryField('n', array($match1));
        $this->assertSame('n', $field->name());
        $this->assertSame(array($match1), $field->match()->all());

        $field->name('name')
              ->addMatch($match2);
        $this->assertSame('name', $field->name());
        $this->assertSame(array($match1, $match2), $field->match()->all());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<field name="name">'
                .'<match value="value1" />'
                .'<match value="value2" />'
            .'</field>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $field);

        $array = array(
            'field' => array(
                'name' => 'name',
                'match' => array(
                    array('value' => 'value1'),
                    array('value' => 'value2'),
                )
            ),
        );
        $this->assertEquals($array, $field->toArray());
    }

    public function testQueueQuery()
    {
        $match = new \Zimbra\Soap\Struct\ValueAttrib('value');
        $field = new \Zimbra\Soap\Struct\QueueQueryField('name', array($match));

        $query = new \Zimbra\Soap\Struct\QueueQuery(array($field), 10, 10);
        $this->assertSame(10, $query->limit());
        $this->assertSame(10, $query->offset());
        $this->assertSame(array($field), $query->field()->all());

        $query->limit(100)
              ->offset(0)
              ->addField($field);
        $this->assertSame(100, $query->limit());
        $this->assertSame(0, $query->offset());
        $this->assertSame(array($field, $field), $query->field()->all());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<query limit="100" offset="0">'
                .'<field name="name">'
                    .'<match value="value" />'
                .'</field>'
                .'<field name="name">'
                    .'<match value="value" />'
                .'</field>'
            .'</query>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $query);

        $array = array(
            'query' => array(
                'limit' => 100,
                'offset' => 0,
                'field' => array(
                    array(
                        'name' => 'name',
                        'match' => array(
                            array('value' => 'value'),
                        )
                    ),
                    array(
                        'name' => 'name',
                        'match' => array(
                            array('value' => 'value'),
                        )
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $query->toArray());
    }

    public function testMailQueueAction()
    {
        $attr = new \Zimbra\Soap\Struct\ValueAttrib('value');
        $field = new \Zimbra\Soap\Struct\QueueQueryField('name', array($attr));
        $query = new \Zimbra\Soap\Struct\QueueQuery(array($field), 100, 0);
        $action = new \Zimbra\Soap\Struct\MailQueueAction($query, QueueAction::REQUEUE(), QueueActionBy::ID());

        $this->assertSame($query, $action->query());
        $this->assertSame('requeue', $action->op()->value());
        $this->assertSame('id', $action->by()->value());

        $action->query($query)
               ->op(QueueAction::HOLD())
               ->by(QueueActionBy::QUERY());

        $this->assertSame($query, $action->query());
        $this->assertSame('hold', $action->op()->value());
        $this->assertSame('query', $action->by()->value());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<action op="hold" by="query">'
                .'<query limit="100" offset="0">'
                    .'<field name="name">'
                        .'<match value="value" />'
                    .'</field>'
                .'</query>'
            .'</action>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $action);

        $array = array(
            'action' => array(
                'op' => 'hold',
                'by' => 'query',
                'query' => array(
                    'limit' => 100,
                    'offset' => 0,
                    'field' => array(
                        array(
                            'name' => 'name',
                            'match' => array(
                                array('value' => 'value'),
                            )
                        )
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $action->toArray());
    }

    public function testMailQueueQuery()
    {
        $attr = new \Zimbra\Soap\Struct\ValueAttrib('value');
        $field = new \Zimbra\Soap\Struct\QueueQueryField('name', array($attr));
        $query = new \Zimbra\Soap\Struct\QueueQuery(array($field), 100, 0);

        $queue = new \Zimbra\Soap\Struct\MailQueueQuery($query, 'n', false, 100);
        $this->assertSame($query, $queue->query());
        $this->assertSame('n', $queue->name());
        $this->assertFalse($queue->scan());
        $this->assertSame(100, $queue->wait());

        $queue->query($query)
              ->name('name')
              ->scan(true)
              ->wait(1);
        $this->assertSame($query, $queue->query());
        $this->assertSame('name', $queue->name());
        $this->assertTrue($queue->scan());
        $this->assertSame(1, $queue->wait());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<queue name="name" scan="1" wait="1">'
                .'<query limit="100" offset="0">'
                    .'<field name="name">'
                        .'<match value="value" />'
                    .'</field>'
                .'</query>'
            .'</queue>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $queue);

        $array = array(
            'queue' => array(
                'name' => 'name',
                'scan' => 1,
                'wait' => 1,
                'query' => array(
                    'limit' => 100,
                    'offset' => 0,
                    'field' => array(
                        array(
                            'name' => 'name',
                            'match' => array(
                                array('value' => 'value'),
                            )
                        )
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $queue->toArray());
    }

    public function testMailQueueWithAction()
    {
        $attr = new \Zimbra\Soap\Struct\ValueAttrib('value');
        $field = new \Zimbra\Soap\Struct\QueueQueryField('name', array($attr));
        $query = new \Zimbra\Soap\Struct\QueueQuery(array($field), 100, 0);
        $action = new \Zimbra\Soap\Struct\MailQueueAction($query, QueueAction::HOLD(), QueueActionBy::QUERY());

        $queue = new \Zimbra\Soap\Struct\MailQueueWithAction('n', $action);
        $this->assertSame('n', $queue->name());
        $this->assertSame($action, $queue->action());

        $queue->action($action)
              ->name('name');
        $this->assertSame('name', $queue->name());
        $this->assertSame($action, $queue->action());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<queue name="name">'
                .'<action op="hold" by="query">'
                    .'<query limit="100" offset="0">'
                        .'<field name="name">'
                            .'<match value="value" />'
                        .'</field>'
                    .'</query>'
                .'</action>'
            .'</queue>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $queue);

        $array = array(
            'queue' => array(
                'name' => 'name',
                'action' => array(
                    'op' => 'hold',
                    'by' => 'query',
                    'query' => array(
                        'limit' => 100,
                        'offset' => 0,
                        'field' => array(
                            array(
                                'name' => 'name',
                                'match' => array(
                                    array('value' => 'value'),
                                )
                            )
                        ),
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $queue->toArray());
    }

    public function testNamedElement()
    {
        $named = new \Zimbra\Soap\Struct\NamedElement('n');
        $this->assertSame('n', $named->name());

        $named->name('name');
        $this->assertSame('name', $named->name());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<named name="name" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $named);

        $array = array(
            'named' => array(
                'name' => 'name',
            ),
        );
        $this->assertEquals($array, $named->toArray());
    }

    public function testNamedValue()
    {
        $named = new \Zimbra\Soap\Struct\NamedValue('n');
        $this->assertSame('n', $named->name());

        $named->name('name')
              ->value('value');
        $this->assertSame('name', $named->name());
        $this->assertSame('value', $named->value());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<named name="name">value</named>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $named);

        $array = array(
            'named' => array(
                'name' => 'name',
                '_' => 'value',
            ),
        );
        $this->assertEquals($array, $named->toArray());
    }

    public function testNameId()
    {
        $nameId = new \Zimbra\Soap\Struct\NameId('n', 'i');
        $this->assertSame('n', $nameId->name());
        $this->assertSame('i', $nameId->id());

        $nameId->name('name')
               ->id('id');
        $this->assertSame('name', $nameId->name());
        $this->assertSame('id', $nameId->id());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<name name="name" id="id" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $nameId);

        $array = array(
            'name' => array(
                'name' => 'name',
                'id' => 'id',
            ),
        );
        $this->assertEquals($array, $nameId->toArray());
    }

    public function testNames()
    {
        $names = new \Zimbra\Soap\Struct\Names('n');
        $this->assertSame('n', $names->name());

        $names->name('name');
        $this->assertSame('name', $names->name());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<name name="name" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $names);

        $array = array(
            'name' => array(
                'name' => 'name',
            ),
        );
        $this->assertEquals($array, $names->toArray());
    }

    public function testOffset()
    {
        $offset = new \Zimbra\Soap\Struct\Offset(100);
        $this->assertSame(100, $offset->offset());

        $offset->offset(1);
        $this->assertSame(1, $offset->offset());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<offset offset="1" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $offset);

        $array = array(
            'offset' => array(
                'offset' => 1,
            ),
        );
        $this->assertEquals($array, $offset->toArray());
    }

    public function testOpValue()
    {
        $op = new \Zimbra\Soap\Struct\OpValue('-', 'v');
        $this->assertSame('-', $op->op());
        $this->assertSame('v', $op->value());

        $op->op('+')
           ->value('value');
        $this->assertSame('+', $op->op());
        $this->assertSame('value', $op->value());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<addr op="+">value</addr>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $op);

        $array = array(
            'addr' => array(
                'op' => '+',
                '_' => 'value',
            ),
        );
        $this->assertEquals($array, $op->toArray());
    }

    public function testPackageSelector()
    {
        $package = new \Zimbra\Soap\Struct\PackageSelector('n');
        $this->assertSame('n', $package->name());

        $package->name('name');
        $this->assertSame('name', $package->name());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<package name="name" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $package);

        $array = array(
            'package' => array(
                'name' => 'name',
            ),
        );
        $this->assertEquals($array, $package->toArray());
    }

    public function testPolicy()
    {
        $policy = new \Zimbra\Soap\Struct\Policy(Type::SYSTEM(), 'i', 'n', 'l');
        $this->assertSame('system', $policy->type()->value());
        $this->assertSame('i', $policy->id());
        $this->assertSame('n', $policy->name());
        $this->assertSame('l', $policy->lifetime());

        $policy->type(Type::USER())
               ->id('id')
               ->name('name')
               ->lifetime('lifetime');
        $this->assertSame('user', $policy->type()->value());
        $this->assertSame('id', $policy->id());
        $this->assertSame('name', $policy->name());
        $this->assertSame('lifetime', $policy->lifetime());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<policy type="user" id="id" name="name" lifetime="lifetime" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $policy);

        $array = array(
            'policy' => array(
                'type' => 'user',
                'id' => 'id',
                'name' => 'name',
                'lifetime' => 'lifetime',
            ),
        );
        $this->assertEquals($array, $policy->toArray());
    }

    public function testPreAuth()
    {
        $now = time();
        $pre = new \Zimbra\Soap\Struct\PreAuth($now, 'v', 1);
        $this->assertSame($now, $pre->timestamp());
        $this->assertSame('v', $pre->value());
        $this->assertSame(1, $pre->expiresTimestamp());

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
        $pref = new \Zimbra\Soap\Struct\Pref('n', 'v', 1);
        $this->assertSame('n', $pref->name());
        $this->assertSame('v', $pref->value());
        $this->assertSame(1, $pref->modified());

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

    public function testPrincipalSelector()
    {
        $pri = new \Zimbra\Soap\Struct\PrincipalSelector(PrincipalBy::DN(), 'principal');
        $this->assertSame('dn', $pri->by()->value());
        $this->assertSame('principal', $pri->value());

        $pri->by(PrincipalBy::NAME())
            ->value('value');
        $this->assertSame('name', $pri->by()->value());
        $this->assertSame('value', $pri->value());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<principal by="name">value</principal>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $pri);

        $array = array(
            'principal' => array(
                'by' => 'name',
                '_' => 'value',
            ),
        );
        $this->assertEquals($array, $pri->toArray());
    }

    public function testProp()
    {
        $prop = new \Zimbra\Soap\Struct\Prop('z', 'n', 'v');
        $this->assertSame('z', $prop->zimlet());
        $this->assertSame('n', $prop->name());
        $this->assertSame('v', $prop->value());

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

    public function testReindexMailboxInfo()
    {
        $mbox = new \Zimbra\Soap\Struct\ReindexMailboxInfo('i', 'contact, , appointment,xyz', 'ids');
        $this->assertSame('i', $mbox->id());
        $this->assertSame('contact,appointment', $mbox->types());
        $this->assertSame('ids', $mbox->ids());

        $mbox->id('id')
             ->types('task, , note,abc')
             ->ids('abc,xyz');
        $this->assertSame('id', $mbox->id());
        $this->assertSame('task,note', $mbox->types());
        $this->assertSame('abc,xyz', $mbox->ids());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<mbox id="id" types="task,note" ids="abc,xyz" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $mbox);

        $array = array(
            'mbox' => array(
                'id' => 'id',
                'types' => 'task,note',
                'ids' => 'abc,xyz',
            ),
        );
        $this->assertEquals($array, $mbox->toArray());
    }

    public function testRight()
    {
        $right = new \Zimbra\Soap\Struct\Right('r');
        $this->assertSame('r', $right->right());

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

    public function testRightModifierInfo()
    {
        $right = new \Zimbra\Soap\Struct\RightModifierInfo('v', false, true, true, false);
        $this->assertSame('v', $right->value());
        $this->assertFalse($right->deny());
        $this->assertTrue($right->canDelegate());
        $this->assertTrue($right->disinheritSubGroups());
        $this->assertFalse($right->subDomain());

        $right->value('value')
              ->deny(true)
              ->canDelegate(false)
              ->disinheritSubGroups(false)
              ->subDomain(true);
        $this->assertSame('value', $right->value());
        $this->assertTrue($right->deny());
        $this->assertFalse($right->canDelegate());
        $this->assertFalse($right->disinheritSubGroups());
        $this->assertTrue($right->subDomain());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<right deny="1" canDelegate="0" disinheritSubGroups="0" subDomain="1">value</right>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $right);

        $array = array(
            'right' => array(
                'deny' => 1,
                'canDelegate' => 0,
                'disinheritSubGroups' => 0,
                'subDomain' => 1,
                '_' => 'value',
            ),
        );
        $this->assertEquals($array, $right->toArray());
    }

    public function testServerMailQueueQuery()
    {
        $attr = new \Zimbra\Soap\Struct\ValueAttrib('value');
        $field = new \Zimbra\Soap\Struct\QueueQueryField('name', array($attr));
        $query = new \Zimbra\Soap\Struct\QueueQuery(array($field), 100, 0);
        $queue = new \Zimbra\Soap\Struct\MailQueueQuery($query, 'name', 0, 1);

        $server = new \Zimbra\Soap\Struct\ServerMailQueueQuery('n', $queue);
        $this->assertSame('n', $server->name());
        $this->assertSame($queue, $server->queue());

        $server->name('name')
               ->queue($queue);
        $this->assertSame('name', $server->name());
        $this->assertSame($queue, $server->queue());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<server name="name">'
                .'<queue name="name" scan="0" wait="1">'
                    .'<query limit="100" offset="0">'
                        .'<field name="name">'
                            .'<match value="value" />'
                        .'</field>'
                    .'</query>'
                .'</queue>'
            .'</server>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $server);

        $array = array(
            'server' => array(
                'name' => 'name',
                'queue' => array(
                    'name' => 'name',
                    'scan' => 0,
                    'wait' => 1,
                    'query' => array(
                        'limit' => 100,
                        'offset' => 0,
                        'field' => array(
                            array(
                                'name' => 'name',
                                'match' => array(
                                    array('value' => 'value'),
                                )
                            )
                        ),
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $server->toArray());
    }

    public function testServerSelector()
    {
        $server = new \Zimbra\Soap\Struct\ServerSelector(ServerBy::ID(), 'server');
        $this->assertSame('id', $server->by()->value());
        $this->assertSame('server', $server->value());

        $server->by(ServerBy::NAME())
               ->value('value');
        $this->assertSame('name', $server->by()->value());
        $this->assertSame('value', $server->value());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<server by="name">value</server>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $server);

        $array = array(
            'server' => array(
                'by' => 'name',
                '_' => 'value',
            ),
        );
        $this->assertEquals($array, $server->toArray());
    }

    public function testServerWithQueueAction()
    {
        $attr = new \Zimbra\Soap\Struct\ValueAttrib('value');
        $field = new \Zimbra\Soap\Struct\QueueQueryField('name', array($attr));
        $query = new \Zimbra\Soap\Struct\QueueQuery(array($field), 100, 0);

        $action = new \Zimbra\Soap\Struct\MailQueueAction($query, QueueAction::HOLD(), QueueActionBy::QUERY());
        $queue = new \Zimbra\Soap\Struct\MailQueueWithAction('name', $action);

        $server = new \Zimbra\Soap\Struct\ServerWithQueueAction('n', $queue);
        $this->assertSame('n', $server->name());
        $this->assertSame($queue, $server->queue());

        $server->name('name')
               ->queue($queue);
        $this->assertSame('name', $server->name());
        $this->assertSame($queue, $server->queue());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<server name="name">'
                .'<queue name="name">'
                    .'<action op="hold" by="query">'
                        .'<query limit="100" offset="0">'
                            .'<field name="name">'
                                .'<match value="value" />'
                            .'</field>'
                        .'</query>'
                    .'</action>'
                .'</queue>'
            .'</server>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $server);

        $array = array(
            'server' => array(
                'name' => 'name',
                'queue' => array(
                    'name' => 'name',
                    'action' => array(
                        'op' => 'hold',
                        'by' => 'query',
                        'query' => array(
                            'limit' => 100,
                            'offset' => 0,
                            'field' => array(
                                array(
                                    'name' => 'name',
                                    'match' => array(
                                        array('value' => 'value'),
                                    )
                                )
                            ),
                        ),
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $server->toArray());
    }

    public function testSignatureContent()
    {
        $content = new \Zimbra\Soap\Struct\SignatureContent('v', ContentType::TEXT_PLAIN());
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
        $content1 = new \Zimbra\Soap\Struct\SignatureContent('value1', ContentType::TEXT_PLAIN());
        $content2 = new \Zimbra\Soap\Struct\SignatureContent('value2', ContentType::TEXT_HTML());

        $sig = new \Zimbra\Soap\Struct\Signature('n', 'i', 'c', array($content1));
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

    public function testSimpleElement()
    {
        $el = new \Zimbra\Soap\Struct\SimpleElement;

        $xml = '<?xml version="1.0"?>'."\n"
            .'<element />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $el);

        $array = array(
            'element' => array(),
        );
        $this->assertEquals($array, $el->toArray());
    }

    public function testStat()
    {
        $stat = new \Zimbra\Soap\Struct\Stat('n', 'd');
        $this->assertSame('n', $stat->name());
        $this->assertSame('d', $stat->description());

        $stat->name('name')
             ->description('description');
        $this->assertSame('name', $stat->name());
        $this->assertSame('description', $stat->description());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<stat name="name" description="description" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $stat);

        $array = array(
            'stat' => array(
                'name' => 'name',
                'description' => 'description',
            ),
        );
        $this->assertEquals($array, $stat->toArray());
    }

    public function testStatsValueWrapper()
    {
        $stat1 = new \Zimbra\Soap\Struct\NamedElement('name1');
        $stat2 = new \Zimbra\Soap\Struct\NamedElement('name2');

        $wrapper = new \Zimbra\Soap\Struct\StatsValueWrapper(array($stat1));
        $this->assertSame(array($stat1), $wrapper->stat()->all());

        $wrapper->addStat($stat2);
        $this->assertSame(array($stat1, $stat2), $wrapper->stat()->all());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<values>'
                .'<stat name="name1" />'
                .'<stat name="name2" />'
            .'</values>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $wrapper);

        $array = array(
            'values' => array(
                'stat' => array(
                    array('name' => 'name1'),
                    array('name' => 'name2'),
                ),
            ),
        );
        $this->assertEquals($array, $wrapper->toArray());
    }

    public function testStatsSpec()
    {
        $stat = new \Zimbra\Soap\Struct\NamedElement('name');
        $values = new \Zimbra\Soap\Struct\StatsValueWrapper(array($stat));

        $stats = new \Zimbra\Soap\Struct\StatsSpec($values, 'n', 'l');
        $this->assertSame($values, $stats->values());
        $this->assertSame('n', $stats->name());
        $this->assertSame('l', $stats->limit());

        $stats->values($values)
              ->name('name')
              ->limit('limit');
        $this->assertSame($values, $stats->values());
        $this->assertSame('name', $stats->name());
        $this->assertSame('limit', $stats->limit());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<stats name="name" limit="limit">'
                .'<values>'
                    .'<stat name="name" />'
                .'</values>'
            .'</stats>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $stats);

        $array = array(
            'stats' => array(
                'name' => 'name',
                'limit' => 'limit',
                'values' => array(
                    'stat' => array(
                        array('name' => 'name'),
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $stats->toArray());
    }

    public function testSyncGalAccountDataSourceSpec()
    {
        $ds = new \Zimbra\Soap\Struct\SyncGalAccountDataSourceSpec(DataSourceBy::ID(), 'v', false, true);
        $this->assertSame('id', $ds->by()->value());
        $this->assertSame('v', $ds->value());
        $this->assertFalse($ds->fullSync());
        $this->assertTrue($ds->reset());

        $ds->by(DataSourceBy::NAME())
           ->value('value')
           ->fullSync(true)
           ->reset(false);
        $this->assertSame('name', $ds->by()->value());
        $this->assertSame('value', $ds->value());
        $this->assertTrue($ds->fullSync());
        $this->assertFalse($ds->reset());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<datasource by="name" fullSync="1" reset="0">value</datasource>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $ds);

        $array = array(
            'datasource' => array(
                'by' => 'name',
                'fullSync' => 1,
                'reset' => 0,
                '_' => 'value',
            ),
        );
        $this->assertEquals($array, $ds->toArray());
    }

    public function testSyncGalAccountSpec()
    {
        $ds1 = new \Zimbra\Soap\Struct\SyncGalAccountDataSourceSpec(DataSourceBy::ID(), 'value1', true, false);
        $ds2 = new \Zimbra\Soap\Struct\SyncGalAccountDataSourceSpec(DataSourceBy::NAME(), 'value2', false, true);

        $sync = new \Zimbra\Soap\Struct\SyncGalAccountSpec('i', array($ds1));
        $this->assertSame('i', $sync->id());
        $this->assertSame(array($ds1), $sync->dataSource()->all());

        $sync->id('id')
             ->addDataSource($ds2);
        $this->assertSame('id', $sync->id());
        $this->assertSame(array($ds1, $ds2), $sync->dataSource()->all());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<account id="id">'
                .'<datasource by="id" fullSync="1" reset="0">value1</datasource>'
                .'<datasource by="name" fullSync="0" reset="1">value2</datasource>'
            .'</account>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $sync);

        $array = array(
            'account' => array(
                'id' => 'id',
                'datasource' => array(
                    array(
                        'by' => 'id',
                        'fullSync' => 1,
                        'reset' => 0,
                        '_' => 'value1',
                    ),
                    array(
                        'by' => 'name',
                        'fullSync' => 0,
                        'reset' => 1,
                        '_' => 'value2',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $sync->toArray());
    }

    public function testTargetWithType()
    {
        $target = new \Zimbra\Soap\Struct\TargetWithType('t', 'v');
        $this->assertSame('t', $target->type());
        $this->assertSame('v', $target->value());

        $target->type('type')
               ->value('value');
        $this->assertSame('type', $target->type());
        $this->assertSame('value', $target->value());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<target type="type">value</target>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $target);

        $array = array(
            'target' => array(
                'type' => 'type',
                '_' => 'value',
            ),
        );
        $this->assertEquals($array, $target->toArray());
    }

    public function testTimeAttr()
    {
        $attr = new \Zimbra\Soap\Struct\TimeAttr('t');
        $this->assertSame('t', $attr->time());

        $attr->time('time');
        $this->assertSame('time', $attr->time());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<attr time="time" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $attr);

        $array = array(
            'attr' => array(
                'time' => 'time',
            ),
        );
        $this->assertEquals($array, $attr->toArray());
    }

    public function testTZFixupRuleMatchDate()
    {
        $date = new \Zimbra\Soap\Struct\TZFixupRuleMatchDate(100, 100);
        $this->assertSame(1, $date->mon());
        $this->assertSame(1, $date->mday());

        $date->mon(1)
             ->mday(1);
        $this->assertSame(1, $date->mon());
        $this->assertSame(1, $date->mday());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<date mon="1" mday="1" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $date);

        $array = array(
            'date' => array(
                'mon' => 1,
                'mday' => 1,
            ),
        );
        $this->assertEquals($array, $date->toArray());
    }

    public function testTZFixupRuleMatchDates()
    {
        $standard = new \Zimbra\Soap\Struct\TZFixupRuleMatchDate(1, 1);
        $daylight = new \Zimbra\Soap\Struct\TZFixupRuleMatchDate(2, 2);

        $dates = new \Zimbra\Soap\Struct\TZFixupRuleMatchDates(10, 10, $standard, $daylight);
        $this->assertSame(10, $dates->stdoff());
        $this->assertSame(10, $dates->dayoff());
        $this->assertSame($standard, $dates->standard());
        $this->assertSame($daylight, $dates->daylight());

        $dates->stdoff(1)
              ->dayoff(1)
              ->standard($standard)
              ->daylight($daylight);
        $this->assertSame(1, $dates->stdoff());
        $this->assertSame(1, $dates->dayoff());
        $this->assertSame($standard, $dates->standard());
        $this->assertSame($daylight, $dates->daylight());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<dates stdoff="1" dayoff="1">'
                .'<standard mon="1" mday="1" />'
                .'<daylight mon="2" mday="2" />'
            .'</dates>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $dates);

        $array = array(
            'dates' => array(
                'stdoff' => 1,
                'dayoff' => 1,
                'standard' => array(
                    'mon' => 1,
                    'mday' => 1,
                ),
                'daylight' => array(
                    'mon' => 2,
                    'mday' => 2,
                ),
            ),
        );
        $this->assertEquals($array, $dates->toArray());
    }

    public function testTZFixupRuleMatchRule()
    {
        $rule = new \Zimbra\Soap\Struct\TZFixupRuleMatchRule(100, 100, 100);
        $this->assertSame(1, $rule->mon());
        $this->assertSame(-1, $rule->week());
        $this->assertSame(1, $rule->wkday());

        $rule->mon(1)
             ->week(1)
             ->wkday(10);
        $this->assertSame(1, $rule->mon());
        $this->assertSame(1, $rule->week());
        $this->assertSame(1, $rule->wkday());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<rule mon="1" week="1" wkday="1" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $rule);

        $array = array(
            'rule' => array(
                'mon' => 1,
                'week' => 1,
                'wkday' => 1,
            ),
        );
        $this->assertEquals($array, $rule->toArray());
    }

    public function testTZFixupRuleMatchRules()
    {
        $standard = new \Zimbra\Soap\Struct\TZFixupRuleMatchRule(1, 2, 3);
        $daylight = new \Zimbra\Soap\Struct\TZFixupRuleMatchRule(3, 2, 1);

        $rules = new \Zimbra\Soap\Struct\TZFixupRuleMatchRules(10, 10, $standard, $daylight);
        $this->assertSame(10, $rules->stdoff());
        $this->assertSame(10, $rules->dayoff());
        $this->assertSame($standard, $rules->standard());
        $this->assertSame($daylight, $rules->daylight());

        $rules->stdoff(1)
              ->dayoff(1)
              ->standard($standard)
              ->daylight($daylight);
        $this->assertSame(1, $rules->stdoff());
        $this->assertSame(1, $rules->dayoff());
        $this->assertSame($standard, $rules->standard());
        $this->assertSame($daylight, $rules->daylight());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<rules stdoff="1" dayoff="1">'
                .'<standard mon="1" week="2" wkday="3" />'
                .'<daylight mon="3" week="2" wkday="1" />'
            .'</rules>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $rules);

        $array = array(
            'rules' => array(
                'stdoff' => 1,
                'dayoff' => 1,
                'standard' => array(
                    'mon' => 1,
                    'week' => 2,
                    'wkday' => 3,
                ),
                'daylight' => array(
                    'mon' => 3,
                    'week' => 2,
                    'wkday' => 1,
                ),
            ),
        );
        $this->assertEquals($array, $rules->toArray());
    }

    public function testTZFixupRuleMatch()
    {
        $any = new \Zimbra\Soap\Struct\SimpleElement;
        $tzid = new \Zimbra\Soap\Struct\Id('id');
        $nonDst = new \Zimbra\Soap\Struct\Offset(100);

        $standard = new \Zimbra\Soap\Struct\TZFixupRuleMatchRule(1, 2, 3);
        $daylight = new \Zimbra\Soap\Struct\TZFixupRuleMatchRule(3, 2, 1);
        $rules = new \Zimbra\Soap\Struct\TZFixupRuleMatchRules(1, 1, $standard, $daylight);

        $standard = new \Zimbra\Soap\Struct\TZFixupRuleMatchDate(1, 1);
        $daylight = new \Zimbra\Soap\Struct\TZFixupRuleMatchDate(2, 2);
        $dates = new \Zimbra\Soap\Struct\TZFixupRuleMatchDates(1, 1, $standard, $daylight);

        $match = new \Zimbra\Soap\Struct\TZFixupRuleMatch($any, $tzid, $nonDst, $rules, $dates);
        $this->assertSame($any, $match->any());
        $this->assertSame($tzid, $match->tzid());
        $this->assertSame($nonDst, $match->nonDst());
        $this->assertSame($rules, $match->rules());
        $this->assertSame($dates, $match->dates());

        $match->any($any)
              ->tzid($tzid)
              ->nonDst($nonDst)
              ->rules($rules)
              ->dates($dates);
        $this->assertSame($any, $match->any());
        $this->assertSame($tzid, $match->tzid());
        $this->assertSame($nonDst, $match->nonDst());
        $this->assertSame($rules, $match->rules());
        $this->assertSame($dates, $match->dates());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<match>'
                .'<any />'
                .'<tzid id="id" />'
                .'<nonDst offset="100" />'
                .'<rules stdoff="1" dayoff="1">'
                    .'<standard mon="1" week="2" wkday="3" />'
                    .'<daylight mon="3" week="2" wkday="1" />'
                .'</rules>'
                .'<dates stdoff="1" dayoff="1">'
                    .'<standard mon="1" mday="1" />'
                    .'<daylight mon="2" mday="2" />'
                .'</dates>'
            .'</match>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $match);

        $array = array(
            'match' => array(
                'any' => array(),
                'tzid' => array('id' => 'id'),
                'nonDst' => array('offset' => 100),
                'rules' => array(
                    'stdoff' => 1,
                    'dayoff' => 1,
                    'standard' => array(
                        'mon' => 1,
                        'week' => 2,
                        'wkday' => 3,
                    ),
                    'daylight' => array(
                        'mon' => 3,
                        'week' => 2,
                        'wkday' => 1,
                    ),
                ),
                'dates' => array(
                    'stdoff' => 1,
                    'dayoff' => 1,
                    'standard' => array(
                        'mon' => 1,
                        'mday' => 1,
                    ),
                    'daylight' => array(
                        'mon' => 2,
                        'mday' => 2,
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $match->toArray());
    }

    public function testTZReplaceInfo()
    {
        $wellKnownTz = new \Zimbra\Soap\Struct\Id('id');

        $standard = new \Zimbra\Soap\Struct\TzOnsetInfo(1, 2, 3, 4);
        $daylight = new \Zimbra\Soap\Struct\TzOnsetInfo(4, 3, 2, 1);
        $tz = new \Zimbra\Soap\Struct\CalTZInfo('id', 1, 1, 'stdname', 'dayname', $standard, $daylight);

        $replace = new \Zimbra\Soap\Struct\TZReplaceInfo($wellKnownTz, $tz);
        $this->assertSame($wellKnownTz, $replace->wellKnownTz());
        $this->assertSame($tz, $replace->tz());

        $replace->wellKnownTz($wellKnownTz)
                ->tz($tz);
        $this->assertSame($wellKnownTz, $replace->wellKnownTz());
        $this->assertSame($tz, $replace->tz());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<replace>'
                .'<wellKnownTz id="id" />'
                .'<tz id="id" stdoff="1" dayoff="1" stdname="stdname" dayname="dayname">'
                    .'<standard mon="1" hour="2" min="3" sec="4" />'
                    .'<daylight mon="4" hour="3" min="2" sec="1" />'
                .'</tz>'
            .'</replace>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $replace);

        $array = array(
            'replace' => array(
                'wellKnownTz' => array('id' => 'id'),
                'tz' => array(
                    'id' => 'id',
                    'stdoff' => 1,
                    'dayoff' => 1,
                    'stdname' => 'stdname',
                    'dayname' => 'dayname',
                    'standard' => array(
                        'mon' => 1,
                        'hour' => 2,
                        'min' => 3,
                        'sec' => 4,
                    ),
                    'daylight' => array(
                        'mon' => 4,
                        'hour' => 3,
                        'min' => 2,
                        'sec' => 1,
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $replace->toArray());
    }

    public function testTZFixupRule()
    {
        $any = new \Zimbra\Soap\Struct\SimpleElement;
        $tzid = new \Zimbra\Soap\Struct\Id('id');
        $nonDst = new \Zimbra\Soap\Struct\Offset(100);
        $standard = new \Zimbra\Soap\Struct\TZFixupRuleMatchRule(1, 2, 3);
        $daylight = new \Zimbra\Soap\Struct\TZFixupRuleMatchRule(3, 2, 1);
        $rules = new \Zimbra\Soap\Struct\TZFixupRuleMatchRules(1, 1, $standard, $daylight);
        $standard = new \Zimbra\Soap\Struct\TZFixupRuleMatchDate(1, 1);
        $daylight = new \Zimbra\Soap\Struct\TZFixupRuleMatchDate(2, 2);
        $dates = new \Zimbra\Soap\Struct\TZFixupRuleMatchDates(1, 1, $standard, $daylight);
        $match = new \Zimbra\Soap\Struct\TZFixupRuleMatch($any, $tzid, $nonDst, $rules, $dates);

        $wellKnownTz = new \Zimbra\Soap\Struct\Id('id');
        $standard = new \Zimbra\Soap\Struct\TzOnsetInfo(1, 2, 3, 4);
        $daylight = new \Zimbra\Soap\Struct\TzOnsetInfo(4, 3, 2, 1);
        $tz = new \Zimbra\Soap\Struct\CalTZInfo('id', 1, 1, 'stdname', 'dayname', $standard, $daylight);
        $replace = new \Zimbra\Soap\Struct\TZReplaceInfo($wellKnownTz, $tz);
        
        $touch = new \Zimbra\Soap\Struct\SimpleElement;
        $fixup = new \Zimbra\Soap\Struct\TZFixupRule($match, $touch, $replace);
        $this->assertSame($match, $fixup->match());
        $this->assertSame($touch, $fixup->touch());
        $this->assertSame($replace, $fixup->replace());

        $fixup->match($match)
              ->touch($touch)
              ->replace($replace);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<fixupRule>'
                .'<match>'
                    .'<any />'
                    .'<tzid id="id" />'
                    .'<nonDst offset="100" />'
                    .'<rules stdoff="1" dayoff="1">'
                        .'<standard mon="1" week="2" wkday="3" />'
                        .'<daylight mon="3" week="2" wkday="1" />'
                    .'</rules>'
                    .'<dates stdoff="1" dayoff="1">'
                        .'<standard mon="1" mday="1" />'
                        .'<daylight mon="2" mday="2" />'
                    .'</dates>'
                .'</match>'
                .'<touch />'
                .'<replace>'
                    .'<wellKnownTz id="id" />'
                    .'<tz id="id" stdoff="1" dayoff="1" stdname="stdname" dayname="dayname">'
                        .'<standard mon="1" hour="2" min="3" sec="4" />'
                        .'<daylight mon="4" hour="3" min="2" sec="1" />'
                    .'</tz>'
                .'</replace>'
            .'</fixupRule>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $fixup);


        $array = array(
            'fixupRule' => array(
                'match' => array(
                    'any' => array(),
                    'tzid' => array('id' => 'id'),
                    'nonDst' => array('offset' => 100),
                    'rules' => array(
                        'stdoff' => 1,
                        'dayoff' => 1,
                        'standard' => array(
                            'mon' => 1,
                            'week' => 2,
                            'wkday' => 3,
                        ),
                        'daylight' => array(
                            'mon' => 3,
                            'week' => 2,
                            'wkday' => 1,
                        ),
                    ),
                    'dates' => array(
                        'stdoff' => 1,
                        'dayoff' => 1,
                        'standard' => array(
                            'mon' => 1,
                            'mday' => 1,
                        ),
                        'daylight' => array(
                            'mon' => 2,
                            'mday' => 2,
                        ),
                    ),
                ),
                'touch' => array(),
                'replace' => array(
                    'wellKnownTz' => array('id' => 'id'),
                    'tz' => array(
                        'id' => 'id',
                        'stdoff' => 1,
                        'dayoff' => 1,
                        'stdname' => 'stdname',
                        'dayname' => 'dayname',
                        'standard' => array(
                            'mon' => 1,
                            'hour' => 2,
                            'min' => 3,
                            'sec' => 4,
                        ),
                        'daylight' => array(
                            'mon' => 4,
                            'hour' => 3,
                            'min' => 2,
                            'sec' => 1,
                        ),
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $fixup->toArray());
    }

    public function testUcServiceSelector()
    {
        $ucs = new \Zimbra\Soap\Struct\UcServiceSelector(UcServiceBy::ID(), 'uc');
        $this->assertSame('id', $ucs->by()->value());
        $this->assertSame('uc', $ucs->value());

        $ucs->by(UcServiceBy::NAME())
            ->value('value');
        $this->assertSame('name', $ucs->by()->value());
        $this->assertSame('value', $ucs->value());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ucservice by="name">value</ucservice>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $ucs);

        $array = array(
            'ucservice' => array(
                'by' => 'name',
                '_' => 'value',
            ),
        );
        $this->assertEquals($array, $ucs->toArray());
    }

    public function testVolumeInfo()
    {
        $volume = new \Zimbra\Soap\Struct\VolumeInfo(1, 2, 3, 4, 5, 6, 7, 'n', 'r', false, true);
        $this->assertSame(1, $volume->id());
        $this->assertSame(2, $volume->type());
        $this->assertSame(3, $volume->compressionThreshold());
        $this->assertSame(4, $volume->mgbits());
        $this->assertSame(5, $volume->mbits());
        $this->assertSame(6, $volume->fgbits());
        $this->assertSame(7, $volume->fbits());
        $this->assertSame('n', $volume->name());
        $this->assertSame('r', $volume->rootpath());
        $this->assertFalse($volume->compressBlobs());
        $this->assertTrue($volume->isCurrent());

        $volume->id(7)
               ->type(6)
               ->compressionThreshold(5)
               ->mgbits(4)
               ->mbits(3)
               ->fgbits(2)
               ->fbits(1)
               ->name('name')
               ->rootpath('rootpath')
               ->compressBlobs(true)
               ->isCurrent(false);
        $this->assertSame(7, $volume->id());
        $this->assertSame(1, $volume->type());
        $this->assertSame(5, $volume->compressionThreshold());
        $this->assertSame(4, $volume->mgbits());
        $this->assertSame(3, $volume->mbits());
        $this->assertSame(2, $volume->fgbits());
        $this->assertSame(1, $volume->fbits());
        $this->assertSame('name', $volume->name());
        $this->assertSame('rootpath', $volume->rootpath());
        $this->assertTrue($volume->compressBlobs());
        $this->assertFalse($volume->isCurrent());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<volume '
                .'id="7" '
                .'type="1" '
                .'compressionThreshold="5" '
                .'mgbits="4" '
                .'mbits="3" '
                .'fgbits="2" '
                .'fbits="1" '
                .'name="name" '
                .'rootpath="rootpath" '
                .'compressBlobs="1" '
                .'isCurrent="0" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $volume);

        $array = array(
            'volume' => array(
                'id' => 7,
                'type' => 1,
                'compressionThreshold' => 5,
                'mgbits' => 4,
                'mbits' => 3,
                'fgbits' => 2,
                'fbits' => 1,
                'name' => 'name',
                'rootpath' => 'rootpath',
                'compressBlobs' => 1,
                'isCurrent' => 0,
            ),
        );
        $this->assertEquals($array, $volume->toArray());
    }

    public function testWaitSetAddSpec()
    {
        $waitSet = new \Zimbra\Soap\Struct\WaitSetAddSpec('n', 'i', 't', array(InterestType::FOLDERS()));
        $this->assertSame('n', $waitSet->name());
        $this->assertSame('i', $waitSet->id());
        $this->assertSame('t', $waitSet->token());
        $this->assertSame('f', $waitSet->types());

        $waitSet->name('name')
                ->id('id')
                ->token('token')
                ->addType(InterestType::MESSAGES())
                ->addType(InterestType::CONTACTS());
        $this->assertSame('name', $waitSet->name());
        $this->assertSame('id', $waitSet->id());
        $this->assertSame('token', $waitSet->token());
        $this->assertSame('f,m,c', $waitSet->types());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<a name="name" id="id" token="token" types="f,m,c" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $waitSet);

        $array = array(
            'a' => array(
                'name' => 'name',
                'id' => 'id',
                'token' => 'token',
                'types' => 'f,m,c',
            ),
        );
        $this->assertEquals($array, $waitSet->toArray());
    }

    public function testXmppComponentSelector()
    {
        $xmpp = new \Zimbra\Soap\Struct\XmppComponentSelector(XmppBy::ID(), 'xmpp');
        $this->assertSame('id', $xmpp->by()->value());
        $this->assertSame('xmpp', $xmpp->value());

        $xmpp->by(XmppBy::NAME())
             ->value('value');
        $this->assertSame('name', $xmpp->by()->value());
        $this->assertSame('value', $xmpp->value());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<xmppcomponent by="name">value</xmppcomponent>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $xmpp);

        $array = array(
            'xmppcomponent' => array(
                'by' => 'name',
                '_' => 'value',
            ),
        );
        $this->assertEquals($array, $xmpp->toArray());
    }

    public function testXmppComponentSpec()
    {
        $attr = new \Zimbra\Soap\Struct\KeyValuePair('key', 'value');
        $domain = new \Zimbra\Soap\Struct\DomainSelector(DomainBy::NAME(), 'domain');
        $server = new \Zimbra\Soap\Struct\ServerSelector(ServerBy::NAME(), 'server');

        $xmpp = new \Zimbra\Soap\Struct\XmppComponentSpec('n', $domain, $server);
        $this->assertSame('n', $xmpp->name());
        $this->assertSame($domain, $xmpp->domain());
        $this->assertSame($server, $xmpp->server());

        $xmpp->name('name')
             ->domain($domain)
             ->server($server)
             ->addAttr($attr);
        $this->assertSame('name', $xmpp->name());
        $this->assertSame($domain, $xmpp->domain());
        $this->assertSame($server, $xmpp->server());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<xmppcomponent name="name">'
                .'<domain by="name">domain</domain>'
                .'<server by="name">server</server>'
                .'<a n="key">value</a>'
            .'</xmppcomponent>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $xmpp);

        $array = array(
            'xmppcomponent' => array(
                'name' => 'name',
                'domain' => array(
                    'by' => 'name',
                    '_' => 'domain',
                ),
                'server' => array(
                    'by' => 'name',
                    '_' => 'server',
                ),
                'a' => array(
                    array(
                        'n' => 'key',
                        '_' => 'value',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $xmpp->toArray());
    }

    public function testZimletAcl()
    {
        $acl = new \Zimbra\Soap\Struct\ZimletAcl('c', AclType::DENY());
        $this->assertSame('c', $acl->cos());
        $this->assertSame('deny', $acl->acl()->value());

        $acl->cos('cos')
            ->acl(AclType::GRANT());
        $this->assertSame('cos', $acl->cos());
        $this->assertSame('grant', $acl->acl()->value());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<acl cos="cos" acl="grant" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $acl);

        $array = array(
            'acl' => array(
                'cos' => 'cos',
                'acl' => 'grant',
            ),
        );
        $this->assertEquals($array, $acl->toArray());
    }

    public function testZimletAclStatusPri()
    {
        $acl = new \Zimbra\Soap\Struct\ZimletAcl('cos', AclType::DENY());
        $status = new \Zimbra\Soap\Struct\ValueAttrib('disabled');
        $priority = new \Zimbra\Soap\Struct\IntegerValueAttrib(1);

        $zimlet = new \Zimbra\Soap\Struct\ZimletAclStatusPri('n', $acl, $status, $priority);
        $this->assertSame('n', $zimlet->name());
        $this->assertSame($acl, $zimlet->acl());
        $this->assertSame($status, $zimlet->status());
        $this->assertSame($priority, $zimlet->priority());

        $zimlet->name('name')
               ->acl($acl)
               ->status($status)
               ->priority($priority);
        $this->assertSame('name', $zimlet->name());
        $this->assertSame($acl, $zimlet->acl());
        $this->assertSame($status, $zimlet->status());
        $this->assertSame($priority, $zimlet->priority());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<zimlet name="name">'
                .'<acl cos="cos" acl="deny" />'
                .'<status value="disabled" />'
                .'<priority value="1" />'
            .'</zimlet>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $zimlet);

        $array = array(
            'zimlet' => array(
                'name' => 'name',
                'acl' => array(
                    'cos' => 'cos',
                    'acl' => 'deny',
                ),
                'status' => array(
                    'value' => 'disabled',
                ),
                'priority' => array(
                    'value' => 1,
                ),
            ),
        );
        $this->assertEquals($array, $zimlet->toArray());
    }

    public function testZimletPrefsSpec()
    {
        $zimlet = new \Zimbra\Soap\Struct\ZimletPrefsSpec('n', ZimletStatus::ENABLED());
        $this->assertSame('n', $zimlet->name());
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

    public function testHeader()
    {
        $header = new \Zimbra\Soap\Struct\Header('name', 'value');
        $this->assertSame('name', $header->name());
        $this->assertSame('value', $header->value());

        $header->name('name')
               ->value('value');
        $this->assertSame('name', $header->name());
        $this->assertSame('value', $header->value());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<header name="name">value</header>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $header);

        $array = array(
            'header' => array(
                'name' => 'name',
                '_' => 'value',
            ),
        );
        $this->assertEquals($array, $header->toArray());
    }


    public function testAttachSpec()
    {
        $stub = $this->getMockForAbstractClass('\Zimbra\Soap\Struct\AttachSpec');
        $stub->optional(true);
        $this->assertTrue($stub->optional());
    }

    public function testContactAttachSpec()
    {
        $cn = new \Zimbra\Soap\Struct\ContactAttachSpec('i');
        $this->assertSame('i', $cn->id());

        $cn->id('id')
           ->optional(true);
        $this->assertSame('id', $cn->id());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<cn id="id" optional="1" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $cn);

        $array = array(
            'cn' => array(
                'id' => 'id',
                'optional' => 1,
            ),
        );
        $this->assertEquals($array, $cn->toArray());
    }

    public function testMsgAttachSpec()
    {
        $m = new \Zimbra\Soap\Struct\MsgAttachSpec('i');
        $this->assertSame('i', $m->id());

        $m->id('id')
          ->optional(true);
        $this->assertSame('id', $m->id());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<m id="id" optional="1" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $m);

        $array = array(
            'm' => array(
                'id' => 'id',
                'optional' => 1,
            ),
        );
        $this->assertEquals($array, $m->toArray());
    }

    public function testMimePartAttachSpec()
    {
        $mp = new \Zimbra\Soap\Struct\MimePartAttachSpec('id', 'p');
        $this->assertSame('id', $mp->mid());
        $this->assertSame('p', $mp->part());

        $mp->mid('mid')
           ->part('part')
           ->optional(true);
        $this->assertSame('mid', $mp->mid());
        $this->assertSame('part', $mp->part());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<mp mid="mid" part="part" optional="1" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $mp);

        $array = array(
            'mp' => array(
                'mid' => 'mid',
                'part' => 'part',
                'optional' => 1,
            ),
        );
        $this->assertEquals($array, $mp->toArray());
    }

    public function testDocAttachSpec()
    {
        $doc = new \Zimbra\Soap\Struct\DocAttachSpec('p', 'i', 10);
        $this->assertSame('p', $doc->path());
        $this->assertSame('i', $doc->id());
        $this->assertSame(10, $doc->ver());

        $doc->path('path')
            ->id('id')
            ->ver(1)
            ->optional(true);
        $this->assertSame('path', $doc->path());
        $this->assertSame('id', $doc->id());
        $this->assertSame(1, $doc->ver());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<doc path="path" id="id" ver="1" optional="1" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $doc);

        $array = array(
            'doc' => array(
                'path' => 'path',
                'id' => 'id',
                'ver' => 1,
                'optional' => 1,
            ),
        );
        $this->assertEquals($array, $doc->toArray());
    }

    public function testAttachmentsInfo()
    {
        $mp = new \Zimbra\Soap\Struct\MimePartAttachSpec('mid', 'part', true);
        $m = new \Zimbra\Soap\Struct\MsgAttachSpec('id', false);
        $cn = new \Zimbra\Soap\Struct\ContactAttachSpec('id', false);
        $doc = new \Zimbra\Soap\Struct\DocAttachSpec('path', 'id', 1, true);

        $attach = new \Zimbra\Soap\Struct\AttachmentsInfo;
        $attach->mp($mp)
            ->m($m)
            ->cn($cn)
            ->doc($doc)
            ->aid('aid');
        $this->assertSame($mp, $attach->mp());
        $this->assertSame($m, $attach->m());
        $this->assertSame($cn, $attach->cn());
        $this->assertSame($doc, $attach->doc());
        $this->assertSame('aid', $attach->aid());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<attach aid="aid">'
                .'<mp mid="mid" part="part" optional="1" />'
                .'<m id="id" optional="0" />'
                .'<cn id="id" optional="0" />'
                .'<doc path="path" id="id" ver="1" optional="1" />'
            .'</attach>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $attach);

        $array = array(
            'attach' => array(
                'aid' => 'aid',
                'mp' => array(
                    'mid' => 'mid',
                    'part' => 'part',
                    'optional' => 1,
                ),
                'm' => array(
                    'id' => 'id',
                    'optional' => 0,
                ),
                'cn' => array(
                    'id' => 'id',
                    'optional' => 0,
                ),
                'doc' => array(
                    'path' => 'path',
                    'id' => 'id',
                    'ver' => 1,
                    'optional' => 1,
                ),
            ),
        );
        $this->assertEquals($array, $attach->toArray());
    }

    public function testMimePartInfo()
    {
        $mp = new \Zimbra\Soap\Struct\MimePartAttachSpec('mid', 'part', true);
        $m = new \Zimbra\Soap\Struct\MsgAttachSpec('id', false);
        $cn = new \Zimbra\Soap\Struct\ContactAttachSpec('id', false);
        $doc = new \Zimbra\Soap\Struct\DocAttachSpec('path', 'id', 1, true);
        $attach = new \Zimbra\Soap\Struct\AttachmentsInfo($mp, $m, $cn, $doc, 'aid');

        $info = new \Zimbra\Soap\Struct\MimePartInfo(array(), null, 'ct', 'content', 'ci');

        $mpi = new \Zimbra\Soap\Struct\MimePartInfo(array($info), $attach, 'ct', 'content', 'ci');
        $this->assertSame(array($info), $mpi->mp()->all());
        $this->assertSame($attach, $mpi->attach());
        $this->assertSame('ct', $mpi->ct());
        $this->assertSame('content', $mpi->content());
        $this->assertSame('ci', $mpi->ci());

        $mpi->addMp($info)
            ->attach($attach)
            ->ct('ct')
            ->content('content')
            ->ci('ci');
        $this->assertSame(array($info, $info), $mpi->mp()->all());
        $this->assertSame($attach, $mpi->attach());
        $this->assertSame('ct', $mpi->ct());
        $this->assertSame('content', $mpi->content());
        $this->assertSame('ci', $mpi->ci());

        $mpi = new \Zimbra\Soap\Struct\MimePartInfo(array($info), $attach, 'ct', 'content', 'ci');
        $xml = '<?xml version="1.0"?>'."\n"
            .'<mp ct="ct" content="content" ci="ci">'
                .'<mp ct="ct" content="content" ci="ci" />'
                .'<attach aid="aid">'
                    .'<mp mid="mid" part="part" optional="1" />'
                    .'<m id="id" optional="0" />'
                    .'<cn id="id" optional="0" />'
                    .'<doc path="path" id="id" ver="1" optional="1" />'
                .'</attach>'
            .'</mp>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $mpi);

        $array = array(
            'mp' => array(
                'ct' => 'ct',
                'content' => 'content',
                'ci' => 'ci',
                'mp' => array(
                    array(
                        'ct' => 'ct',
                        'content' => 'content',
                        'ci' => 'ci',
                    ),
                ),
                'attach' => array(
                    'aid' => 'aid',
                    'mp' => array(
                        'mid' => 'mid',
                        'part' => 'part',
                        'optional' => 1,
                    ),
                    'm' => array(
                        'id' => 'id',
                        'optional' => 0,
                    ),
                    'cn' => array(
                        'id' => 'id',
                        'optional' => 0,
                    ),
                    'doc' => array(
                        'path' => 'path',
                        'id' => 'id',
                        'ver' => 1,
                        'optional' => 1,
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $mpi->toArray());
    }

    public function testRawInvite()
    {
        $content = new \Zimbra\Soap\Struct\RawInvite('uid', 'value', 'summary');
        $this->assertSame('uid', $content->uid());
        $this->assertSame('value', $content->value());
        $this->assertSame('summary', $content->summary());

        $content->uid('uid')
                ->summary('summary')
                ->value('value');
        $this->assertSame('uid', $content->uid());
        $this->assertSame('summary', $content->summary());
        $this->assertSame('value', $content->value());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<content uid="uid" summary="summary">value</content>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $content);

        $array = array(
            'content' => array(
                '_' => 'value',
                'uid' => 'uid',
                'summary' => 'summary',
            ),
        );
        $this->assertEquals($array, $content->toArray());
    }

    public function testGeoInfo()
    {
        $geo = new \Zimbra\Soap\Struct\GeoInfo(123.456, 654.321);
        $this->assertSame(123.456, $geo->lat());
        $this->assertSame(654.321, $geo->lon());

        $geo->lat(654.321)
            ->lon(123.456);
        $this->assertSame(654.321, $geo->lat());
        $this->assertSame(123.456, $geo->lon());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<geo lat="654.321" lon="123.456" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $geo);

        $array = array(
            'geo' => array(
                'lat' => 654.321,
                'lon' => 123.456,
            ),
        );
        $this->assertEquals($array, $geo->toArray());
    }

    public function testDateAttr()
    {
        $abs = new \Zimbra\Soap\Struct\DateAttr('20120315T18302305Z');
        $this->assertSame('20120315T18302305Z', $abs->d());
        $abs->d('20120315T18302305Z');
        $this->assertSame('20120315T18302305Z', $abs->d());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<abs d="20120315T18302305Z" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $abs);

        $array = array(
            'abs' => array(
                'd' => '20120315T18302305Z',
            ),
        );
        $this->assertEquals($array, $abs->toArray());
    }

    public function testDurationInfo()
    {
        $rel = new \Zimbra\Soap\Struct\DurationInfo(false, 1, 2, 3, 4, 5, 'END', 6);
        $this->assertFalse($rel->neg());
        $this->assertSame(1, $rel->w());
        $this->assertSame(2, $rel->d());
        $this->assertSame(3, $rel->h());
        $this->assertSame(4, $rel->m());
        $this->assertSame(5, $rel->s());
        $this->assertSame('END', $rel->related());
        $this->assertSame(6, $rel->count());

        $rel->neg(true)
            ->w(1)
            ->d(2)
            ->h(3)
            ->m(4)
            ->s(5)
            ->related('START')
            ->count(6);
        $this->assertTrue($rel->neg());
        $this->assertSame(1, $rel->w());
        $this->assertSame(2, $rel->d());
        $this->assertSame(3, $rel->h());
        $this->assertSame(4, $rel->m());
        $this->assertSame(5, $rel->s());
        $this->assertSame('START', $rel->related());
        $this->assertSame(6, $rel->count());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<rel neg="1" w="1" d="2" h="3" m="4" s="5" related="START" count="6" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $rel);

        $array = array(
            'rel' => array(
                'neg' => 1,
                'w' => 1,
                'd' => 2,
                'h' => 3,
                'm' => 4,
                's' => 5,
                'related' => 'START',
                'count' => 6,
            ),
        );
        $this->assertEquals($array, $rel->toArray());
    }

    public function testAlarmTriggerInfo()
    {
        $abs = new \Zimbra\Soap\Struct\DateAttr('20120315T18302305Z');
        $rel = new \Zimbra\Soap\Struct\DurationInfo(true, 1, 2, 3, 4, 5, 'START', 6);
        $trigger = new \Zimbra\Soap\Struct\AlarmTriggerInfo($abs, $rel);

        $this->assertSame($abs, $trigger->abs());
        $this->assertSame($rel, $trigger->rel());
        $trigger->abs($abs)
                ->rel($rel);
        $this->assertSame($abs, $trigger->abs());
        $this->assertSame($rel, $trigger->rel());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<trigger>'
                .'<abs d="20120315T18302305Z" />'
                .'<rel neg="1" w="1" d="2" h="3" m="4" s="5" related="START" count="6" />'
            .'</trigger>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $trigger);

        $array = array(
            'trigger' => array(
                'abs' => array(
                    'd' => '20120315T18302305Z',
                ),
                'rel' => array(
                    'neg' => 1,
                    'w' => 1,
                    'd' => 2,
                    'h' => 3,
                    'm' => 4,
                    's' => 5,
                    'related' => 'START',
                    'count' => 6,
                ),
            ),
        );
        $this->assertEquals($array, $trigger->toArray());
    }

    public function testCalendarAttach()
    {
        $ca = new \Zimbra\Soap\Struct\CalendarAttach('uri', 'ct', 'value');
        $this->assertSame('uri', $ca->uri());
        $this->assertSame('ct', $ca->ct());
        $this->assertSame('value', $ca->value());

        $ca->uri('uri')
           ->ct('ct')
           ->value('value');
        $this->assertSame('uri', $ca->uri());
        $this->assertSame('ct', $ca->ct());
        $this->assertSame('value', $ca->value());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<attach uri="uri" ct="ct">value</attach>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $ca);

        $array = array(
            'attach' => array(
                'uri' => 'uri',
                'ct' => 'ct',
                '_' => 'value',
            ),
        );
        $this->assertEquals($array, $ca->toArray());
    }

    public function testXProp()
    {
        $xparam1 = new \Zimbra\Soap\Struct\XParam('name1', 'value1');
        $xparam2 = new \Zimbra\Soap\Struct\XParam('name2', 'value2');
        $xprop = new \Zimbra\Soap\Struct\XProp('name', 'value', array($xparam1));

        $this->assertSame(array($xparam1), $xprop->xparam()->all());
        $this->assertSame('name', $xprop->name());
        $this->assertSame('value', $xprop->value());

        $xprop->addXParam($xparam2);
        $this->assertSame(array($xparam1, $xparam2), $xprop->xparam()->all());
        $xprop->name('name')
              ->value('value');
        $this->assertSame('name', $xprop->name());
        $this->assertSame('value', $xprop->value());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<xprop name="name" value="value">'
                .'<xparam name="name1" value="value1" />'
                .'<xparam name="name2" value="value2" />'
            .'</xprop>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $xprop);

        $array = array(
            'xprop' => array(
                'name' => 'name',
                'value' => 'value',
                'xparam' => array(
                    array(
                        'name' => 'name1',
                        'value' => 'value1',
                    ),
                    array(
                        'name' => 'name2',
                        'value' => 'value2',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $xprop->toArray());
    }

    function testAlarmInfo()
    {
        $abs = new \Zimbra\Soap\Struct\DateAttr('20120315T18302305Z');
        $rel = new \Zimbra\Soap\Struct\DurationInfo(true, 1, 2, 3, 4, 5, 'START', 6);
        $trigger = new \Zimbra\Soap\Struct\AlarmTriggerInfo($abs, $rel);

        $repeat = new \Zimbra\Soap\Struct\DurationInfo(false, 1, 2, 3, 4, 5, 'END', 6);
        $attach = new \Zimbra\Soap\Struct\CalendarAttach('uri', 'ct', 'value');

        $xparam1 = new \Zimbra\Soap\Struct\XParam('name1', 'value1');
        $at = new \Zimbra\Soap\Struct\CalendarAttendee(array($xparam1)
            , 'a', 'url', 'd', 'sentBy', 'dir', 'lang', 'cutype', 'role', PartStatus::NE(), true, 'member', 'delTo', 'delFrom'
        );
        $xparam2 = new \Zimbra\Soap\Struct\XParam('name2', 'value2');
        $xprop = new \Zimbra\Soap\Struct\XProp('name', 'value', array($xparam2));

        $alarm = new \Zimbra\Soap\Struct\AlarmInfo(
            AlarmAction::DISPLAY(), $trigger, $repeat, 'desc', $attach, 'summary', array($at), array($xprop)
        );

        $this->assertSame('DISPLAY', (string) $alarm->action());
        $this->assertSame($trigger, $alarm->trigger());
        $this->assertSame($repeat, $alarm->repeat());
        $this->assertSame('desc', $alarm->desc());
        $this->assertSame($attach, $alarm->attach());
        $this->assertSame('summary', $alarm->summary());
        $this->assertSame(array($at), $alarm->at()->all());
        $this->assertSame(array($xprop), $alarm->xprop()->all());

        $alarm->at()->add($at);
        $alarm->xprop()->add($xprop);
        $this->assertSame(array($at, $at), $alarm->at()->all());
        $this->assertSame(array($xprop, $xprop), $alarm->xprop()->all());
        $alarm->action(AlarmAction::DISPLAY())
              ->trigger($trigger)
              ->repeat($repeat)
              ->desc('desc')
              ->attach($attach)
              ->summary('summary');
        $this->assertSame('DISPLAY', (string) $alarm->action());
        $this->assertSame($trigger, $alarm->trigger());
        $this->assertSame($repeat, $alarm->repeat());
        $this->assertSame('desc', $alarm->desc());
        $this->assertSame($attach, $alarm->attach());
        $this->assertSame('summary', $alarm->summary());
        unset($alarm);

        $alarm = new \Zimbra\Soap\Struct\AlarmInfo(
            AlarmAction::DISPLAY(), $trigger, $repeat, 'desc', $attach, 'summary', array($at), array($xprop)
        );

        $xml = '<?xml version="1.0"?>'."\n"
            .'<alarm action="DISPLAY">'
                .'<trigger>'
                    .'<abs d="20120315T18302305Z" />'
                    .'<rel neg="1" w="1" d="2" h="3" m="4" s="5" related="START" count="6" />'
                .'</trigger>'
                .'<repeat neg="0" w="1" d="2" h="3" m="4" s="5" related="END" count="6" />'
                .'<desc>desc</desc>'
                .'<attach uri="uri" ct="ct">value</attach>'
                .'<summary>summary</summary>'
                .'<at a="a" url="url" d="d" sentBy="sentBy" dir="dir" lang="lang" cutype="cutype" role="role" ptst="NE" rsvp="1" member="member" delTo="delTo" delFrom="delFrom">'
                    .'<xparam name="name1" value="value1" />'
                .'</at>'
                .'<xprop name="name" value="value">'
                    .'<xparam name="name2" value="value2" />'
                .'</xprop>'
            .'</alarm>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $alarm);

        $array = array(
            'alarm' => array(
                'action' => 'DISPLAY',
                'trigger' => array(
                    'abs' => array(
                        'd' => '20120315T18302305Z',
                    ),
                    'rel' => array(
                        'neg' => 1,
                        'w' => 1,
                        'd' => 2,
                        'h' => 3,
                        'm' => 4,
                        's' => 5,
                        'related' => 'START',
                        'count' => 6,
                    ),
                ),
                'repeat' => array(
                    'neg' => 0,
                    'w' => 1,
                    'd' => 2,
                    'h' => 3,
                    'm' => 4,
                    's' => 5,
                    'related' => 'END',
                    'count' => 6,
                ),
                'desc' => 'desc',
                'attach' => array(
                    'uri' => 'uri',
                    'ct' => 'ct',
                    '_' => 'value',
                ),
                'summary' => 'summary',
                'at' => array(
                    array(
                        'a' => 'a',
                        'url' => 'url',
                        'd' => 'd',
                        'sentBy' => 'sentBy',
                        'dir' => 'dir',
                        'lang' => 'lang',
                        'cutype' => 'cutype',
                        'role' => 'role',
                        'ptst' => 'NE',
                        'rsvp' => 1,
                        'member' => 'member',
                        'delTo' => 'delTo',
                        'delFrom' => 'delFrom',
                        'xparam' => array(
                            array(
                                'name' => 'name1',
                                'value' => 'value1',
                            ),
                        ),
                    ),
                ),
                'xprop' => array(
                    array(
                        'name' => 'name',
                        'value' => 'value',
                        'xparam' => array(
                            array(
                                'name' => 'name2',
                                'value' => 'value2',
                            ),
                        ),
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $alarm->toArray());
    }

    public function testCalOrganizer()
    {
        $xparam1 = new \Zimbra\Soap\Struct\XParam('name1', 'value1');
        $xparam2 = new \Zimbra\Soap\Struct\XParam('name2', 'value2');
        $or = new \Zimbra\Soap\Struct\CalOrganizer(array($xparam1)
            , 'a', 'url', 'd', 'sentBy', 'dir', 'lang'
        );
        $this->assertSame(array($xparam1), $or->xparam()->all());
        $this->assertSame('a', $or->a());
        $this->assertSame('url', $or->url());
        $this->assertSame('d', $or->d());
        $this->assertSame('sentBy', $or->sentBy());
        $this->assertSame('dir', $or->dir());
        $this->assertSame('lang', $or->lang());

        $or->addXParam($xparam2);
        $this->assertSame(array($xparam1, $xparam2), $or->xparam()->all());
        $or->a('a')
           ->url('url')
           ->d('d')
           ->sentBy('sentBy')
           ->dir('dir')
           ->lang('lang');
        $this->assertSame('a', $or->a());
        $this->assertSame('url', $or->url());
        $this->assertSame('d', $or->d());
        $this->assertSame('sentBy', $or->sentBy());
        $this->assertSame('dir', $or->dir());
        $this->assertSame('lang', $or->lang());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<or a="a" url="url" d="d" sentBy="sentBy" dir="dir" lang="lang">'
                .'<xparam name="name1" value="value1" />'
                .'<xparam name="name2" value="value2" />'
            .'</or>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $or);

        $array = array(
            'or' => array(
                'a' => 'a',
                'url' => 'url',
                'd' => 'd',
                'sentBy' => 'sentBy',
                'dir' => 'dir',
                'lang' => 'lang',
                'xparam' => array(
                    array(
                        'name' => 'name1',
                        'value' => 'value1',
                    ),
                    array(
                        'name' => 'name2',
                        'value' => 'value2',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $or->toArray());
    }

    public function testRecurIdInfo()
    {
        $recur = new \Zimbra\Soap\Struct\RecurIdInfo(
            1, '991231', 'tz', '991231000000'
        );
        $this->assertSame(1, $recur->rangeType());
        $this->assertSame('991231', $recur->recurId());
        $this->assertSame('tz', $recur->tz());
        $this->assertSame('991231000000', $recur->ridZ());

        $recur->rangeType(1)
              ->recurId('991231')
              ->tz('tz')
              ->ridZ('991231000000');
        $this->assertSame(1, $recur->rangeType());
        $this->assertSame('991231', $recur->recurId());
        $this->assertSame('tz', $recur->tz());
        $this->assertSame('991231000000', $recur->ridZ());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<recur rangeType="1" recurId="991231" tz="tz" ridZ="991231000000" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $recur);

        $array = array(
            'recur' => array(
                'rangeType' => 1,
                'recurId' => '991231',
                'tz' => 'tz',
                'ridZ' => '991231000000',
            ),
        );
        $this->assertEquals($array, $recur->toArray());
    }

    public function testCancelRuleInfo()
    {
        $cancel = new \Zimbra\Soap\Struct\CancelRuleInfo(
            1, '991231', 'tz', '991231000000'
        );
        $this->assertSame(1, $cancel->rangeType());
        $this->assertSame('991231', $cancel->recurId());
        $this->assertSame('tz', $cancel->tz());
        $this->assertSame('991231000000', $cancel->ridZ());

        $cancel->rangeType(1)
               ->recurId('991231')
               ->tz('tz')
               ->ridZ('991231000000');
        $this->assertSame(1, $cancel->rangeType());
        $this->assertSame('991231', $cancel->recurId());
        $this->assertSame('tz', $cancel->tz());
        $this->assertSame('991231000000', $cancel->ridZ());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<cancel rangeType="1" recurId="991231" tz="tz" ridZ="991231000000" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $cancel);

        $array = array(
            'cancel' => array(
                'rangeType' => 1,
                'recurId' => '991231',
                'tz' => 'tz',
                'ridZ' => '991231000000',
            ),
        );
        $this->assertEquals($array, $cancel->toArray());
    }

    public function testDtTimeInfo()
    {
        $dt = new \Zimbra\Soap\Struct\DtTimeInfo(
            '20120315T18302305Z', 'tz', 1000
        );
        $this->assertSame('20120315T18302305Z', $dt->d());
        $this->assertSame('tz', $dt->tz());
        $this->assertSame(1000, $dt->u());

        $dt->d('20120315T18302305Z')
           ->tz('tz')
           ->u(1000);
        $this->assertSame('20120315T18302305Z', $dt->d());
        $this->assertSame('tz', $dt->tz());
        $this->assertSame(1000, $dt->u());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<dt d="20120315T18302305Z" tz="tz" u="1000" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $dt);

        $array = array(
            'dt' => array(
                'd' => '20120315T18302305Z',
                'tz' => 'tz',
                'u' => 1000,
            ),
        );
        $this->assertEquals($array, $dt->toArray());
    }

    public function testDtVal()
    {
        $s = new \Zimbra\Soap\Struct\DtTimeInfo(
            '20120315T18302305Z', 'tz', 1000
        );
        $e = new \Zimbra\Soap\Struct\DtTimeInfo(
            '20130315T18302305Z', 'tz', 2000
        );
        $dur = new \Zimbra\Soap\Struct\DurationInfo(
            true, 1, 2, 3, 4, 5, 'START', 6
        );

        $dtval = new \Zimbra\Soap\Struct\DtVal($s, $e, $dur);
        $this->assertSame($s, $dtval->s());
        $this->assertSame($e, $dtval->e());
        $this->assertSame($dur, $dtval->dur());

        $dtval->s($s)
              ->e($e)
              ->dur($dur);
        $this->assertSame($s, $dtval->s());
        $this->assertSame($e, $dtval->e());
        $this->assertSame($dur, $dtval->dur());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<dtval>'
                .'<s d="20120315T18302305Z" tz="tz" u="1000" />'
                .'<e d="20130315T18302305Z" tz="tz" u="2000" />'
                .'<dur neg="1" w="1" d="2" h="3" m="4" s="5" related="START" count="6" />'
            .'</dtval>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $dtval);

        $array = array(
            'dtval' => array(
                's' => array(
                    'd' => '20120315T18302305Z',
                    'tz' => 'tz',
                    'u' => 1000,
                ),
                'e' => array(
                    'd' => '20130315T18302305Z',
                    'tz' => 'tz',
                    'u' => 2000,
                ),
                'dur' => array(
                    'neg' => 1,
                    'w' => 1,
                    'd' => 2,
                    'h' => 3,
                    'm' => 4,
                    's' => 5,
                    'related' => 'START',
                    'count' => 6,
                ),
            ),
        );
        $this->assertEquals($array, $dtval->toArray());
    }

    public function testSingleDates()
    {
        $s = new \Zimbra\Soap\Struct\DtTimeInfo(
            '20120315T18302305Z', 'tz', 1000
        );
        $e = new \Zimbra\Soap\Struct\DtTimeInfo(
            '20130315T18302305Z', 'tz', 2000
        );
        $dur = new \Zimbra\Soap\Struct\DurationInfo(
            true, 1, 2, 3, 4, 5, 'START', 6
        );
        $dtval = new \Zimbra\Soap\Struct\DtVal($s, $e, $dur);

        $dates = new \Zimbra\Soap\Struct\SingleDates('tz', array($dtval));
        $this->assertSame('tz', $dates->tz());
        $this->assertSame(array($dtval), $dates->dtval()->all());

        $dates->tz('tz')
              ->addDtVal($dtval);
        $this->assertSame('tz', $dates->tz());
        $this->assertSame(array($dtval, $dtval), $dates->dtval()->all());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<dates tz="tz">'
                .'<dtval>'
                    .'<s d="20120315T18302305Z" tz="tz" u="1000" />'
                    .'<e d="20130315T18302305Z" tz="tz" u="2000" />'
                    .'<dur neg="1" w="1" d="2" h="3" m="4" s="5" related="START" count="6" />'
                .'</dtval>'
                .'<dtval>'
                    .'<s d="20120315T18302305Z" tz="tz" u="1000" />'
                    .'<e d="20130315T18302305Z" tz="tz" u="2000" />'
                    .'<dur neg="1" w="1" d="2" h="3" m="4" s="5" related="START" count="6" />'
                .'</dtval>'
            .'</dates>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $dates);

        $array = array(
            'dates' => array(
                'tz' => 'tz',
                'dtval' => array(
                    array(
                        's' => array(
                            'd' => '20120315T18302305Z',
                            'tz' => 'tz',
                            'u' => 1000,
                        ),
                        'e' => array(
                            'd' => '20130315T18302305Z',
                            'tz' => 'tz',
                            'u' => 2000,
                        ),
                        'dur' => array(
                            'neg' => 1,
                            'w' => 1,
                            'd' => 2,
                            'h' => 3,
                            'm' => 4,
                            's' => 5,
                            'related' => 'START',
                            'count' => 6,
                        ),
                    ),
                    array(
                        's' => array(
                            'd' => '20120315T18302305Z',
                            'tz' => 'tz',
                            'u' => 1000,
                        ),
                        'e' => array(
                            'd' => '20130315T18302305Z',
                            'tz' => 'tz',
                            'u' => 2000,
                        ),
                        'dur' => array(
                            'neg' => 1,
                            'w' => 1,
                            'd' => 2,
                            'h' => 3,
                            'm' => 4,
                            's' => 5,
                            'related' => 'START',
                            'count' => 6,
                        ),
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $dates->toArray());
    }

    public function testDateTimeStringAttr()
    {
        $until = new \Zimbra\Soap\Struct\DateTimeStringAttr('20120315T18302305Z');
        $this->assertSame('20120315T18302305Z', $until->d());
        $until->d('20120315T18302305Z');
        $this->assertSame('20120315T18302305Z', $until->d());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<until d="20120315T18302305Z" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $until);

        $array = array(
            'until' => array(
                'd' => '20120315T18302305Z',
            ),
        );
        $this->assertEquals($array, $until->toArray());
    }

    public function testNumAttr()
    {
        $count = new \Zimbra\Soap\Struct\NumAttr(20120315);
        $this->assertSame(20120315, $count->num());
        $count->num(20120315);
        $this->assertSame(20120315, $count->num());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<count num="20120315" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $count);

        $array = array(
            'count' => array(
                'num' => 20120315,
            ),
        );
        $this->assertEquals($array, $count->toArray());
    }

    public function testIntervalRule()
    {
        $interval = new \Zimbra\Soap\Struct\IntervalRule(20120315);
        $this->assertSame(20120315, $interval->ival());
        $interval->ival(20120315);
        $this->assertSame(20120315, $interval->ival());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<interval ival="20120315" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $interval);

        $array = array(
            'interval' => array(
                'ival' => 20120315,
            ),
        );
        $this->assertEquals($array, $interval->toArray());
    }

    public function testBySecondRule()
    {
        $bysecond = new \Zimbra\Soap\Struct\BySecondRule('10,a,20,b,30');
        $this->assertSame('10,20,30', $bysecond->seclist());
        $bysecond->seclist('10,a,20,b,30');
        $this->assertSame('10,20,30', $bysecond->seclist());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<bysecond seclist="10,20,30" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $bysecond);

        $array = array(
            'bysecond' => array(
                'seclist' => '10,20,30',
            ),
        );
        $this->assertEquals($array, $bysecond->toArray());
    }

    public function testByMinuteRule()
    {
        $byminute = new \Zimbra\Soap\Struct\ByMinuteRule('10,a,20,b,30');
        $this->assertSame('10,20,30', $byminute->minlist());
        $byminute->minlist('10,a,20,b,30');
        $this->assertSame('10,20,30', $byminute->minlist());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<byminute minlist="10,20,30" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $byminute);

        $array = array(
            'byminute' => array(
                'minlist' => '10,20,30',
            ),
        );
        $this->assertEquals($array, $byminute->toArray());
    }

    public function testByHourRule()
    {
        $byhour = new \Zimbra\Soap\Struct\ByHourRule('5,a,10,b,15');
        $this->assertSame('5,10,15', $byhour->hrlist());
        $byhour->hrlist('5,a,10,b,15');
        $this->assertSame('5,10,15', $byhour->hrlist());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<byhour hrlist="5,10,15" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $byhour);

        $array = array(
            'byhour' => array(
                'hrlist' => '5,10,15',
            ),
        );
        $this->assertEquals($array, $byhour->toArray());
    }

    public function testWkDay()
    {
        $wkday = new \Zimbra\Soap\Struct\WkDay(WeekDay::SU(), 1);
        $this->assertSame('SU', (string) $wkday->day());
        $this->assertSame(1, $wkday->ordwk());

        $wkday->day(WeekDay::SU())
              ->ordwk(1);
        $this->assertSame('SU', (string) $wkday->day());
        $this->assertSame(1, $wkday->ordwk());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<wkday day="SU" ordwk="1" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $wkday);

        $array = array(
            'wkday' => array(
                'day' => 'SU',
                'ordwk' => 1,
            ),
        );
        $this->assertEquals($array, $wkday->toArray());
    }

    public function testByDayRule()
    {
        $wkday1 = new \Zimbra\Soap\Struct\WkDay(WeekDay::SU(), 1);
        $wkday2 = new \Zimbra\Soap\Struct\WkDay(WeekDay::MO(), 1);

        $byday = new \Zimbra\Soap\Struct\ByDayRule(array($wkday1));
        $this->assertSame(array($wkday1), $byday->wkday()->all());
        $byday->addWkDay($wkday2);
        $this->assertSame(array($wkday1, $wkday2), $byday->wkday()->all());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<byday>'
                .'<wkday day="SU" ordwk="1" />'
                .'<wkday day="MO" ordwk="1" />'
            .'</byday>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $byday);

        $array = array(
            'byday' => array(
                'wkday' => array(
                    array(
                        'day' => 'SU',
                        'ordwk' => 1,
                    ),
                    array(
                        'day' => 'MO',
                        'ordwk' => 1,
                    ),
                )
            ),
        );
        $this->assertEquals($array, $byday->toArray());
    }

    public function testByMonthDayRule()
    {
        $bymonthday = new \Zimbra\Soap\Struct\ByMonthDayRule('5,a,10,b,15,32');
        $this->assertSame('5,10,15', $bymonthday->modaylist());
        $bymonthday->modaylist('5,a,10,b,15,-32');
        $this->assertSame('5,10,15', $bymonthday->modaylist());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<bymonthday modaylist="5,10,15" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $bymonthday);

        $array = array(
            'bymonthday' => array(
                'modaylist' => '5,10,15',
            ),
        );
        $this->assertEquals($array, $bymonthday->toArray());
    }

    public function testByYearDayRule()
    {
        $byyearday = new \Zimbra\Soap\Struct\ByYearDayRule('5,a,10,b,15,367');
        $this->assertSame('5,10,15', $byyearday->yrdaylist());
        $byyearday->yrdaylist('5,a,10,b,15,-368');
        $this->assertSame('5,10,15', $byyearday->yrdaylist());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<byyearday yrdaylist="5,10,15" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $byyearday);

        $array = array(
            'byyearday' => array(
                'yrdaylist' => '5,10,15',
            ),
        );
        $this->assertEquals($array, $byyearday->toArray());
    }

    public function testByWeekNoRule()
    {
        $byweekno = new \Zimbra\Soap\Struct\ByWeekNoRule('5,a,10,b,15,54');
        $this->assertSame('5,10,15', $byweekno->wklist());
        $byweekno->wklist('5,a,10,b,15,-54');
        $this->assertSame('5,10,15', $byweekno->wklist());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<byweekno wklist="5,10,15" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $byweekno);

        $array = array(
            'byweekno' => array(
                'wklist' => '5,10,15',
            ),
        );
        $this->assertEquals($array, $byweekno->toArray());
    }

    public function testByMonthRule()
    {
        $bymonth = new \Zimbra\Soap\Struct\ByMonthRule('5,a,10,b,15');
        $this->assertSame('5,10', $bymonth->molist());
        $bymonth->molist('5,a,10,b,15');
        $this->assertSame('5,10', $bymonth->molist());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<bymonth molist="5,10" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $bymonth);

        $array = array(
            'bymonth' => array(
                'molist' => '5,10',
            ),
        );
        $this->assertEquals($array, $bymonth->toArray());
    }

    public function testBySetPosRule()
    {
        $bysetpos = new \Zimbra\Soap\Struct\BySetPosRule('5,a,10,b,15,367');
        $this->assertSame('5,10,15', $bysetpos->poslist());
        $bysetpos->poslist('5,a,10,b,15,-368');
        $this->assertSame('5,10,15', $bysetpos->poslist());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<bysetpos poslist="5,10,15" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $bysetpos);

        $array = array(
            'bysetpos' => array(
                'poslist' => '5,10,15',
            ),
        );
        $this->assertEquals($array, $bysetpos->toArray());
    }

    public function testWkstRule()
    {
        $wkst = new \Zimbra\Soap\Struct\WkstRule(WeekDay::SU());
        $this->assertSame('SU', (string) $wkst->day());

        $wkst->day(WeekDay::SU());
        $this->assertSame('SU', (string) $wkst->day());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<wkst day="SU" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $wkst);

        $array = array(
            'wkst' => array(
                'day' => 'SU',
            ),
        );
        $this->assertEquals($array, $wkst->toArray());
    }

    public function testXNameRule()
    {
        $xname = new \Zimbra\Soap\Struct\XNameRule('n', 'v');
        $this->assertSame('n', $xname->name());
        $this->assertSame('v', $xname->value());

        $xname->name('name')
              ->value('value');
        $this->assertSame('name', $xname->name());
        $this->assertSame('value', $xname->value());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<rule-x-name name="name" value="value" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $xname);

        $array = array(
            'rule-x-name' => array(
                'name' => 'name',
                'value' => 'value',
            ),
        );
        $this->assertEquals($array, $xname->toArray());
    }

    public function testSimpleRepeatingRule()
    {
        $wkday = new \Zimbra\Soap\Struct\WkDay(WeekDay::SU(), 1);

        $until = new \Zimbra\Soap\Struct\DateTimeStringAttr('20120315T18302305Z');
        $count = new \Zimbra\Soap\Struct\NumAttr(20120315);
        $interval = new \Zimbra\Soap\Struct\IntervalRule(20120315);
        $bysecond = new \Zimbra\Soap\Struct\BySecondRule('10,a,20,b,30');
        $byminute = new \Zimbra\Soap\Struct\ByMinuteRule('10,a,20,b,30');
        $byhour = new \Zimbra\Soap\Struct\ByHourRule('5,a,10,b,15');
        $byday = new \Zimbra\Soap\Struct\ByDayRule(array($wkday));
        $bymonthday = new \Zimbra\Soap\Struct\ByMonthDayRule('5,a,10,b,15,32');
        $byyearday = new \Zimbra\Soap\Struct\ByYearDayRule('5,a,10,b,15,367');
        $byweekno = new \Zimbra\Soap\Struct\ByWeekNoRule('5,a,10,b,15,54');
        $bymonth = new \Zimbra\Soap\Struct\ByMonthRule('5,a,10,b,15');
        $bysetpos = new \Zimbra\Soap\Struct\BySetPosRule('5,a,10,b,15,367');
        $wkst = new \Zimbra\Soap\Struct\WkstRule(WeekDay::SU());
        $xname = new \Zimbra\Soap\Struct\XNameRule('name', 'value');

        $rule = new \Zimbra\Soap\Struct\SimpleRepeatingRule(
            Frequency::SEC(),
            $until,
            $count,
            $interval,
            $bysecond,
            $byminute,
            $byhour,
            $byday,
            $bymonthday,
            $byyearday,
            $byweekno,
            $bymonth,
            $bysetpos,
            $wkst,
            array($xname)
        );
        $this->assertSame('SEC', (string) $rule->freq());
        $this->assertSame($until, $rule->until());
        $this->assertSame($count, $rule->count());
        $this->assertSame($interval, $rule->interval());
        $this->assertSame($bysecond, $rule->bysecond());
        $this->assertSame($byminute, $rule->byminute());
        $this->assertSame($byhour, $rule->byhour());
        $this->assertSame($byday, $rule->byday());
        $this->assertSame($bymonthday, $rule->bymonthday());
        $this->assertSame($byyearday, $rule->byyearday());
        $this->assertSame($byweekno, $rule->byweekno());
        $this->assertSame($bymonth, $rule->bymonth());
        $this->assertSame($bysetpos, $rule->bysetpos());
        $this->assertSame($wkst, $rule->wkst());
        $this->assertSame(array($xname), $rule->ruleXName()->all());

        $rule->freq(Frequency::SEC())
             ->until($until)
             ->count($count)
             ->interval($interval)
             ->bysecond($bysecond)
             ->byminute($byminute)
             ->byhour($byhour)
             ->byday($byday)
             ->bymonthday($bymonthday)
             ->byyearday($byyearday)
             ->byweekno($byweekno)
             ->bymonth($bymonth)
             ->bysetpos($bysetpos)
             ->wkst($wkst)
             ->addXNameRule($xname);
        $this->assertSame('SEC', (string) $rule->freq());
        $this->assertSame($until, $rule->until());
        $this->assertSame($count, $rule->count());
        $this->assertSame($interval, $rule->interval());
        $this->assertSame($bysecond, $rule->bysecond());
        $this->assertSame($byminute, $rule->byminute());
        $this->assertSame($byhour, $rule->byhour());
        $this->assertSame($byday, $rule->byday());
        $this->assertSame($bymonthday, $rule->bymonthday());
        $this->assertSame($byyearday, $rule->byyearday());
        $this->assertSame($byweekno, $rule->byweekno());
        $this->assertSame($bymonth, $rule->bymonth());
        $this->assertSame($bysetpos, $rule->bysetpos());
        $this->assertSame($wkst, $rule->wkst());
        $this->assertSame(array($xname, $xname), $rule->ruleXName()->all());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<rule freq="SEC">'
                .'<until d="20120315T18302305Z" />'
                .'<count num="20120315" />'
                .'<interval ival="20120315" />'
                .'<bysecond seclist="10,20,30" />'
                .'<byminute minlist="10,20,30" />'
                .'<byhour hrlist="5,10,15" />'
                .'<byday>'
                    .'<wkday day="SU" ordwk="1" />'
                .'</byday>'
                .'<bymonthday modaylist="5,10,15" />'
                .'<byyearday yrdaylist="5,10,15" />'
                .'<byweekno wklist="5,10,15" />'
                .'<bymonth molist="5,10" />'
                .'<bysetpos poslist="5,10,15" />'
                .'<wkst day="SU" />'
                .'<rule-x-name name="name" value="value" />'
                .'<rule-x-name name="name" value="value" />'
            .'</rule>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $rule);

        $array = array(
            'rule' => array(
                'freq' => 'SEC',
                'until' => array(
                    'd' => '20120315T18302305Z',
                ),
                'count' => array(
                    'num' => 20120315,
                ),
                'interval' => array(
                    'ival' => 20120315,
                ),
                'bysecond' => array(
                    'seclist' => '10,20,30',
                ),
                'byminute' => array(
                    'minlist' => '10,20,30',
                ),
                'byhour' => array(
                    'hrlist' => '5,10,15',
                ),
                'byday' => array(
                    'wkday' => array(
                        array(
                            'day' => 'SU',
                            'ordwk' => 1,
                        ),
                    )
                ),
                'bymonthday' => array(
                    'modaylist' => '5,10,15',
                ),
                'byyearday' => array(
                    'yrdaylist' => '5,10,15',
                ),
                'byweekno' => array(
                    'wklist' => '5,10,15',
                ),
                'bymonth' => array(
                    'molist' => '5,10',
                ),
                'bysetpos' => array(
                    'poslist' => '5,10,15',
                ),
                'wkst' => array(
                    'day' => 'SU',
                ),
                'rule-x-name' => array(
                    array(
                        'name' => 'name',
                        'value' => 'value',
                    ),
                    array(
                        'name' => 'name',
                        'value' => 'value',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $rule->toArray());
    }

    public function testRecurrenceInfo()
    {
        $except = new \Zimbra\Soap\Struct\ExceptionRuleInfo(
            1, '991231', 'tz', '991231000000'
        );
        $cancel = new \Zimbra\Soap\Struct\CancelRuleInfo(
            1, '991231', 'tz', '991231000000'
        );

        $s = new \Zimbra\Soap\Struct\DtTimeInfo(
            '20120315T18302305Z', 'tz', 1000
        );
        $e = new \Zimbra\Soap\Struct\DtTimeInfo(
            '20130315T18302305Z', 'tz', 2000
        );
        $dur = new \Zimbra\Soap\Struct\DurationInfo(
            true, 1, 2, 3, 4, 5, 'START', 6
        );
        $dtval = new \Zimbra\Soap\Struct\DtVal($s, $e, $dur);
        $dates = new \Zimbra\Soap\Struct\SingleDates('tz', array($dtval));

        $wkday = new \Zimbra\Soap\Struct\WkDay(WeekDay::SU(), 1);
        $until = new \Zimbra\Soap\Struct\DateTimeStringAttr('20120315T18302305Z');
        $count = new \Zimbra\Soap\Struct\NumAttr(20120315);
        $interval = new \Zimbra\Soap\Struct\IntervalRule(20120315);
        $bysecond = new \Zimbra\Soap\Struct\BySecondRule('10,a,20,b,30');
        $byminute = new \Zimbra\Soap\Struct\ByMinuteRule('10,a,20,b,30');
        $byhour = new \Zimbra\Soap\Struct\ByHourRule('5,a,10,b,15');
        $byday = new \Zimbra\Soap\Struct\ByDayRule(array($wkday));
        $bymonthday = new \Zimbra\Soap\Struct\ByMonthDayRule('5,a,10,b,15,32');
        $byyearday = new \Zimbra\Soap\Struct\ByYearDayRule('5,a,10,b,15,367');
        $byweekno = new \Zimbra\Soap\Struct\ByWeekNoRule('5,a,10,b,15,54');
        $bymonth = new \Zimbra\Soap\Struct\ByMonthRule('5,a,10,b,15');
        $bysetpos = new \Zimbra\Soap\Struct\BySetPosRule('5,a,10,b,15,367');
        $wkst = new \Zimbra\Soap\Struct\WkstRule(WeekDay::SU());
        $xname = new \Zimbra\Soap\Struct\XNameRule('name', 'value');
        $rule = new \Zimbra\Soap\Struct\SimpleRepeatingRule(
            Frequency::SEC(),
            $until,
            $count,
            $interval,
            $bysecond,
            $byminute,
            $byhour,
            $byday,
            $bymonthday,
            $byyearday,
            $byweekno,
            $bymonth,
            $bysetpos,
            $wkst,
            array($xname)
        );

        $add = new \Zimbra\Soap\Struct\AddRecurrenceInfo(null, null, $except, $cancel, $dates, $rule);
        $exclude = new \Zimbra\Soap\Struct\ExcludeRecurrenceInfo(null, null, $except, $cancel, $dates, $rule);
        $recur = new \Zimbra\Soap\Struct\RecurrenceInfo($add, $exclude, $except, $cancel, $dates, $rule);

        $this->assertSame($add, $recur->add());
        $this->assertSame($exclude, $recur->exclude());
        $this->assertSame($except, $recur->except());
        $this->assertSame($cancel, $recur->cancel());
        $this->assertSame($dates, $recur->dates());
        $this->assertSame($rule, $recur->rule());

        $recur->add($add)
              ->exclude($exclude)
              ->except($except)
              ->cancel($cancel)
              ->dates($dates)
              ->rule($rule);
        $this->assertSame($add, $recur->add());
        $this->assertSame($exclude, $recur->exclude());
        $this->assertSame($except, $recur->except());
        $this->assertSame($cancel, $recur->cancel());
        $this->assertSame($dates, $recur->dates());
        $this->assertSame($rule, $recur->rule());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<recur>'
                .'<add>'
                    .'<except rangeType="1" recurId="991231" tz="tz" ridZ="991231000000" />'
                    .'<cancel rangeType="1" recurId="991231" tz="tz" ridZ="991231000000" />'
                    .'<dates tz="tz">'
                        .'<dtval>'
                            .'<s d="20120315T18302305Z" tz="tz" u="1000" />'
                            .'<e d="20130315T18302305Z" tz="tz" u="2000" />'
                            .'<dur neg="1" w="1" d="2" h="3" m="4" s="5" related="START" count="6" />'
                        .'</dtval>'
                    .'</dates>'
                    .'<rule freq="SEC">'
                        .'<until d="20120315T18302305Z" />'
                        .'<count num="20120315" />'
                        .'<interval ival="20120315" />'
                        .'<bysecond seclist="10,20,30" />'
                        .'<byminute minlist="10,20,30" />'
                        .'<byhour hrlist="5,10,15" />'
                        .'<byday>'
                            .'<wkday day="SU" ordwk="1" />'
                        .'</byday>'
                        .'<bymonthday modaylist="5,10,15" />'
                        .'<byyearday yrdaylist="5,10,15" />'
                        .'<byweekno wklist="5,10,15" />'
                        .'<bymonth molist="5,10" />'
                        .'<bysetpos poslist="5,10,15" />'
                        .'<wkst day="SU" />'
                        .'<rule-x-name name="name" value="value" />'
                    .'</rule>'
                .'</add>'
                .'<exclude>'
                    .'<except rangeType="1" recurId="991231" tz="tz" ridZ="991231000000" />'
                    .'<cancel rangeType="1" recurId="991231" tz="tz" ridZ="991231000000" />'
                    .'<dates tz="tz">'
                        .'<dtval>'
                            .'<s d="20120315T18302305Z" tz="tz" u="1000" />'
                            .'<e d="20130315T18302305Z" tz="tz" u="2000" />'
                            .'<dur neg="1" w="1" d="2" h="3" m="4" s="5" related="START" count="6" />'
                        .'</dtval>'
                    .'</dates>'
                    .'<rule freq="SEC">'
                        .'<until d="20120315T18302305Z" />'
                        .'<count num="20120315" />'
                        .'<interval ival="20120315" />'
                        .'<bysecond seclist="10,20,30" />'
                        .'<byminute minlist="10,20,30" />'
                        .'<byhour hrlist="5,10,15" />'
                        .'<byday>'
                            .'<wkday day="SU" ordwk="1" />'
                        .'</byday>'
                        .'<bymonthday modaylist="5,10,15" />'
                        .'<byyearday yrdaylist="5,10,15" />'
                        .'<byweekno wklist="5,10,15" />'
                        .'<bymonth molist="5,10" />'
                        .'<bysetpos poslist="5,10,15" />'
                        .'<wkst day="SU" />'
                        .'<rule-x-name name="name" value="value" />'
                    .'</rule>'
                .'</exclude>'
                .'<except rangeType="1" recurId="991231" tz="tz" ridZ="991231000000" />'
                .'<cancel rangeType="1" recurId="991231" tz="tz" ridZ="991231000000" />'
                .'<dates tz="tz">'
                    .'<dtval>'
                        .'<s d="20120315T18302305Z" tz="tz" u="1000" />'
                        .'<e d="20130315T18302305Z" tz="tz" u="2000" />'
                        .'<dur neg="1" w="1" d="2" h="3" m="4" s="5" related="START" count="6" />'
                    .'</dtval>'
                .'</dates>'
                .'<rule freq="SEC">'
                    .'<until d="20120315T18302305Z" />'
                    .'<count num="20120315" />'
                    .'<interval ival="20120315" />'
                    .'<bysecond seclist="10,20,30" />'
                    .'<byminute minlist="10,20,30" />'
                    .'<byhour hrlist="5,10,15" />'
                    .'<byday>'
                        .'<wkday day="SU" ordwk="1" />'
                    .'</byday>'
                    .'<bymonthday modaylist="5,10,15" />'
                    .'<byyearday yrdaylist="5,10,15" />'
                    .'<byweekno wklist="5,10,15" />'
                    .'<bymonth molist="5,10" />'
                    .'<bysetpos poslist="5,10,15" />'
                    .'<wkst day="SU" />'
                    .'<rule-x-name name="name" value="value" />'
                .'</rule>'
            .'</recur>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $recur);

        $array = array(
            'recur' => array(
                'add' => array(
                    'except' => array(
                        'rangeType' => 1,
                        'recurId' => '991231',
                        'tz' => 'tz',
                        'ridZ' => '991231000000',
                    ),
                    'cancel' => array(
                        'rangeType' => 1,
                        'recurId' => '991231',
                        'tz' => 'tz',
                        'ridZ' => '991231000000',
                    ),
                    'dates' => array(
                        'tz' => 'tz',
                        'dtval' => array(
                            array(
                                's' => array(
                                    'd' => '20120315T18302305Z',
                                    'tz' => 'tz',
                                    'u' => 1000,
                                ),
                                'e' => array(
                                    'd' => '20130315T18302305Z',
                                    'tz' => 'tz',
                                    'u' => 2000,
                                ),
                                'dur' => array(
                                    'neg' => 1,
                                    'w' => 1,
                                    'd' => 2,
                                    'h' => 3,
                                    'm' => 4,
                                    's' => 5,
                                    'related' => 'START',
                                    'count' => 6,
                                ),
                            ),
                        ),
                    ),
                    'rule' => array(
                        'freq' => 'SEC',
                        'until' => array(
                            'd' => '20120315T18302305Z',
                        ),
                        'count' => array(
                            'num' => 20120315,
                        ),
                        'interval' => array(
                            'ival' => 20120315,
                        ),
                        'bysecond' => array(
                            'seclist' => '10,20,30',
                        ),
                        'byminute' => array(
                            'minlist' => '10,20,30',
                        ),
                        'byhour' => array(
                            'hrlist' => '5,10,15',
                        ),
                        'byday' => array(
                            'wkday' => array(
                                array(
                                    'day' => 'SU',
                                    'ordwk' => 1,
                                ),
                            )
                        ),
                        'bymonthday' => array(
                            'modaylist' => '5,10,15',
                        ),
                        'byyearday' => array(
                            'yrdaylist' => '5,10,15',
                        ),
                        'byweekno' => array(
                            'wklist' => '5,10,15',
                        ),
                        'bymonth' => array(
                            'molist' => '5,10',
                        ),
                        'bysetpos' => array(
                            'poslist' => '5,10,15',
                        ),
                        'wkst' => array(
                            'day' => 'SU',
                        ),
                        'rule-x-name' => array(
                            array(
                                'name' => 'name',
                                'value' => 'value',
                            ),
                        ),
                    ),
                ),
                'exclude' => array(
                    'except' => array(
                        'rangeType' => 1,
                        'recurId' => '991231',
                        'tz' => 'tz',
                        'ridZ' => '991231000000',
                    ),
                    'cancel' => array(
                        'rangeType' => 1,
                        'recurId' => '991231',
                        'tz' => 'tz',
                        'ridZ' => '991231000000',
                    ),
                    'dates' => array(
                        'tz' => 'tz',
                        'dtval' => array(
                            array(
                                's' => array(
                                    'd' => '20120315T18302305Z',
                                    'tz' => 'tz',
                                    'u' => 1000,
                                ),
                                'e' => array(
                                    'd' => '20130315T18302305Z',
                                    'tz' => 'tz',
                                    'u' => 2000,
                                ),
                                'dur' => array(
                                    'neg' => 1,
                                    'w' => 1,
                                    'd' => 2,
                                    'h' => 3,
                                    'm' => 4,
                                    's' => 5,
                                    'related' => 'START',
                                    'count' => 6,
                                ),
                            ),
                        ),
                    ),
                    'rule' => array(
                        'freq' => 'SEC',
                        'until' => array(
                            'd' => '20120315T18302305Z',
                        ),
                        'count' => array(
                            'num' => 20120315,
                        ),
                        'interval' => array(
                            'ival' => 20120315,
                        ),
                        'bysecond' => array(
                            'seclist' => '10,20,30',
                        ),
                        'byminute' => array(
                            'minlist' => '10,20,30',
                        ),
                        'byhour' => array(
                            'hrlist' => '5,10,15',
                        ),
                        'byday' => array(
                            'wkday' => array(
                                array(
                                    'day' => 'SU',
                                    'ordwk' => 1,
                                ),
                            )
                        ),
                        'bymonthday' => array(
                            'modaylist' => '5,10,15',
                        ),
                        'byyearday' => array(
                            'yrdaylist' => '5,10,15',
                        ),
                        'byweekno' => array(
                            'wklist' => '5,10,15',
                        ),
                        'bymonth' => array(
                            'molist' => '5,10',
                        ),
                        'bysetpos' => array(
                            'poslist' => '5,10,15',
                        ),
                        'wkst' => array(
                            'day' => 'SU',
                        ),
                        'rule-x-name' => array(
                            array(
                                'name' => 'name',
                                'value' => 'value',
                            ),
                        ),
                    ),
                ),
                'except' => array(
                    'rangeType' => 1,
                    'recurId' => '991231',
                    'tz' => 'tz',
                    'ridZ' => '991231000000',
                ),
                'cancel' => array(
                    'rangeType' => 1,
                    'recurId' => '991231',
                    'tz' => 'tz',
                    'ridZ' => '991231000000',
                ),
                'dates' => array(
                    'tz' => 'tz',
                    'dtval' => array(
                        array(
                            's' => array(
                                'd' => '20120315T18302305Z',
                                'tz' => 'tz',
                                'u' => 1000,
                            ),
                            'e' => array(
                                'd' => '20130315T18302305Z',
                                'tz' => 'tz',
                                'u' => 2000,
                            ),
                            'dur' => array(
                                'neg' => 1,
                                'w' => 1,
                                'd' => 2,
                                'h' => 3,
                                'm' => 4,
                                's' => 5,
                                'related' => 'START',
                                'count' => 6,
                            ),
                        ),
                    ),
                ),
                'rule' => array(
                    'freq' => 'SEC',
                    'until' => array(
                        'd' => '20120315T18302305Z',
                    ),
                    'count' => array(
                        'num' => 20120315,
                    ),
                    'interval' => array(
                        'ival' => 20120315,
                    ),
                    'bysecond' => array(
                        'seclist' => '10,20,30',
                    ),
                    'byminute' => array(
                        'minlist' => '10,20,30',
                    ),
                    'byhour' => array(
                        'hrlist' => '5,10,15',
                    ),
                    'byday' => array(
                        'wkday' => array(
                            array(
                                'day' => 'SU',
                                'ordwk' => 1,
                            ),
                        )
                    ),
                    'bymonthday' => array(
                        'modaylist' => '5,10,15',
                    ),
                    'byyearday' => array(
                        'yrdaylist' => '5,10,15',
                    ),
                    'byweekno' => array(
                        'wklist' => '5,10,15',
                    ),
                    'bymonth' => array(
                        'molist' => '5,10',
                    ),
                    'bysetpos' => array(
                        'poslist' => '5,10,15',
                    ),
                    'wkst' => array(
                        'day' => 'SU',
                    ),
                    'rule-x-name' => array(
                        array(
                            'name' => 'name',
                            'value' => 'value',
                        ),
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $recur->toArray());
    }

    public function testExceptionRecurIdInfo()
    {
        $exceptId = new \Zimbra\Soap\Struct\ExceptionRecurIdInfo(
            '20120315T18302305Z', 'tz', -1
        );
        $this->assertSame('20120315T18302305Z', $exceptId->d());
        $this->assertSame('tz', $exceptId->tz());
        $this->assertSame(-1, $exceptId->rangeType());

        $exceptId->d('20120315T18302305Z')
                 ->tz('tz')
                 ->rangeType(-1);
        $this->assertSame('20120315T18302305Z', $exceptId->d());
        $this->assertSame('tz', $exceptId->tz());
        $this->assertSame(-1, $exceptId->rangeType());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<exceptId d="20120315T18302305Z" tz="tz" rangeType="-1" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $exceptId);

        $array = array(
            'exceptId' => array(
                'd' => '20120315T18302305Z',
                'tz' => 'tz',
                'rangeType' => -1,
            ),
        );
        $this->assertEquals($array, $exceptId->toArray());
    }

    public function testInviteComponentCommon()
    {
        $subject = InviteChange::SUBJECT();
        $location = InviteChange::LOCATION();
        $time = InviteChange::TIME();
        $comp = new \Zimbra\Soap\Struct\InviteComponentCommon(
            'method',
            1,
            true,
            1,
            'name',
            'loc',
            1,
            '20120315T18302305Z',
            true,
            FreeBusyStatus::F(),
            FreeBusyStatus::F(),
            Transparency::O(),
            true,
            'x_uid',
            'uid',
            1,
            1,
            'calItemId',
            'apptId',
            'ciFolder',
            InviteStatus::COMP(),
            InviteClass::PUB(),
            'url',
            true,
            'ridZ',
            true,
            true,
            true,
            array($subject, $location)
        );

        $this->assertSame('method', $comp->method());
        $this->assertSame(1, $comp->compNum());
        $this->assertTrue($comp->rsvp());
        $this->assertSame(1, $comp->priority());
        $this->assertSame('name', $comp->name());
        $this->assertSame('loc', $comp->loc());
        $this->assertSame(1, $comp->percentComplete());
        $this->assertSame('20120315T18302305Z', $comp->completed());
        $this->assertTrue($comp->noBlob());
        $this->assertTrue($comp->fba()->is('F'));
        $this->assertTrue($comp->fb()->is('F'));
        $this->assertTrue($comp->transp()->is('O'));
        $this->assertTrue($comp->isOrg());
        $this->assertSame('x_uid', $comp->x_uid());
        $this->assertSame('uid', $comp->uid());
        $this->assertSame(1, $comp->seq());
        $this->assertSame(1, $comp->d());
        $this->assertSame('calItemId', $comp->calItemId());
        $this->assertSame('apptId', $comp->apptId());
        $this->assertSame('ciFolder', $comp->ciFolder());
        $this->assertTrue($comp->status()->is('COMP'));
        $this->assertTrue($comp->klass()->is('PUB'));
        $this->assertSame('url', $comp->url());
        $this->assertTrue($comp->ex());
        $this->assertSame('ridZ', $comp->ridZ());
        $this->assertTrue($comp->allDay());
        $this->assertTrue($comp->draft());
        $this->assertTrue($comp->neverSent());
        $this->assertSame(array($subject, $location), $comp->change()->all());

        $comp->method('method')
             ->compNum(1)
             ->rsvp(true)
             ->priority(1)
             ->name('name')
             ->loc('loc')
             ->percentComplete(1)
             ->completed('20120315T18302305Z')
             ->noBlob(true)
             ->fba(FreeBusyStatus::F())
             ->fb(FreeBusyStatus::F())
             ->transp(Transparency::O())
             ->isOrg(true)
             ->x_uid('x_uid')
             ->uid('uid')
             ->seq(1)
             ->d(1)
             ->calItemId('calItemId')
             ->apptId('apptId')
             ->ciFolder('ciFolder')
             ->status(InviteStatus::COMP())
             ->klass(InviteClass::PUB())
             ->url('url')
             ->ex(true)
             ->ridZ('ridZ')
             ->allDay(true)
             ->draft(true)
             ->neverSent(true)
             ->addChange($time);
        $this->assertSame('method', $comp->method());
        $this->assertSame(1, $comp->compNum());
        $this->assertTrue($comp->rsvp());
        $this->assertSame(1, $comp->priority());
        $this->assertSame('name', $comp->name());
        $this->assertSame('loc', $comp->loc());
        $this->assertSame(1, $comp->percentComplete());
        $this->assertSame('20120315T18302305Z', $comp->completed());
        $this->assertTrue($comp->noBlob());
        $this->assertTrue($comp->fba()->is('F'));
        $this->assertTrue($comp->fb()->is('F'));
        $this->assertTrue($comp->transp()->is('O'));
        $this->assertTrue($comp->isOrg());
        $this->assertSame('x_uid', $comp->x_uid());
        $this->assertSame('uid', $comp->uid());
        $this->assertSame(1, $comp->seq());
        $this->assertSame(1, $comp->d());
        $this->assertSame('calItemId', $comp->calItemId());
        $this->assertSame('apptId', $comp->apptId());
        $this->assertSame('ciFolder', $comp->ciFolder());
        $this->assertTrue($comp->status()->is('COMP'));
        $this->assertTrue($comp->klass()->is('PUB'));
        $this->assertSame('url', $comp->url());
        $this->assertTrue($comp->ex());
        $this->assertSame('ridZ', $comp->ridZ());
        $this->assertTrue($comp->allDay());
        $this->assertTrue($comp->draft());
        $this->assertTrue($comp->neverSent());
        $this->assertSame(array($subject, $location, $time), $comp->change()->all());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<comp'
                .' method="method"'
                .' compNum="1"'
                .' rsvp="1"'
                .' priority="1"'
                .' name="name"'
                .' loc="loc"'
                .' percentComplete="1"'
                .' completed="20120315T18302305Z"'
                .' noBlob="1"'
                .' fba="F"'
                .' fb="F"'
                .' transp="O"'
                .' isOrg="1"'
                .' x_uid="x_uid"'
                .' uid="uid"'
                .' seq="1"'
                .' d="1"'
                .' calItemId="calItemId"'
                .' apptId="apptId"'
                .' ciFolder="ciFolder"'
                .' status="COMP"'
                .' class="PUB"'
                .' url="url"'
                .' ex="1"'
                .' ridZ="ridZ"'
                .' allDay="1"'
                .' draft="1"'
                .' neverSent="1"'
                .' change="subject,location,time"'
            .' />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $comp);

        $array = array(
            'comp' => array(
                'method' => 'method',
                'compNum' => 1,
                'rsvp' => 1,
                'priority' => 1,
                'name' => 'name',
                'loc' => 'loc',
                'percentComplete' => 1,
                'completed' => '20120315T18302305Z',
                'noBlob' => 1,
                'fba' => 'F',
                'fb' => 'F',
                'transp' => 'O',
                'isOrg' => 1,
                'x_uid' => 'x_uid',
                'uid' => 'uid',
                'seq' => 1,
                'd' => 1,
                'calItemId' => 'calItemId',
                'apptId' => 'apptId',
                'ciFolder' => 'ciFolder',
                'status' => 'COMP',
                'class' => 'PUB',
                'url' => 'url',
                'ex' => 1,
                'ridZ' => 'ridZ',
                'allDay' => 1,
                'draft' => 1,
                'neverSent' => 1,
                'change' => 'subject,location,time',
            ),
        );
        $this->assertEquals($array, $comp->toArray());
    }

    public function testInviteComponent()
    {
        $xparam = new \Zimbra\Soap\Struct\XParam('name', 'value');
        $at = new \Zimbra\Soap\Struct\CalendarAttendee(array($xparam)
            , 'a', 'url', 'd', 'sentBy', 'dir', 'lang', 'cutype', 'role', PartStatus::NE(), true, 'member', 'delTo', 'delFrom'
        );
        $abs = new \Zimbra\Soap\Struct\DateAttr('20120315T18302305Z');
        $rel = new \Zimbra\Soap\Struct\DurationInfo(true, 1, 2, 3, 4, 5, 'START', 6);
        $trigger = new \Zimbra\Soap\Struct\AlarmTriggerInfo($abs, $rel);
        $repeat = new \Zimbra\Soap\Struct\DurationInfo(false, 1, 2, 3, 4, 5, 'END', 6);
        $attach = new \Zimbra\Soap\Struct\CalendarAttach('uri', 'ct', 'value');
        $except = new \Zimbra\Soap\Struct\ExceptionRuleInfo(
            1, '991231', 'tz', '991231000000'
        );
        $cancel = new \Zimbra\Soap\Struct\CancelRuleInfo(
            1, '991231', 'tz', '991231000000'
        );
        $s = new \Zimbra\Soap\Struct\DtTimeInfo(
            '20120315T18302305Z', 'tz', 1000
        );
        $e = new \Zimbra\Soap\Struct\DtTimeInfo(
            '20130315T18302305Z', 'tz', 2000
        );
        $dur = new \Zimbra\Soap\Struct\DurationInfo(
            true, 1, 2, 3, 4, 5, 'START', 6
        );
        $dtval = new \Zimbra\Soap\Struct\DtVal($s, $e, $dur);
        $dates = new \Zimbra\Soap\Struct\SingleDates('tz', array($dtval));
        $wkday = new \Zimbra\Soap\Struct\WkDay(WeekDay::SU(), 1);
        $until = new \Zimbra\Soap\Struct\DateTimeStringAttr('20120315T18302305Z');
        $count = new \Zimbra\Soap\Struct\NumAttr(20120315);
        $interval = new \Zimbra\Soap\Struct\IntervalRule(20120315);
        $bysecond = new \Zimbra\Soap\Struct\BySecondRule('10,a,20,b,30');
        $byminute = new \Zimbra\Soap\Struct\ByMinuteRule('10,a,20,b,30');
        $byhour = new \Zimbra\Soap\Struct\ByHourRule('5,a,10,b,15');
        $byday = new \Zimbra\Soap\Struct\ByDayRule(array($wkday));
        $bymonthday = new \Zimbra\Soap\Struct\ByMonthDayRule('5,a,10,b,15,32');
        $byyearday = new \Zimbra\Soap\Struct\ByYearDayRule('5,a,10,b,15,367');
        $byweekno = new \Zimbra\Soap\Struct\ByWeekNoRule('5,a,10,b,15,54');
        $bymonth = new \Zimbra\Soap\Struct\ByMonthRule('5,a,10,b,15');
        $bysetpos = new \Zimbra\Soap\Struct\BySetPosRule('5,a,10,b,15,367');
        $wkst = new \Zimbra\Soap\Struct\WkstRule(WeekDay::SU());
        $xname = new \Zimbra\Soap\Struct\XNameRule('name', 'value');
        $rule = new \Zimbra\Soap\Struct\SimpleRepeatingRule(
            Frequency::SEC(),
            $until,
            $count,
            $interval,
            $bysecond,
            $byminute,
            $byhour,
            $byday,
            $bymonthday,
            $byyearday,
            $byweekno,
            $bymonth,
            $bysetpos,
            $wkst,
            array($xname)
        );
        $add = new \Zimbra\Soap\Struct\AddRecurrenceInfo(null, null, $except, $cancel, $dates, $rule);
        $exclude = new \Zimbra\Soap\Struct\ExcludeRecurrenceInfo(null, null, $except, $cancel, $dates, $rule);

        $geo = new \Zimbra\Soap\Struct\GeoInfo(123.456, 654.321);
        $xprop = new \Zimbra\Soap\Struct\XProp('name', 'value', array($xparam));
        $alarm = new \Zimbra\Soap\Struct\AlarmInfo(
            AlarmAction::DISPLAY(), $trigger, $repeat, 'desc', $attach, 'summary', array($at), array($xprop)
        );
        $org = new \Zimbra\Soap\Struct\CalOrganizer(array($xparam)
            , 'a', 'url', 'd', 'sentBy', 'dir', 'lang'
        );
        $recur = new \Zimbra\Soap\Struct\RecurrenceInfo($add, $exclude, $except, $cancel, $dates, $rule);
        $exceptId = new \Zimbra\Soap\Struct\ExceptionRecurIdInfo(
            '20120315T18302305Z', 'tz', -1
        );

        $comp = new \Zimbra\Soap\Struct\InviteComponent(
            'method',
            1,
            true,
            1,
            'name',
            'loc',
            1,
            '20120315T18302305Z',
            true,
            FreeBusyStatus::F(),
            FreeBusyStatus::F(),
            Transparency::O(),
            true,
            'x_uid',
            'uid',
            1,
            1,
            'calItemId',
            'apptId',
            'ciFolder',
            InviteStatus::COMP(),
            InviteClass::PUB(),
            'url',
            true,
            'ridZ',
            true,
            true,
            true,
            array(InviteChange::SUBJECT(), InviteChange::LOCATION(), InviteChange::TIME()),
            array('category1', 'category2'),
            array('comment1', 'comment2'),
            array('contact1', 'contact2'),
            $geo,
            array($at),
            array($alarm),
            array($xprop),
            'fr',
            'desc',
            'descHtml',
            $org,
            $recur,
            $exceptId,
            $s,
            $e,
            $dur
        );

        $this->assertSame(array('category1', 'category2'), $comp->category());
        $this->assertSame(array('comment1', 'comment2'), $comp->comment());
        $this->assertSame(array('contact1', 'contact2'), $comp->contact());
        $this->assertSame($geo, $comp->geo());
        $this->assertSame(array($at), $comp->at()->all());
        $this->assertSame(array($alarm), $comp->alarm()->all());
        $this->assertSame(array($xprop), $comp->xprop()->all());
        $this->assertSame('fr', $comp->fr());
        $this->assertSame('desc', $comp->desc());
        $this->assertSame('descHtml', $comp->descHtml());
        $this->assertSame($org, $comp->org());
        $this->assertSame($recur, $comp->recur());
        $this->assertSame($exceptId, $comp->exceptId());
        $this->assertSame($s, $comp->s());
        $this->assertSame($e, $comp->e());
        $this->assertSame($dur, $comp->dur());

        $comp->category(array('category1', 'category2'))
             ->comment(array('comment1', 'comment2'))
             ->contact(array('contact1', 'contact2'))
             ->geo($geo)
             ->addAt($at)
             ->addAlarm($alarm)
             ->addXProp($xprop)
             ->fr('fr')
             ->desc('desc')
             ->descHtml('descHtml')
             ->org($org)
             ->recur($recur)
             ->exceptId($exceptId)
             ->s($s)
             ->e($e)
             ->dur($dur);
        $this->assertSame(array('category1', 'category2'), $comp->category());
        $this->assertSame(array('comment1', 'comment2'), $comp->comment());
        $this->assertSame(array('contact1', 'contact2'), $comp->contact());
        $this->assertSame($geo, $comp->geo());
        $this->assertSame(array($at, $at), $comp->at()->all());
        $this->assertSame(array($alarm, $alarm), $comp->alarm()->all());
        $this->assertSame(array($xprop, $xprop), $comp->xprop()->all());
        $this->assertSame('fr', $comp->fr());
        $this->assertSame('desc', $comp->desc());
        $this->assertSame('descHtml', $comp->descHtml());
        $this->assertSame($org, $comp->org());
        $this->assertSame($recur, $comp->recur());
        $this->assertSame($exceptId, $comp->exceptId());
        $this->assertSame($s, $comp->s());
        $this->assertSame($e, $comp->e());
        $this->assertSame($dur, $comp->dur());

        $comp = new \Zimbra\Soap\Struct\InviteComponent(
            'method',
            1,
            true,
            1,
            'name',
            'loc',
            1,
            '20120315T18302305Z',
            true,
            FreeBusyStatus::F(),
            FreeBusyStatus::F(),
            Transparency::O(),
            true,
            'x_uid',
            'uid',
            1,
            1,
            'calItemId',
            'apptId',
            'ciFolder',
            InviteStatus::COMP(),
            InviteClass::PUB(),
            'url',
            true,
            'ridZ',
            true,
            true,
            true,
            array(InviteChange::SUBJECT(), InviteChange::LOCATION(), InviteChange::TIME()),
            array('category1', 'category2'),
            array('comment1', 'comment2'),
            array('contact1', 'contact2'),
            $geo,
            array($at),
            array($alarm),
            array($xprop),
            'fr',
            'desc',
            'descHtml',
            $org,
            $recur,
            $exceptId,
            $s,
            $e,
            $dur
        );

        $xml = '<?xml version="1.0"?>'."\n"
            .'<comp'
                .' method="method"'
                .' compNum="1"'
                .' rsvp="1"'
                .' priority="1"'
                .' name="name"'
                .' loc="loc"'
                .' percentComplete="1"'
                .' completed="20120315T18302305Z"'
                .' noBlob="1"'
                .' fba="F"'
                .' fb="F"'
                .' transp="O"'
                .' isOrg="1"'
                .' x_uid="x_uid"'
                .' uid="uid"'
                .' seq="1"'
                .' d="1"'
                .' calItemId="calItemId"'
                .' apptId="apptId"'
                .' ciFolder="ciFolder"'
                .' status="COMP"'
                .' class="PUB"'
                .' url="url"'
                .' ex="1"'
                .' ridZ="ridZ"'
                .' allDay="1"'
                .' draft="1"'
                .' neverSent="1"'
                .' change="subject,location,time">'
                .'<category>category1</category>'
                .'<category>category2</category>'
                .'<comment>comment1</comment>'
                .'<comment>comment2</comment>'
                .'<contact>contact1</contact>'
                .'<contact>contact2</contact>'
                .'<geo lat="123.456" lon="654.321" />'
                .'<at a="a" url="url" d="d" sentBy="sentBy" dir="dir" lang="lang" cutype="cutype" role="role" ptst="NE" rsvp="1" member="member" delTo="delTo" delFrom="delFrom">'
                    .'<xparam name="name" value="value" />'
                .'</at>'
                .'<alarm action="DISPLAY">'
                    .'<trigger>'
                        .'<abs d="20120315T18302305Z" />'
                        .'<rel neg="1" w="1" d="2" h="3" m="4" s="5" related="START" count="6" />'
                    .'</trigger>'
                    .'<repeat neg="0" w="1" d="2" h="3" m="4" s="5" related="END" count="6" />'
                    .'<desc>desc</desc>'
                    .'<attach uri="uri" ct="ct">value</attach>'
                    .'<summary>summary</summary>'
                    .'<at a="a" url="url" d="d" sentBy="sentBy" dir="dir" lang="lang" cutype="cutype" role="role" ptst="NE" rsvp="1" member="member" delTo="delTo" delFrom="delFrom">'
                        .'<xparam name="name" value="value" />'
                    .'</at>'
                    .'<xprop name="name" value="value">'
                        .'<xparam name="name" value="value" />'
                    .'</xprop>'
                .'</alarm>'
                .'<xprop name="name" value="value">'
                    .'<xparam name="name" value="value" />'
                .'</xprop>'
                .'<fr>fr</fr>'
                .'<desc>desc</desc>'
                .'<descHtml>descHtml</descHtml>'
                .'<or a="a" url="url" d="d" sentBy="sentBy" dir="dir" lang="lang">'
                    .'<xparam name="name" value="value" />'
                .'</or>'
                .'<recur>'
                    .'<add>'
                        .'<except rangeType="1" recurId="991231" tz="tz" ridZ="991231000000" />'
                        .'<cancel rangeType="1" recurId="991231" tz="tz" ridZ="991231000000" />'
                        .'<dates tz="tz">'
                            .'<dtval>'
                                .'<s d="20120315T18302305Z" tz="tz" u="1000" />'
                                .'<e d="20130315T18302305Z" tz="tz" u="2000" />'
                                .'<dur neg="1" w="1" d="2" h="3" m="4" s="5" related="START" count="6" />'
                            .'</dtval>'
                        .'</dates>'
                        .'<rule freq="SEC">'
                            .'<until d="20120315T18302305Z" />'
                            .'<count num="20120315" />'
                            .'<interval ival="20120315" />'
                            .'<bysecond seclist="10,20,30" />'
                            .'<byminute minlist="10,20,30" />'
                            .'<byhour hrlist="5,10,15" />'
                            .'<byday>'
                                .'<wkday day="SU" ordwk="1" />'
                            .'</byday>'
                            .'<bymonthday modaylist="5,10,15" />'
                            .'<byyearday yrdaylist="5,10,15" />'
                            .'<byweekno wklist="5,10,15" />'
                            .'<bymonth molist="5,10" />'
                            .'<bysetpos poslist="5,10,15" />'
                            .'<wkst day="SU" />'
                            .'<rule-x-name name="name" value="value" />'
                        .'</rule>'
                    .'</add>'
                    .'<exclude>'
                        .'<except rangeType="1" recurId="991231" tz="tz" ridZ="991231000000" />'
                        .'<cancel rangeType="1" recurId="991231" tz="tz" ridZ="991231000000" />'
                        .'<dates tz="tz">'
                            .'<dtval>'
                                .'<s d="20120315T18302305Z" tz="tz" u="1000" />'
                                .'<e d="20130315T18302305Z" tz="tz" u="2000" />'
                                .'<dur neg="1" w="1" d="2" h="3" m="4" s="5" related="START" count="6" />'
                            .'</dtval>'
                        .'</dates>'
                        .'<rule freq="SEC">'
                            .'<until d="20120315T18302305Z" />'
                            .'<count num="20120315" />'
                            .'<interval ival="20120315" />'
                            .'<bysecond seclist="10,20,30" />'
                            .'<byminute minlist="10,20,30" />'
                            .'<byhour hrlist="5,10,15" />'
                            .'<byday>'
                                .'<wkday day="SU" ordwk="1" />'
                            .'</byday>'
                            .'<bymonthday modaylist="5,10,15" />'
                            .'<byyearday yrdaylist="5,10,15" />'
                            .'<byweekno wklist="5,10,15" />'
                            .'<bymonth molist="5,10" />'
                            .'<bysetpos poslist="5,10,15" />'
                            .'<wkst day="SU" />'
                            .'<rule-x-name name="name" value="value" />'
                        .'</rule>'
                    .'</exclude>'
                    .'<except rangeType="1" recurId="991231" tz="tz" ridZ="991231000000" />'
                    .'<cancel rangeType="1" recurId="991231" tz="tz" ridZ="991231000000" />'
                    .'<dates tz="tz">'
                        .'<dtval>'
                            .'<s d="20120315T18302305Z" tz="tz" u="1000" />'
                            .'<e d="20130315T18302305Z" tz="tz" u="2000" />'
                            .'<dur neg="1" w="1" d="2" h="3" m="4" s="5" related="START" count="6" />'
                        .'</dtval>'
                    .'</dates>'
                    .'<rule freq="SEC">'
                        .'<until d="20120315T18302305Z" />'
                        .'<count num="20120315" />'
                        .'<interval ival="20120315" />'
                        .'<bysecond seclist="10,20,30" />'
                        .'<byminute minlist="10,20,30" />'
                        .'<byhour hrlist="5,10,15" />'
                        .'<byday>'
                            .'<wkday day="SU" ordwk="1" />'
                        .'</byday>'
                        .'<bymonthday modaylist="5,10,15" />'
                        .'<byyearday yrdaylist="5,10,15" />'
                        .'<byweekno wklist="5,10,15" />'
                        .'<bymonth molist="5,10" />'
                        .'<bysetpos poslist="5,10,15" />'
                        .'<wkst day="SU" />'
                        .'<rule-x-name name="name" value="value" />'
                    .'</rule>'
                .'</recur>'
                .'<exceptId d="20120315T18302305Z" tz="tz" rangeType="-1" />'
                .'<s d="20120315T18302305Z" tz="tz" u="1000" />'
                .'<e d="20130315T18302305Z" tz="tz" u="2000" />'
                .'<dur neg="1" w="1" d="2" h="3" m="4" s="5" related="START" count="6" />'
            .'</comp>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $comp);

        $array = array(
            'comp' => array(
                'method' => 'method',
                'compNum' => 1,
                'rsvp' => 1,
                'priority' => 1,
                'name' => 'name',
                'loc' => 'loc',
                'percentComplete' => 1,
                'completed' => '20120315T18302305Z',
                'noBlob' => 1,
                'fba' => 'F',
                'fb' => 'F',
                'transp' => 'O',
                'isOrg' => 1,
                'x_uid' => 'x_uid',
                'uid' => 'uid',
                'seq' => 1,
                'd' => 1,
                'calItemId' => 'calItemId',
                'apptId' => 'apptId',
                'ciFolder' => 'ciFolder',
                'status' => 'COMP',
                'class' => 'PUB',
                'url' => 'url',
                'ex' => 1,
                'ridZ' => 'ridZ',
                'allDay' => 1,
                'draft' => 1,
                'neverSent' => 1,
                'change' => 'subject,location,time',
                'category' => array(
                    'category1',
                    'category2',
                ),
                'comment' => array(
                    'comment1',
                    'comment2',
                ),
                'contact' => array(
                    'contact1',
                    'contact2',
                ),
                'geo' => array(
                    'lat' => 123.456,
                    'lon' => 654.321,
                ),
                'at' => array(
                    array(
                        'a' => 'a',
                        'url' => 'url',
                        'd' => 'd',
                        'sentBy' => 'sentBy',
                        'dir' => 'dir',
                        'lang' => 'lang',
                        'cutype' => 'cutype',
                        'role' => 'role',
                        'ptst' => 'NE',
                        'rsvp' => 1,
                        'member' => 'member',
                        'delTo' => 'delTo',
                        'delFrom' => 'delFrom',
                        'xparam' => array(
                            array(
                                'name' => 'name',
                                'value' => 'value',
                            ),
                        ),
                    ),
                ),
                'alarm' => array(
                    array(
                        'action' => 'DISPLAY',
                        'trigger' => array(
                            'abs' => array(
                                'd' => '20120315T18302305Z',
                            ),
                            'rel' => array(
                                'neg' => 1,
                                'w' => 1,
                                'd' => 2,
                                'h' => 3,
                                'm' => 4,
                                's' => 5,
                                'related' => 'START',
                                'count' => 6,
                            ),
                        ),
                        'repeat' => array(
                            'neg' => 0,
                            'w' => 1,
                            'd' => 2,
                            'h' => 3,
                            'm' => 4,
                            's' => 5,
                            'related' => 'END',
                            'count' => 6,
                        ),
                        'desc' => 'desc',
                        'attach' => array(
                            'uri' => 'uri',
                            'ct' => 'ct',
                            '_' => 'value',
                        ),
                        'summary' => 'summary',
                        'at' => array(
                            array(
                                'a' => 'a',
                                'url' => 'url',
                                'd' => 'd',
                                'sentBy' => 'sentBy',
                                'dir' => 'dir',
                                'lang' => 'lang',
                                'cutype' => 'cutype',
                                'role' => 'role',
                                'ptst' => 'NE',
                                'rsvp' => 1,
                                'member' => 'member',
                                'delTo' => 'delTo',
                                'delFrom' => 'delFrom',
                                'xparam' => array(
                                    array(
                                        'name' => 'name',
                                        'value' => 'value',
                                    ),
                                ),
                            ),
                        ),
                        'xprop' => array(
                            array(
                                'name' => 'name',
                                'value' => 'value',
                                'xparam' => array(
                                    array(
                                        'name' => 'name',
                                        'value' => 'value',
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
                'xprop' => array(
                    array(
                        'name' => 'name',
                        'value' => 'value',
                        'xparam' => array(
                            array(
                                'name' => 'name',
                                'value' => 'value',
                            ),
                        ),
                    ),
                ),
                'fr' => 'fr',
                'desc' => 'desc',
                'descHtml' => 'descHtml',
                'or' => array(
                    'a' => 'a',
                    'url' => 'url',
                    'd' => 'd',
                    'sentBy' => 'sentBy',
                    'dir' => 'dir',
                    'lang' => 'lang',
                    'xparam' => array(
                        array(
                            'name' => 'name',
                            'value' => 'value',
                        ),
                    ),
                ),
                'recur' => array(
                    'add' => array(
                        'except' => array(
                            'rangeType' => 1,
                            'recurId' => '991231',
                            'tz' => 'tz',
                            'ridZ' => '991231000000',
                        ),
                        'cancel' => array(
                            'rangeType' => 1,
                            'recurId' => '991231',
                            'tz' => 'tz',
                            'ridZ' => '991231000000',
                        ),
                        'dates' => array(
                            'tz' => 'tz',
                            'dtval' => array(
                                array(
                                    's' => array(
                                        'd' => '20120315T18302305Z',
                                        'tz' => 'tz',
                                        'u' => 1000,
                                    ),
                                    'e' => array(
                                        'd' => '20130315T18302305Z',
                                        'tz' => 'tz',
                                        'u' => 2000,
                                    ),
                                    'dur' => array(
                                        'neg' => 1,
                                        'w' => 1,
                                        'd' => 2,
                                        'h' => 3,
                                        'm' => 4,
                                        's' => 5,
                                        'related' => 'START',
                                        'count' => 6,
                                    ),
                                ),
                            ),
                        ),
                        'rule' => array(
                            'freq' => 'SEC',
                            'until' => array(
                                'd' => '20120315T18302305Z',
                            ),
                            'count' => array(
                                'num' => 20120315,
                            ),
                            'interval' => array(
                                'ival' => 20120315,
                            ),
                            'bysecond' => array(
                                'seclist' => '10,20,30',
                            ),
                            'byminute' => array(
                                'minlist' => '10,20,30',
                            ),
                            'byhour' => array(
                                'hrlist' => '5,10,15',
                            ),
                            'byday' => array(
                                'wkday' => array(
                                    array(
                                        'day' => 'SU',
                                        'ordwk' => 1,
                                    ),
                                )
                            ),
                            'bymonthday' => array(
                                'modaylist' => '5,10,15',
                            ),
                            'byyearday' => array(
                                'yrdaylist' => '5,10,15',
                            ),
                            'byweekno' => array(
                                'wklist' => '5,10,15',
                            ),
                            'bymonth' => array(
                                'molist' => '5,10',
                            ),
                            'bysetpos' => array(
                                'poslist' => '5,10,15',
                            ),
                            'wkst' => array(
                                'day' => 'SU',
                            ),
                            'rule-x-name' => array(
                                array(
                                    'name' => 'name',
                                    'value' => 'value',
                                ),
                            ),
                        ),
                    ),
                    'exclude' => array(
                        'except' => array(
                            'rangeType' => 1,
                            'recurId' => '991231',
                            'tz' => 'tz',
                            'ridZ' => '991231000000',
                        ),
                        'cancel' => array(
                            'rangeType' => 1,
                            'recurId' => '991231',
                            'tz' => 'tz',
                            'ridZ' => '991231000000',
                        ),
                        'dates' => array(
                            'tz' => 'tz',
                            'dtval' => array(
                                array(
                                    's' => array(
                                        'd' => '20120315T18302305Z',
                                        'tz' => 'tz',
                                        'u' => 1000,
                                    ),
                                    'e' => array(
                                        'd' => '20130315T18302305Z',
                                        'tz' => 'tz',
                                        'u' => 2000,
                                    ),
                                    'dur' => array(
                                        'neg' => 1,
                                        'w' => 1,
                                        'd' => 2,
                                        'h' => 3,
                                        'm' => 4,
                                        's' => 5,
                                        'related' => 'START',
                                        'count' => 6,
                                    ),
                                ),
                            ),
                        ),
                        'rule' => array(
                            'freq' => 'SEC',
                            'until' => array(
                                'd' => '20120315T18302305Z',
                            ),
                            'count' => array(
                                'num' => 20120315,
                            ),
                            'interval' => array(
                                'ival' => 20120315,
                            ),
                            'bysecond' => array(
                                'seclist' => '10,20,30',
                            ),
                            'byminute' => array(
                                'minlist' => '10,20,30',
                            ),
                            'byhour' => array(
                                'hrlist' => '5,10,15',
                            ),
                            'byday' => array(
                                'wkday' => array(
                                    array(
                                        'day' => 'SU',
                                        'ordwk' => 1,
                                    ),
                                )
                            ),
                            'bymonthday' => array(
                                'modaylist' => '5,10,15',
                            ),
                            'byyearday' => array(
                                'yrdaylist' => '5,10,15',
                            ),
                            'byweekno' => array(
                                'wklist' => '5,10,15',
                            ),
                            'bymonth' => array(
                                'molist' => '5,10',
                            ),
                            'bysetpos' => array(
                                'poslist' => '5,10,15',
                            ),
                            'wkst' => array(
                                'day' => 'SU',
                            ),
                            'rule-x-name' => array(
                                array(
                                    'name' => 'name',
                                    'value' => 'value',
                                ),
                            ),
                        ),
                    ),
                    'except' => array(
                        'rangeType' => 1,
                        'recurId' => '991231',
                        'tz' => 'tz',
                        'ridZ' => '991231000000',
                    ),
                    'cancel' => array(
                        'rangeType' => 1,
                        'recurId' => '991231',
                        'tz' => 'tz',
                        'ridZ' => '991231000000',
                    ),
                    'dates' => array(
                        'tz' => 'tz',
                        'dtval' => array(
                            array(
                                's' => array(
                                    'd' => '20120315T18302305Z',
                                    'tz' => 'tz',
                                    'u' => 1000,
                                ),
                                'e' => array(
                                    'd' => '20130315T18302305Z',
                                    'tz' => 'tz',
                                    'u' => 2000,
                                ),
                                'dur' => array(
                                    'neg' => 1,
                                    'w' => 1,
                                    'd' => 2,
                                    'h' => 3,
                                    'm' => 4,
                                    's' => 5,
                                    'related' => 'START',
                                    'count' => 6,
                                ),
                            ),
                        ),
                    ),
                    'rule' => array(
                        'freq' => 'SEC',
                        'until' => array(
                            'd' => '20120315T18302305Z',
                        ),
                        'count' => array(
                            'num' => 20120315,
                        ),
                        'interval' => array(
                            'ival' => 20120315,
                        ),
                        'bysecond' => array(
                            'seclist' => '10,20,30',
                        ),
                        'byminute' => array(
                            'minlist' => '10,20,30',
                        ),
                        'byhour' => array(
                            'hrlist' => '5,10,15',
                        ),
                        'byday' => array(
                            'wkday' => array(
                                array(
                                    'day' => 'SU',
                                    'ordwk' => 1,
                                ),
                            )
                        ),
                        'bymonthday' => array(
                            'modaylist' => '5,10,15',
                        ),
                        'byyearday' => array(
                            'yrdaylist' => '5,10,15',
                        ),
                        'byweekno' => array(
                            'wklist' => '5,10,15',
                        ),
                        'bymonth' => array(
                            'molist' => '5,10',
                        ),
                        'bysetpos' => array(
                            'poslist' => '5,10,15',
                        ),
                        'wkst' => array(
                            'day' => 'SU',
                        ),
                        'rule-x-name' => array(
                            array(
                                'name' => 'name',
                                'value' => 'value',
                            ),
                        ),
                    ),
                ),
                'exceptId' => array(
                    'd' => '20120315T18302305Z',
                    'tz' => 'tz',
                    'rangeType' => -1,
                ),
                's' => array(
                    'd' => '20120315T18302305Z',
                    'tz' => 'tz',
                    'u' => 1000,
                ),
                'e' => array(
                    'd' => '20130315T18302305Z',
                    'tz' => 'tz',
                    'u' => 2000,
                ),
                'dur' => array(
                    'neg' => 1,
                    'w' => 1,
                    'd' => 2,
                    'h' => 3,
                    'm' => 4,
                    's' => 5,
                    'related' => 'START',
                    'count' => 6,
                ),
            ),
        );
        $this->assertEquals($array, $comp->toArray());
    }

    public function testInvitationInfo()
    {
        $mp = new \Zimbra\Soap\Struct\MimePartAttachSpec('mid', 'part', true);
        $m = new \Zimbra\Soap\Struct\MsgAttachSpec('id', false);
        $cn = new \Zimbra\Soap\Struct\ContactAttachSpec('id', false);
        $doc = new \Zimbra\Soap\Struct\DocAttachSpec('path', 'id', 1, true);
        $info = new \Zimbra\Soap\Struct\MimePartInfo(array(), null, 'ct', 'content', 'ci');

        $standard = new \Zimbra\Soap\Struct\TzOnsetInfo(1, 2, 3, 4);
        $daylight = new \Zimbra\Soap\Struct\TzOnsetInfo(4, 3, 2, 1);

        $content = new \Zimbra\Soap\Struct\RawInvite('uid', 'value', 'summary');
        $tz = new \Zimbra\Soap\Struct\CalTZInfo('id', 1, 1, 'stdname', 'dayname', $standard, $daylight);
        $attach = new \Zimbra\Soap\Struct\AttachmentsInfo($mp, $m, $cn, $doc, 'aid');
        $mp = new \Zimbra\Soap\Struct\MimePartInfo(array($info), $attach, 'ct', 'content', 'ci');
        $comp = new \Zimbra\Soap\Struct\InviteComponent('method',1,true);

        $inv = new \Zimbra\Soap\Struct\InvitationInfo(
            'method',
            1,
            true
        );

        $inv->content($content)
            ->comp($comp)
            ->addTz($tz)
            ->addMp($mp)
            ->attach($attach)
            ->id('id')
            ->ct('ct')
            ->ci('ci');

        $this->assertSame($content, $inv->content());
        $this->assertSame($comp, $inv->comp());
        $this->assertSame(array($tz), $inv->tz()->all());
        $this->assertSame(array($mp), $inv->mp()->all());
        $this->assertSame($attach, $inv->attach());
        $this->assertSame('id', $inv->id());
        $this->assertSame('ct', $inv->ct());
        $this->assertSame('ci', $inv->ci());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<inv method="method" compNum="1" rsvp="1" id="id" ct="ct" ci="ci">'
                .'<content uid="uid" summary="summary">value</content>'
                .'<comp method="method" compNum="1" rsvp="1" />'
                .'<tz id="id" stdoff="1" dayoff="1" stdname="stdname" dayname="dayname">'
                    .'<standard mon="1" hour="2" min="3" sec="4" />'
                    .'<daylight mon="4" hour="3" min="2" sec="1" />'
                .'</tz>'
                .'<mp ct="ct" content="content" ci="ci">'
                    .'<mp ct="ct" content="content" ci="ci" />'
                    .'<attach aid="aid">'
                        .'<mp mid="mid" part="part" optional="1" />'
                        .'<m id="id" optional="0" />'
                        .'<cn id="id" optional="0" />'
                        .'<doc path="path" id="id" ver="1" optional="1" />'
                    .'</attach>'
                .'</mp>'
                .'<attach aid="aid">'
                    .'<mp mid="mid" part="part" optional="1" />'
                    .'<m id="id" optional="0" />'
                    .'<cn id="id" optional="0" />'
                    .'<doc path="path" id="id" ver="1" optional="1" />'
                .'</attach>'
            .'</inv>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $inv);

        $array = array(
            'inv' => array(
                'method' => 'method',
                'compNum' => 1,
                'rsvp' => 1,
                'id' => 'id',
                'ct' => 'ct',
                'ci' => 'ci',
                'content' => array(
                    '_' => 'value',
                    'uid' => 'uid',
                    'summary' => 'summary',
                ),
                'comp' => array(
                    'method' => 'method',
                    'compNum' => 1,
                    'rsvp' => 1,
                ),
                'tz' => array(
                    array(
                        'id' => 'id',
                        'stdoff' => 1,
                        'dayoff' => 1,
                        'stdname' => 'stdname',
                        'dayname' => 'dayname',
                        'standard' => array(
                            'mon' => 1,
                            'hour' => 2,
                            'min' => 3,
                            'sec' => 4,
                        ),
                        'daylight' => array(
                            'mon' => 4,
                            'hour' => 3,
                            'min' => 2,
                            'sec' => 1,
                        ),
                    ),
                ),
                'mp' => array(
                    array(
                        'ct' => 'ct',
                        'content' => 'content',
                        'ci' => 'ci',
                        'mp' => array(
                            array(
                                'ct' => 'ct',
                                'content' => 'content',
                                'ci' => 'ci',
                            ),
                        ),
                        'attach' => array(
                            'aid' => 'aid',
                            'mp' => array(
                                'mid' => 'mid',
                                'part' => 'part',
                                'optional' => 1,
                            ),
                            'm' => array(
                                'id' => 'id',
                                'optional' => 0,
                            ),
                            'cn' => array(
                                'id' => 'id',
                                'optional' => 0,
                            ),
                            'doc' => array(
                                'path' => 'path',
                                'id' => 'id',
                                'ver' => 1,
                                'optional' => 1,
                            ),
                        ),
                    ),
                ),
                'attach' => array(
                    'aid' => 'aid',
                    'mp' => array(
                        'mid' => 'mid',
                        'part' => 'part',
                        'optional' => 1,
                    ),
                    'm' => array(
                        'id' => 'id',
                        'optional' => 0,
                    ),
                    'cn' => array(
                        'id' => 'id',
                        'optional' => 0,
                    ),
                    'doc' => array(
                        'path' => 'path',
                        'id' => 'id',
                        'ver' => 1,
                        'optional' => 1,
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $inv->toArray());
    }

    public function testEmailAddrInfo()
    {
        $e = new \Zimbra\Soap\Struct\EmailAddrInfo('a', 't', 'p');
        $this->assertSame('a', $e->a());
        $this->assertSame('t', $e->t());
        $this->assertSame('p', $e->p());

        $e->a('a')
          ->t('t')
          ->p('p');
        $this->assertSame('a', $e->a());
        $this->assertSame('t', $e->t());
        $this->assertSame('p', $e->p());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<e a="a" t="t" p="p" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $e);

        $array = array(
            'e' => array(
                'a' => 'a',
                't' => 't',
                'p' => 'p',
            ),
        );
        $this->assertEquals($array, $e->toArray());
    }

    public function testMsg()
    {
        $mp = new \Zimbra\Soap\Struct\MimePartAttachSpec('mid', 'part', true);
        $m = new \Zimbra\Soap\Struct\MsgAttachSpec('id', false);
        $cn = new \Zimbra\Soap\Struct\ContactAttachSpec('id', false);
        $doc = new \Zimbra\Soap\Struct\DocAttachSpec('path', 'id', 1, true);
        $info = new \Zimbra\Soap\Struct\MimePartInfo(array(), null, 'ct', 'content', 'ci');
        $standard = new \Zimbra\Soap\Struct\TzOnsetInfo(1, 2, 3, 4);
        $daylight = new \Zimbra\Soap\Struct\TzOnsetInfo(4, 3, 2, 1);

        $header = new \Zimbra\Soap\Struct\Header('name', 'value');
        $attach = new \Zimbra\Soap\Struct\AttachmentsInfo($mp, $m, $cn, $doc, 'aid');
        $mp = new \Zimbra\Soap\Struct\MimePartInfo(array($info), $attach, 'ct', 'content', 'ci');
        $inv = new \Zimbra\Soap\Struct\InvitationInfo('method', 1, true);
        $e = new \Zimbra\Soap\Struct\EmailAddrInfo('a', 't', 'p');
        $tz = new \Zimbra\Soap\Struct\CalTZInfo('id', 1, 1, 'stdname', 'dayname', $standard, $daylight);

        $m = new \Zimbra\Soap\Struct\Msg(
            'aid',
            'origid',
            'rt',
            'idnt',
            'su',
            'irt',
            'l',
            'f',
            'content',
            array($header),
            $mp,
            $attach,
            $inv,
            array($e),
            array($tz),
            'fr'
        );

        $this->assertSame('aid', $m->aid());
        $this->assertSame('origid', $m->origid());
        $this->assertSame('rt', $m->rt());
        $this->assertSame('idnt', $m->idnt());
        $this->assertSame('su', $m->su());
        $this->assertSame('irt', $m->irt());
        $this->assertSame('l', $m->l());
        $this->assertSame('f', $m->f());
        $this->assertSame('content', $m->content());
        $this->assertSame(array($header), $m->header()->all());
        $this->assertSame($mp, $m->mp());
        $this->assertSame($attach, $m->attach());
        $this->assertSame($inv, $m->inv());
        $this->assertSame(array($e), $m->e()->all());
        $this->assertSame(array($tz), $m->tz()->all());
        $this->assertSame('fr', $m->fr());

        $m->aid('aid')
          ->origid('origid')
          ->rt('rt')
          ->idnt('idnt')
          ->su('su')
          ->irt('irt')
          ->l('l')
          ->f('f')
          ->content('content')
          ->addHeader($header)
          ->mp($mp)
          ->attach($attach)
          ->inv($inv)
          ->addE($e)
          ->addTz($tz)
          ->fr('fr');
        $this->assertSame('aid', $m->aid());
        $this->assertSame('origid', $m->origid());
        $this->assertSame('rt', $m->rt());
        $this->assertSame('idnt', $m->idnt());
        $this->assertSame('su', $m->su());
        $this->assertSame('irt', $m->irt());
        $this->assertSame('l', $m->l());
        $this->assertSame('f', $m->f());
        $this->assertSame('content', $m->content());
        $this->assertSame(array($header, $header), $m->header()->all());
        $this->assertSame($mp, $m->mp());
        $this->assertSame($attach, $m->attach());
        $this->assertSame($inv, $m->inv());
        $this->assertSame(array($e, $e), $m->e()->all());
        $this->assertSame(array($tz, $tz), $m->tz()->all());
        $this->assertSame('fr', $m->fr());

        $m = new \Zimbra\Soap\Struct\Msg(
            'aid',
            'origid',
            'rt',
            'idnt',
            'su',
            'irt',
            'l',
            'f',
            'content',
            array($header),
            $mp,
            $attach,
            $inv,
            array($e),
            array($tz),
            'fr'
        );

        $xml = '<?xml version="1.0"?>'."\n"
            .'<m aid="aid" origid="origid" rt="rt" idnt="idnt" su="su" irt="irt" l="l" f="f">'
                .'<content>content</content>'
                .'<header name="name">value</header>'
                .'<mp ct="ct" content="content" ci="ci">'
                    .'<mp ct="ct" content="content" ci="ci" />'
                    .'<attach aid="aid">'
                        .'<mp mid="mid" part="part" optional="1" />'
                        .'<m id="id" optional="0" />'
                        .'<cn id="id" optional="0" />'
                        .'<doc path="path" id="id" ver="1" optional="1" />'
                    .'</attach>'
                .'</mp>'
                .'<attach aid="aid">'
                    .'<mp mid="mid" part="part" optional="1" />'
                    .'<m id="id" optional="0" />'
                    .'<cn id="id" optional="0" />'
                    .'<doc path="path" id="id" ver="1" optional="1" />'
                .'</attach>'
                .'<inv method="method" compNum="1" rsvp="1" />'
                .'<e a="a" t="t" p="p" />'
                .'<tz id="id" stdoff="1" dayoff="1" stdname="stdname" dayname="dayname">'
                    .'<standard mon="1" hour="2" min="3" sec="4" />'
                    .'<daylight mon="4" hour="3" min="2" sec="1" />'
                .'</tz>'
                .'<fr>fr</fr>'
            .'</m>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $m);

        $array = array(
            'm' => array(
                'aid' => 'aid',
                'origid' => 'origid',
                'rt' => 'rt',
                'idnt' => 'idnt',
                'su' => 'su',
                'irt' => 'irt',
                'l' => 'l',
                'f' => 'f',
                'content' => 'content',
                'header' => array(
                    array(
                        'name' => 'name',
                        '_' => 'value',
                    ),
                ),
                'mp' => array(
                    'ct' => 'ct',
                    'content' => 'content',
                    'ci' => 'ci',
                    'mp' => array(
                        array(
                            'ct' => 'ct',
                            'content' => 'content',
                            'ci' => 'ci',
                        ),
                    ),
                    'attach' => array(
                        'aid' => 'aid',
                        'mp' => array(
                            'mid' => 'mid',
                            'part' => 'part',
                            'optional' => 1,
                        ),
                        'm' => array(
                            'id' => 'id',
                            'optional' => 0,
                        ),
                        'cn' => array(
                            'id' => 'id',
                            'optional' => 0,
                        ),
                        'doc' => array(
                            'path' => 'path',
                            'id' => 'id',
                            'ver' => 1,
                            'optional' => 1,
                        ),
                    ),
                ),
                'attach' => array(
                    'aid' => 'aid',
                    'mp' => array(
                        'mid' => 'mid',
                        'part' => 'part',
                        'optional' => 1,
                    ),
                    'm' => array(
                        'id' => 'id',
                        'optional' => 0,
                    ),
                    'cn' => array(
                        'id' => 'id',
                        'optional' => 0,
                    ),
                    'doc' => array(
                        'path' => 'path',
                        'id' => 'id',
                        'ver' => 1,
                        'optional' => 1,
                    ),
                ),
                'inv' => array(
                    'method' => 'method',
                    'compNum' => 1,
                    'rsvp' => 1,
                ),
                'e' => array(
                    array(
                        'a' => 'a',
                        't' => 't',
                        'p' => 'p',
                    ),
                ),
                'tz' => array(
                    array(
                        'id' => 'id',
                        'stdoff' => 1,
                        'dayoff' => 1,
                        'stdname' => 'stdname',
                        'dayname' => 'dayname',
                        'standard' => array(
                            'mon' => 1,
                            'hour' => 2,
                            'min' => 3,
                            'sec' => 4,
                        ),
                        'daylight' => array(
                            'mon' => 4,
                            'hour' => 3,
                            'min' => 2,
                            'sec' => 1,
                        ),
                    ),
                ),
                'fr' => 'fr',
            ),
        );
        $this->assertEquals($array, $m->toArray());
    }

    public function testAddedComment()
    {
        $comment = new \Zimbra\Soap\Struct\AddedComment('parentId', 'text');
        $this->assertSame('parentId', $comment->parentId());
        $this->assertSame('text', $comment->text());

        $comment->parentId('parentId')
                ->text('text');
        $this->assertSame('parentId', $comment->parentId());
        $this->assertSame('text', $comment->text());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<comment parentId="parentId" text="text" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $comment);

        $array = array(
            'comment' => array(
                'parentId' => 'parentId',
                'text' => 'text',
            ),
        );
        $this->assertEquals($array, $comment->toArray());
    }
}
