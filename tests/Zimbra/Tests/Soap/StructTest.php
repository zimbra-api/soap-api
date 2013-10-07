<?php

namespace Zimbra\Tests\Soap;

use Zimbra\Tests\ZimbraTestCase;
use Zimbra\Utils\SimpleXML;

/**
 * Testcase class for soap struct.
 */
class StructTest extends ZimbraTestCase
{
    public function testAccountACEInfo()
    {
        $info = new \Zimbra\Soap\Struct\AccountACEInfo('usr', 'invite', 'z', 'd', 'k', 'p', false, true);
        $this->assertSame('usr', $info->gt());
        $this->assertSame('invite', $info->right());
        $this->assertSame('z', $info->zid());
        $this->assertSame('d', $info->d());
        $this->assertSame('k', $info->key());
        $this->assertSame('p', $info->pw());
        $this->assertFalse($info->deny());
        $this->assertTrue($info->chkgt());

        $info->gt('all')
             ->right('viewFreeBusy')
             ->zid('zid')
             ->d('dir')
             ->key('key')
             ->pw('pw')
             ->deny(true)
             ->chkgt(false);

        $this->assertSame('all', $info->gt());
        $this->assertSame('viewFreeBusy', $info->right());
        $this->assertSame('zid', $info->zid());
        $this->assertSame('dir', $info->d());
        $this->assertSame('key', $info->key());
        $this->assertSame('pw', $info->pw());
        $this->assertTrue($info->deny());
        $this->assertFalse($info->chkgt());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ace gt="all" right="viewFreeBusy" zid="zid" d="dir" key="key" pw="pw" deny="1" chkgt="0" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $info);

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
        $this->assertEquals($array, $info->toArray());
    }

    public function testAccountSelector()
    {
        $acc = new \Zimbra\Soap\Struct\AccountSelector('id', 'value');
        $this->assertSame('id', $acc->by());
        $this->assertSame('value', $acc->value());

        $acc->value('name')
            ->by('adminName');
        $this->assertSame('adminName', $acc->by());
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
        $attr = new \Zimbra\Soap\Struct\AttachmentIdAttrib('id');
        $this->assertSame('id', $attr->aid());
        $attr->aid('aid');
        $this->assertSame('aid', $attr->aid());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<content aid="aid" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $attr);

        $array = array(
            'content' => array(
                'aid' => 'aid',
            ),
        );
        $this->assertEquals($array, $attr->toArray());
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
        $stub->attrs(array($attr1, $attr2))->addAttr($attr3);
        foreach ($stub->attrs() as $attr)
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
        $cache = new \Zimbra\Soap\Struct\CacheEntrySelector('name', 'cache');
        $this->assertSame('name', $cache->by());
        $this->assertSame('cache', $cache->value());

        $cache->by('id')
              ->value('value');
        $this->assertSame('id', $cache->by());
        $this->assertSame('value', $cache->value());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<entry by="id">value</entry>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $cache);

        $array = array(
            'entry' => array(
                'by' => 'id',
                '_' => 'value',
            ),
        );
        $this->assertEquals($array, $cache->toArray());
    }

    public function testCacheSelector()
    {
        $entry1 = new \Zimbra\Soap\Struct\CacheEntrySelector('id', 'value1');
        $entry2 = new \Zimbra\Soap\Struct\CacheEntrySelector('name', 'value2');

        $cache = new \Zimbra\Soap\Struct\CacheSelector('skin,abc,locale,xyz,account', false, array($entry1, $entry2));
        $this->assertSame('skin,locale,account', $cache->type());
        $this->assertFalse($cache->allServers());
        $this->assertSame(array($entry1, $entry2), $cache->entries());

        $cache->type('abc,skin,account,xyz')
              ->allServers(true)
              ->entries(array($entry1))
              ->addEntry($entry2);
        $this->assertSame('skin,account', $cache->type());
        $this->assertTrue($cache->allServers());
        $this->assertSame(array($entry1, $entry2), $cache->entries());

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
        $cal = new \Zimbra\Soap\Struct\CalendarAttendee(array($xparam1, $xparam2)
            , 'a', 'url', 'd', 'sentBy', 'dir', 'lang', 'cutype', 'role', 'NE', true, 'member', 'delTo', 'delFrom'
        );
        $this->assertSame(array($xparam1, $xparam2), $cal->xparams());
        $this->assertSame('a', $cal->a());
        $this->assertSame('url', $cal->url());
        $this->assertSame('d', $cal->d());
        $this->assertSame('sentBy', $cal->sentBy());
        $this->assertSame('dir', $cal->dir());
        $this->assertSame('lang', $cal->lang());
        $this->assertSame('cutype', $cal->cutype());
        $this->assertSame('role', $cal->role());
        $this->assertSame('NE', $cal->ptst());
        $this->assertTrue($cal->rsvp());
        $this->assertSame('member', $cal->member());
        $this->assertSame('delTo', $cal->delTo());
        $this->assertSame('delFrom', $cal->delFrom());

        $cal->xparams(array($xparam1))->addXParam($xparam2);
        $this->assertSame(array($xparam1, $xparam2), $cal->xparams());
        $cal->a('a')
            ->url('url')
            ->d('d')
            ->sentBy('sentBy')
            ->dir('dir')
            ->lang('lang')
            ->cutype('cutype')
            ->role('role')
            ->ptst('NE')
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
        $this->assertSame('NE', $cal->ptst());
        $this->assertTrue($cal->rsvp());
        $this->assertSame('member', $cal->member());
        $this->assertSame('delTo', $cal->delTo());
        $this->assertSame('delFrom', $cal->delFrom());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<at a="a" url="url" d="d" sentBy="sentBy" dir="dir" lang="lang" cutype="cutype" role="role" ptst="NE" rsvp="1" member="member" delTo="delTo" delFrom="delFrom">'
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
        $cal = new \Zimbra\Soap\Struct\CalendarResourceSelector('id', 'calRes');
        $this->assertSame('id', $cal->by());
        $this->assertSame('calRes', $cal->value());

        $cal->by('name')
            ->value('value');
        $this->assertSame('name', $cal->by());
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
        $target = new \Zimbra\Soap\Struct\CheckRightsTargetSpec('domain', 'id', 'key', array('right1', 'right2'));
        $this->assertSame('domain', $target->type());
        $this->assertSame('id', $target->by());
        $this->assertSame('key', $target->key());
        $this->assertSame(array('right1', 'right2'), $target->rights());

        $target->type('account')
               ->by('name')
               ->key('key')
               ->rights(array('right1', 'right2'))
               ->addRight('right3');

        $this->assertSame('account', $target->type());
        $this->assertSame('name', $target->by());
        $this->assertSame('key', $target->key());
        $this->assertSame(array('right1', 'right2', 'right3'), $target->rights());

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
        $this->assertSame(array('value'), $constraint->values());

        $constraint->min('min')
            ->max('max')
            ->addValue('value1')
            ->addValue('value2');
        $this->assertSame('min', $constraint->min());
        $this->assertSame('max', $constraint->max());
        $this->assertSame(array('value', 'value1', 'value2'), $constraint->values());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<constraint min="min" max="max">'
                .'<values>'
                    .'<v>value</v>'
                    .'<v>value1</v>'
                    .'<v>value2</v>'
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
                        'value2',
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
                .'<constraint min="min" max="max">'
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
        $cos = new \Zimbra\Soap\Struct\CosSelector('id', 'cos');
        $this->assertSame('id', $cos->by());
        $this->assertSame('cos', $cos->value());

        $cos->by('name')
            ->value('value');
        $this->assertSame('name', $cos->by());
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
        $ds = new \Zimbra\Soap\Struct\DataSourceSpecifier('imap', 'n');
        $this->assertSame('imap', $ds->type());
        $this->assertSame('n', $ds->name());

        $attr = new \Zimbra\Soap\Struct\KeyValuePair('key', 'value');
        $ds->type('pop3')
           ->name('name')
           ->addAttr($attr);
        $this->assertSame('pop3', $ds->type());
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
        $subsReq = new \Zimbra\Soap\Struct\DistributionListSubscribeReq('unsubscribe', 'v', false);
        $this->assertSame('unsubscribe', $subsReq->op());
        $this->assertSame('v', $subsReq->value());
        $this->assertFalse($subsReq->bccOwners());

        $subsReq->op('subscribe')
                ->value('value')
                ->bccOwners(true);
        $this->assertSame('subscribe', $subsReq->op());
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
        $grantee = new \Zimbra\Soap\Struct\DistributionListGranteeSelector('all', 'id', 'grantee');
        $this->assertSame('all', $grantee->type());
        $this->assertSame('id', $grantee->by());
        $this->assertSame('grantee', $grantee->value());

        $grantee->type('usr')
                ->by('name')
                ->value('value');
        $this->assertSame('usr', $grantee->type());
        $this->assertSame('name', $grantee->by());
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
        $grantee1 = new \Zimbra\Soap\Struct\DistributionListGranteeSelector('all', 'name', 'value1');
        $grantee2 = new \Zimbra\Soap\Struct\DistributionListGranteeSelector('usr', 'id', 'value2');
        $grantee3 = new \Zimbra\Soap\Struct\DistributionListGranteeSelector('grp', 'name', 'value3');

        $right = new \Zimbra\Soap\Struct\DistributionListRightSpec('name', array($grantee1, $grantee2));
        $this->assertSame('name', $right->right());
        $this->assertSame(array($grantee1, $grantee2), $right->grantees());

        $right->right('right')
              ->grantees(array($grantee1, $grantee2))
              ->addGrantee($grantee3);
        $this->assertSame('right', $right->right());
        $this->assertSame(array($grantee1, $grantee2, $grantee3), $right->grantees());

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
        $subsReq = new \Zimbra\Soap\Struct\DistributionListSubscribeReq('subscribe', 'value', true);
        $owner = new \Zimbra\Soap\Struct\DistributionListGranteeSelector('usr', 'id', 'value');
        $grantee = new \Zimbra\Soap\Struct\DistributionListGranteeSelector('all', 'name', 'value');
        $right = new \Zimbra\Soap\Struct\DistributionListRightSpec('right', array($grantee));
        $attr = new \Zimbra\Soap\Struct\KeyValuePair('key', 'value');

        $dl = new \Zimbra\Soap\Struct\DistributionListAction('modify', 'name', $subsReq, array('dlm'), array($owner), array($right));
        $this->assertSame('modify', $dl->op());
        $this->assertSame('name', $dl->newName());
        $this->assertSame($subsReq, $dl->subsReq());
        $this->assertSame(array('dlm'), $dl->dlms());
        $this->assertSame(array($owner), $dl->owners());
        $this->assertSame(array($right), $dl->rights());

        $dl = new \Zimbra\Soap\Struct\DistributionListAction('modify');
        $dl->op('delete')
           ->newName('newName')
           ->subsReq($subsReq)
           ->addDlm('dlm')
           ->addOwner($owner)
           ->addRight($right)
           ->addAttr($attr);

        $this->assertSame('delete', $dl->op());
        $this->assertSame('newName', $dl->newName());
        $this->assertSame($subsReq, $dl->subsReq());
        $this->assertSame(array('dlm'), $dl->dlms());
        $this->assertSame(array($owner), $dl->owners());
        $this->assertSame(array($right), $dl->rights());

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
        $dl = new \Zimbra\Soap\Struct\DistributionListSelector('id', 'dl');
        $this->assertSame('id', $dl->by());
        $this->assertSame('dl', $dl->value());

        $dl->by('name')
           ->value('value');
        $this->assertSame('name', $dl->by());
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
        $domain = new \Zimbra\Soap\Struct\DomainSelector('id', 'domain');
        $this->assertSame('id', $domain->by());
        $this->assertSame('domain', $domain->value());

        $domain->by('name')
               ->value('value');
        $this->assertSame('name', $domain->by());
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
        $target = new \Zimbra\Soap\Struct\EffectiveRightsTargetSelector('domain', 'target', 'id');
        $this->assertSame('domain', $target->type());
        $this->assertSame('target', $target->value());
        $this->assertSame('id', $target->by());

        $target->type('account')
               ->value('value')
               ->by('name');

        $this->assertSame('account', $target->type());
        $this->assertSame('value', $target->value());
        $this->assertSame('name', $target->by());

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
        $exc = new \Zimbra\Soap\Struct\ExchangeAuthSpec('u', 'u', 'p', 'basic', 't');
        $this->assertSame('u', $exc->url());
        $this->assertSame('u', $exc->user());
        $this->assertSame('p', $exc->pass());
        $this->assertSame('basic', $exc->scheme());
        $this->assertSame('t', $exc->type());

        $exc->url('url')
            ->user('user')
            ->pass('pass')
            ->scheme('form')
            ->type('type');

        $this->assertSame('url', $exc->url());
        $this->assertSame('user', $exc->user());
        $this->assertSame('pass', $exc->pass());
        $this->assertSame('form', $exc->scheme());
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
        $this->assertSame(array($item1, $item2), $mbox->items());

        $mbox->id(2)
            ->items(array($item1, $item2))
            ->addItem($item3);

        $this->assertSame(2, $mbox->id());
        $this->assertSame(array($item1, $item2, $item3), $mbox->items());

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
        $grantee = new \Zimbra\Soap\Struct\GranteeSelector('grantee', 'all', 'name', 'secr3t', false);
        $this->assertSame('all', $grantee->type());
        $this->assertSame('name', $grantee->by());
        $this->assertSame('grantee', $grantee->value());
        $this->assertSame('secr3t', $grantee->secret());
        $this->assertFalse($grantee->all());

        $grantee->type('usr')
                ->by('id')
                ->value('value')
                ->secret('secret')
                ->all(true);
        $this->assertSame('usr', $grantee->type());
        $this->assertSame('id', $grantee->by());
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
        $this->assertSame(array($attr1, $attr2), $identity->attrs());

        $identity->name('name')
                 ->id('id')
                 ->attrs(array($attr1, $attr2))
                 ->addAttr($attr3);

        $this->assertSame('name', $identity->name());
        $this->assertSame('id', $identity->id());
        $this->assertSame(array($attr1, $attr2, $attr3), $identity->attrs());

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
        $logger = new \Zimbra\Soap\Struct\LoggerInfo('cate', 'error');
        $this->assertSame('cate', $logger->category());
        $this->assertSame('error', $logger->level());

        $logger->category('category')
               ->level('info');
        $this->assertSame('category', $logger->category());
        $this->assertSame('info', $logger->level());

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
        $attr1 = new \Zimbra\Soap\Struct\ValueAttrib('value1');
        $attr2 = new \Zimbra\Soap\Struct\ValueAttrib('value2');

        $field = new \Zimbra\Soap\Struct\QueueQueryField('n', array($attr1, $attr2));
        $this->assertSame('n', $field->name());
        $this->assertSame(array($attr1, $attr2), $field->matches());

        $field->name('name')
              ->matches(array($attr1))
              ->addMatch($attr2);
        $this->assertSame('name', $field->name());
        $this->assertSame(array($attr1, $attr2), $field->matches());

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
        $attr = new \Zimbra\Soap\Struct\ValueAttrib('value');
        $field = new \Zimbra\Soap\Struct\QueueQueryField('name', array($attr));

        $query = new \Zimbra\Soap\Struct\QueueQuery(array($field), 10, 10);
        $this->assertSame(10, $query->limit());
        $this->assertSame(10, $query->offset());
        $this->assertSame(array($field), $query->fields());

        $query->limit(100)
              ->offset(0)
              ->fields(array($field))
              ->addField($field);
        $this->assertSame(100, $query->limit());
        $this->assertSame(0, $query->offset());
        $this->assertSame(array($field, $field), $query->fields());

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
        $action = new \Zimbra\Soap\Struct\MailQueueAction($query, 'requeue', 'id');

        $this->assertSame($query, $action->query());
        $this->assertSame('requeue', $action->op());
        $this->assertSame('id', $action->by());

        $action->query($query)
               ->op('hold')
               ->by('query');

        $this->assertSame($query, $action->query());
        $this->assertSame('hold', $action->op());
        $this->assertSame('query', $action->by());

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
        $action = new \Zimbra\Soap\Struct\MailQueueAction($query, 'hold', 'query');

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
        $policy = new \Zimbra\Soap\Struct\Policy('system', 'i', 'n', 'l');
        $this->assertSame('system', $policy->type());
        $this->assertSame('i', $policy->id());
        $this->assertSame('n', $policy->name());
        $this->assertSame('l', $policy->lifetime());

        $policy->type('user')
               ->id('id')
               ->name('name')
               ->lifetime('lifetime');
        $this->assertSame('user', $policy->type());
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
        $pri = new \Zimbra\Soap\Struct\PrincipalSelector('dn', 'principal');
        $this->assertSame('dn', $pri->by());
        $this->assertSame('principal', $pri->value());

        $pri->by('name')
            ->value('value');
        $this->assertSame('name', $pri->by());
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
        $server = new \Zimbra\Soap\Struct\ServerSelector('id', 'server');
        $this->assertSame('id', $server->by());
        $this->assertSame('server', $server->value());

        $server->by('name')
               ->value('value');
        $this->assertSame('name', $server->by());
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
        $action = new \Zimbra\Soap\Struct\MailQueueAction($query, 'hold', 'query');
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
        $content = new \Zimbra\Soap\Struct\SignatureContent('v', 'text/plain');
        $this->assertSame('v', $content->value());
        $this->assertSame('text/plain', $content->type());

        $content->value('value')
                ->type('text/html');
        $this->assertSame('value', $content->value());
        $this->assertSame('text/html', $content->type());

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
        $content1 = new \Zimbra\Soap\Struct\SignatureContent('value1', 'text/plain');
        $content2 = new \Zimbra\Soap\Struct\SignatureContent('value2', 'text/html');

        $sig = new \Zimbra\Soap\Struct\Signature('n', 'i', 'c', array($content1, $content2));
        $this->assertSame('n', $sig->name());
        $this->assertSame('i', $sig->id());
        $this->assertSame('c', $sig->cid());
        $this->assertSame(array($content1, $content2), $sig->contents());

        $sig->name('name')
            ->id('id')
            ->cid('cid')
            ->contents(array($content1))
            ->addContent($content2);
        $this->assertSame('name', $sig->name());
        $this->assertSame('id', $sig->id());
        $this->assertSame('cid', $sig->cid());
        $this->assertSame(array($content1, $content2), $sig->contents());

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

        $wrapper = new \Zimbra\Soap\Struct\StatsValueWrapper(array($stat1, $stat2));
        $this->assertSame(array($stat1, $stat2), $wrapper->stats());

        $wrapper->stats(array($stat1))
                ->addStat($stat2);
        $this->assertSame(array($stat1, $stat2), $wrapper->stats());

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

        $stat = new \Zimbra\Soap\Struct\StatsSpec($values, 'n', 'l');
        $this->assertSame($values, $stat->values());
        $this->assertSame('n', $stat->name());
        $this->assertSame('l', $stat->limit());

        $stat->values($values)
             ->name('name')
             ->limit('limit');
        $this->assertSame($values, $stat->values());
        $this->assertSame('name', $stat->name());
        $this->assertSame('limit', $stat->limit());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<stats name="name" limit="limit">'
                .'<values>'
                    .'<stat name="name" />'
                .'</values>'
            .'</stats>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $stat);

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
        $this->assertEquals($array, $stat->toArray());
    }

    public function testSyncGalAccountDataSourceSpec()
    {
        $ds = new \Zimbra\Soap\Struct\SyncGalAccountDataSourceSpec('id', 'v', false, true);
        $this->assertSame('id', $ds->by());
        $this->assertSame('v', $ds->value());
        $this->assertFalse($ds->fullSync());
        $this->assertTrue($ds->reset());

        $ds->by('name')
           ->value('value')
           ->fullSync(true)
           ->reset(false);
        $this->assertSame('name', $ds->by());
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
        $ds1 = new \Zimbra\Soap\Struct\SyncGalAccountDataSourceSpec('id', 'value1', true, false);
        $ds2 = new \Zimbra\Soap\Struct\SyncGalAccountDataSourceSpec('name', 'value2', false, true);

        $sync = new \Zimbra\Soap\Struct\SyncGalAccountSpec('i', array($ds1, $ds2));
        $this->assertSame('i', $sync->id());
        $this->assertSame(array($ds1, $ds2), $sync->dataSources());

        $sync->id('id')
             ->dataSources(array($ds1))
             ->addDataSource($ds2);
        $this->assertSame('id', $sync->id());
        $this->assertSame(array($ds1, $ds2), $sync->dataSources());

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
        $ucs = new \Zimbra\Soap\Struct\UcServiceSelector('id', 'uc');
        $this->assertSame('id', $ucs->by());
        $this->assertSame('uc', $ucs->value());

        $ucs->by('name')
            ->value('value');
        $this->assertSame('name', $ucs->by());
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
        $waitSet = new \Zimbra\Soap\Struct\WaitSetAddSpec('n', 'i', 't', 'x,m,y,c');
        $this->assertSame('n', $waitSet->name());
        $this->assertSame('i', $waitSet->id());
        $this->assertSame('t', $waitSet->token());
        $this->assertSame('m,c', $waitSet->types());

        $waitSet->name('name')
                ->id('id')
                ->token('token')
                ->types('x,f,y,m,z,c');
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
        $xmpp = new \Zimbra\Soap\Struct\XmppComponentSelector('id', 'xmpp');
        $this->assertSame('id', $xmpp->by());
        $this->assertSame('xmpp', $xmpp->value());

        $xmpp->by('name')
             ->value('value');
        $this->assertSame('name', $xmpp->by());
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
        $domain = new \Zimbra\Soap\Struct\DomainSelector('name', 'domain');
        $server = new \Zimbra\Soap\Struct\ServerSelector('name', 'server');
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
        $acl = new \Zimbra\Soap\Struct\ZimletAcl('c', 'deny');
        $this->assertSame('c', $acl->cos());
        $this->assertSame('deny', $acl->acl());

        $acl->cos('cos')
            ->acl('grant');
        $this->assertSame('cos', $acl->cos());
        $this->assertSame('grant', $acl->acl());

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
        $acl = new \Zimbra\Soap\Struct\ZimletAcl('cos', 'deny');
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
        $zimlet = new \Zimbra\Soap\Struct\ZimletPrefsSpec('n', 'enabled');
        $this->assertSame('n', $zimlet->name());
        $this->assertSame('enabled', $zimlet->presence());

        $zimlet->name('name')
               ->presence('disabled');
        $this->assertSame('name', $zimlet->name());
        $this->assertSame('disabled', $zimlet->presence());

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
