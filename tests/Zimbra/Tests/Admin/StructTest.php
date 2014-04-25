<?php

namespace Zimbra\Tests\Admin;

use Zimbra\Tests\ZimbraTestCase;

use Zimbra\Enum\AclType;
use Zimbra\Enum\AuthScheme;
use Zimbra\Enum\AutoProvPrincipalBy as PrincipalBy;
use Zimbra\Enum\DataSourceBy;
use Zimbra\Enum\CacheEntryBy;
use Zimbra\Enum\CalendarResourceBy as CalResBy;
use Zimbra\Enum\ConditionOperator as CondOp;
use Zimbra\Enum\CosBy;
use Zimbra\Enum\DataSourceType;
use Zimbra\Enum\DistributionListBy as DLBy;
use Zimbra\Enum\DomainBy;
use Zimbra\Enum\GranteeType;
use Zimbra\Enum\GranteeBy;
use Zimbra\Enum\InterestType;
use Zimbra\Enum\LoggingLevel;
use Zimbra\Enum\QueueAction;
use Zimbra\Enum\QueueActionBy;
use Zimbra\Enum\ServerBy;
use Zimbra\Enum\TargetType;
use Zimbra\Enum\TargetBy;
use Zimbra\Enum\Type;
use Zimbra\Enum\UcServiceBy;
use Zimbra\Enum\ZimletStatus;
use Zimbra\Enum\XmppComponentBy as XmppBy;

/**
 * Testcase class for admin struct.
 */
class StructTest extends ZimbraTestCase
{
    public function testAdminAttrsImpl()
    {
        $stub = $this->getMockForAbstractClass('Zimbra\Admin\Struct\AdminAttrsImpl');

        $attr1 = new \Zimbra\Struct\KeyValuePair('key1', 'value1');
        $attr2 = new \Zimbra\Struct\KeyValuePair('key2', 'value2');
        $attr3 = new \Zimbra\Struct\KeyValuePair('key3', 'value3');
        $stub->addAttr($attr1)->attr()->addAll(array($attr2, $attr3));
        foreach ($stub->attr() as $attr)
        {
            $this->assertInstanceOf('\Zimbra\Struct\KeyValuePair', $attr);
        }

        $arr = array(
            'attrs' => array(
                'a' => array(
                    array('n' => 'key1', '_' => 'value1'),
                    array('n' => 'key2', '_' => 'value2'),
                    array('n' => 'key3', '_' => 'value3'),
                )
            ),
        );
        $this->assertEquals($arr, $stub->toArray());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<attrs>'
                .'<a n="key1">value1</a>'
                .'<a n="key2">value2</a>'
                .'<a n="key3">value3</a>'
            .'</attrs>';
        $this->assertXmlStringEqualsXmlString($xml, $stub->toXml()->asXml());
    }

    public function testAttachmentIdAttrib()
    {
        $content = new \Zimbra\Admin\Struct\AttachmentIdAttrib('id');
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

    public function testCacheEntrySelector()
    {
        $entry = new \Zimbra\Admin\Struct\CacheEntrySelector(CacheEntryBy::NAME(), 'cache');
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
        $entry1 = new \Zimbra\Admin\Struct\CacheEntrySelector(CacheEntryBy::ID(), 'value1');
        $entry2 = new \Zimbra\Admin\Struct\CacheEntrySelector(CacheEntryBy::NAME(), 'value2');

        $cache = new \Zimbra\Admin\Struct\CacheSelector('skin,abc,locale,xyz,account', false, array($entry1));
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
            .'<cache type="skin,account" allServers="true">'
                .'<entry by="id">value1</entry>'
                .'<entry by="name">value2</entry>'
            .'</cache>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $cache);

        $array = array(
            'cache' => array(
                'type' => 'skin,account',
                'allServers' => true,
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

    public function testCalendarResourceSelector()
    {
        $cal = new \Zimbra\Admin\Struct\CalendarResourceSelector(CalResBy::ID(), 'calRes');
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

    public function testCalTzInfo()
    {
        $standard = new \Zimbra\Struct\TzOnsetInfo(12, 2, 3, 4);
        $daylight = new \Zimbra\Struct\TzOnsetInfo(4, 3, 2, 10);

        $tzi = new \Zimbra\Admin\Struct\CalTZInfo('id', 2, 3, $daylight, $standard, 'std', 'day');
        $this->assertSame('id', $tzi->id());
        $this->assertSame(2, $tzi->stdoff());
        $this->assertSame(3, $tzi->dayoff());
        $this->assertSame('std', $tzi->stdname());
        $this->assertSame('day', $tzi->dayname());
        $this->assertSame($daylight, $tzi->standard());
        $this->assertSame($standard, $tzi->daylight());

        $tzi->id('id')
            ->stdoff(4)
            ->dayoff(5)
            ->stdname('stdname')
            ->dayname('dayname')
            ->standard($standard)
            ->daylight($daylight);
        $this->assertSame('id', $tzi->id());
        $this->assertSame(4, $tzi->stdoff());
        $this->assertSame(5, $tzi->dayoff());
        $this->assertSame('stdname', $tzi->stdname());
        $this->assertSame('dayname', $tzi->dayname());
        $this->assertSame($standard, $tzi->standard());
        $this->assertSame($daylight, $tzi->daylight());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<tz id="id" stdoff="4" dayoff="5" stdname="stdname" dayname="dayname">'
                .'<standard mon="12" hour="2" min="3" sec="4" />'
                .'<daylight mon="4" hour="3" min="2" sec="10" />'
            .'</tz>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $tzi);

        $array = array(
            'tz' => array(
                'id' => 'id',
                'stdoff' => 4,
                'dayoff' => 5,
                'stdname' => 'stdname',
                'dayname' => 'dayname',
                'standard' => array(
                    'mon' => 12,
                    'hour' => 2,
                    'min' => 3,
                    'sec' => 4,
                ),
                'daylight' => array(
                    'mon' => 4,
                    'hour' => 3,
                    'min' => 2,
                    'sec' => 10,
                ),
            ),
        );
        $this->assertEquals($array, $tzi->toArray());
    }

    public function testCheckDirSelector()
    {
        $dir = new \Zimbra\Admin\Struct\CheckDirSelector('path', false);
        $this->assertSame('path', $dir->path());
        $this->assertFalse($dir->create());

        $dir->path('path')
            ->create(true);
        $this->assertSame('path', $dir->path());
        $this->assertTrue($dir->create());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<directory path="path" create="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $dir);

        $array = array(
            'directory' => array(
                'path' => 'path',
                'create' => true,
            ),
        );
        $this->assertEquals($array, $dir->toArray());
    }

    public function testConstraintInfoValues()
    {
        $values = new \Zimbra\Admin\Struct\ConstraintInfoValues(array('value'));
        $this->assertSame(array('value'), $values->values()->all());
        $values->addValue('value1');
        $this->assertSame(array('value', 'value1'), $values->values()->all());

        $xml = '<?xml version="1.0"?>'."\n"
                .'<values>'
                    .'<v>value</v>'
                    .'<v>value1</v>'
                .'</values>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $values);

        $array = array(
            'values' => array(
                'v' => array(
                    'value',
                    'value1',
                ),
            ),
        );
        $this->assertEquals($array, $values->toArray());
    }

    public function testConstraintInfo()
    {
        $values = new \Zimbra\Admin\Struct\ConstraintInfoValues(array('value'));
        $constraint = new \Zimbra\Admin\Struct\ConstraintInfo('max', 'min', $values);
        $this->assertSame('max', $constraint->min());
        $this->assertSame('min', $constraint->max());
        $this->assertSame($values, $constraint->values());

        $constraint->min('min')
            ->max('max')
            ->values($values);
        $this->assertSame('min', $constraint->min());
        $this->assertSame('max', $constraint->max());
        $this->assertSame($values, $constraint->values());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<constraint>'
                .'<min>min</min>'
                .'<max>max</max>'
                .'<values>'
                    .'<v>value</v>'
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
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $constraint->toArray());
    }

    public function testConstraintAttr()
    {
        $values = new \Zimbra\Admin\Struct\ConstraintInfoValues(array('value'));
        $constraint = new \Zimbra\Admin\Struct\ConstraintInfo('min', 'max', $values);
        $attr = new \Zimbra\Admin\Struct\ConstraintAttr($constraint, 'name');
        $this->assertSame('name', $attr->name());
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
                        .'<v>value</v>'
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
                            'value',
                        ),
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $attr->toArray());
    }

    public function testCookieSpec()
    {
        $cookie = new \Zimbra\Admin\Struct\CookieSpec('cookie');
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
        $cos = new \Zimbra\Admin\Struct\CosSelector(CosBy::ID(), 'cos');
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

    public function testDataSourceSpecifier()
    {
        $ds = new \Zimbra\Admin\Struct\DataSourceSpecifier(DataSourceType::IMAP(), 'name');
        $this->assertTrue($ds->type()->is('imap'));
        $this->assertSame('name', $ds->name());

        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');
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
        $device = new \Zimbra\Admin\Struct\DeviceId('id');
        $this->assertSame('id', $device->id());

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

    public function testDistributionListSelector()
    {
        $dl = new \Zimbra\Admin\Struct\DistributionListSelector(DLBy::ID(), 'dl');
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
        $domain = new \Zimbra\Admin\Struct\DomainSelector(DomainBy::ID(), 'domain');
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
        $target = new \Zimbra\Admin\Struct\EffectiveRightsTargetSelector(
            TargetType::DOMAIN(), TargetBy::ID(), 'target'
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
        $cond = new \Zimbra\Admin\Struct\EntrySearchFilterSingleCond('attr', CondOp::EQ(), 'value', false);
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
        $otherCond = new \Zimbra\Admin\Struct\EntrySearchFilterSingleCond('attr', CondOp::GE(), 'value', false);
        $otherConds = new \Zimbra\Admin\Struct\EntrySearchFilterMultiCond(false, true, NULL, $otherCond);
        $cond = new \Zimbra\Admin\Struct\EntrySearchFilterSingleCond('a', CondOp::EQ(), 'v', true);
        $conds = new \Zimbra\Admin\Struct\EntrySearchFilterMultiCond(false, true, $otherConds, $cond);

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
        $otherCond = new \Zimbra\Admin\Struct\EntrySearchFilterSingleCond('attr', CondOp::GE(), 'value', false);
        $otherConds = new \Zimbra\Admin\Struct\EntrySearchFilterMultiCond(false, true, NULL, $otherCond);
        $cond = new \Zimbra\Admin\Struct\EntrySearchFilterSingleCond('a', CondOp::EQ(), 'v', true);
        $conds = new \Zimbra\Admin\Struct\EntrySearchFilterMultiCond(true, false, $otherConds, $cond);

        $filter = new \Zimbra\Admin\Struct\EntrySearchFilterInfo($conds, $cond);
        $this->assertSame($conds, $filter->conds());
        $filter->conds($conds);
        $this->assertSame($conds, $filter->conds());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<searchFilter>'
                .'<conds not="true" or="false">'
                    .'<conds not="false" or="true">'
                        .'<cond attr="attr" op="ge" value="value" not="false" />'
                    .'</conds>'
                    .'<cond attr="a" op="eq" value="v" not="true" />'
                .'</conds>'
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
            ),
        );
        $this->assertEquals($array, $filter->toArray());

        $filter = new \Zimbra\Admin\Struct\EntrySearchFilterInfo($cond);
        $this->assertSame($cond, $filter->cond());
        $filter->cond($cond);
        $this->assertSame($cond, $filter->cond());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<searchFilter>'
                .'<cond attr="a" op="eq" value="v" not="true" />'
            .'</searchFilter>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $filter);

        $array = array(
            'searchFilter' => array(
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

    public function testExchangeAuthSpec()
    {
        $exc = new \Zimbra\Admin\Struct\ExchangeAuthSpec('url', 'user', 'pass', AuthScheme::BASIC(), 'type');
        $this->assertSame('url', $exc->url());
        $this->assertSame('user', $exc->user());
        $this->assertSame('pass', $exc->pass());
        $this->assertSame('basic', $exc->scheme()->value());
        $this->assertSame('type', $exc->type());

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
        $item = new \Zimbra\Admin\Struct\ExportAndDeleteItemSpec(2, 3);
        $this->assertSame(2, $item->id());
        $this->assertSame(3, $item->version());

        $item->id(3)
             ->version(2);
        $this->assertSame(3, $item->id());
        $this->assertSame(2, $item->version());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<item id="3" version="2" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $item);

        $array = array(
            'item' => array(
                'id' => 3,
                'version' => 2,
            ),
        );
        $this->assertEquals($array, $item->toArray());
    }

    public function testExportAndDeleteMailboxSpec()
    {
        $item1 = new \Zimbra\Admin\Struct\ExportAndDeleteItemSpec(2, 3);
        $item2 = new \Zimbra\Admin\Struct\ExportAndDeleteItemSpec(3, 4);

        $mbox = new \Zimbra\Admin\Struct\ExportAndDeleteMailboxSpec(100, array($item1));
        $this->assertSame(100, $mbox->id());
        $this->assertSame(array($item1), $mbox->item()->all());

        $mbox->id(10)
             ->addItem($item2);

        $this->assertSame(10, $mbox->id());
        $this->assertSame(array($item1, $item2), $mbox->item()->all());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<mbox id="10">'
                .'<item id="2" version="3" />'
                .'<item id="3" version="4" />'
            .'</mbox>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $mbox);

        $array = array(
            'mbox' => array(
                'id' => 10,
                'item' => array(
                    array(
                        'id' => 2,
                        'version' => 3,
                    ),
                    array(
                        'id' => 3,
                        'version' => 4,
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $mbox->toArray());
    }

    public function testGranteeSelector()
    {
        $grantee = new \Zimbra\Admin\Struct\GranteeSelector(
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
            .'<grantee type="usr" by="id" secret="secret" all="true">value</grantee>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $grantee);

        $array = array(
            'grantee' => array(
                '_' => 'value',
                'type' => 'usr',
                'by' => 'id',
                'secret' => 'secret',
                'all' => true,
            ),
        );
        $this->assertEquals($array, $grantee->toArray());
    }

    public function testHostName()
    {
        $host = new \Zimbra\Admin\Struct\HostName('hostName');
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

    public function testIdAndAction()
    {
        $ia = new \Zimbra\Admin\Struct\IdAndAction('id', 'bug72174');
        $this->assertSame('id', $ia->id());
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

    public function testIdStatus()
    {
        $is = new \Zimbra\Admin\Struct\IdStatus('id', 'status');
        $this->assertSame('id', $is->id());
        $this->assertSame('status', $is->status());

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
        $attr = new \Zimbra\Admin\Struct\IntegerValueAttrib(100);
        $this->assertSame(100, $attr->value());

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
        $attr = new \Zimbra\Admin\Struct\IntIdAttr(100);
        $this->assertSame(100, $attr->id());

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
        $query = new \Zimbra\Admin\Struct\LimitedQuery(10, 'query');
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
        $logger = new \Zimbra\Admin\Struct\LoggerInfo('cate', LoggingLevel::ERROR());
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
        $mbox = new \Zimbra\Admin\Struct\MailboxByAccountIdSelector('id');
        $this->assertSame('id', $mbox->id());

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

    public function testMailQueueAction()
    {
        $attr = new \Zimbra\Admin\Struct\ValueAttrib('value');
        $field = new \Zimbra\Admin\Struct\QueueQueryField('name', array($attr));
        $query = new \Zimbra\Admin\Struct\QueueQuery(array($field), 100, 100);
        $action = new \Zimbra\Admin\Struct\MailQueueAction($query, QueueAction::REQUEUE(), QueueActionBy::ID());

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
                .'<query limit="100" offset="100">'
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
                    'offset' => 100,
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
        $attr = new \Zimbra\Admin\Struct\ValueAttrib('value');
        $field = new \Zimbra\Admin\Struct\QueueQueryField('name', array($attr));
        $query = new \Zimbra\Admin\Struct\QueueQuery(array($field), 100, 100);

        $queue = new \Zimbra\Admin\Struct\MailQueueQuery($query, 'name', false, 100);
        $this->assertSame($query, $queue->query());
        $this->assertSame('name', $queue->name());
        $this->assertFalse($queue->scan());
        $this->assertSame(100, $queue->wait());

        $queue->query($query)
              ->name('name')
              ->scan(true)
              ->wait(10);
        $this->assertSame($query, $queue->query());
        $this->assertSame('name', $queue->name());
        $this->assertTrue($queue->scan());
        $this->assertSame(10, $queue->wait());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<queue name="name" scan="true" wait="10">'
                .'<query limit="100" offset="100">'
                    .'<field name="name">'
                        .'<match value="value" />'
                    .'</field>'
                .'</query>'
            .'</queue>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $queue);

        $array = array(
            'queue' => array(
                'name' => 'name',
                'scan' => true,
                'wait' => 10,
                'query' => array(
                    'limit' => 100,
                    'offset' => 100,
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
        $attr = new \Zimbra\Admin\Struct\ValueAttrib('value');
        $field = new \Zimbra\Admin\Struct\QueueQueryField('name', array($attr));
        $query = new \Zimbra\Admin\Struct\QueueQuery(array($field), 100, 100);
        $action = new \Zimbra\Admin\Struct\MailQueueAction($query, QueueAction::HOLD(), QueueActionBy::QUERY());

        $queue = new \Zimbra\Admin\Struct\MailQueueWithAction($action, 'name');
        $this->assertSame('name', $queue->name());
        $this->assertSame($action, $queue->action());

        $queue->action($action)
              ->name('name');
        $this->assertSame('name', $queue->name());
        $this->assertSame($action, $queue->action());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<queue name="name">'
                .'<action op="hold" by="query">'
                    .'<query limit="100" offset="100">'
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
                        'offset' => 100,
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

    public function testNames()
    {
        $names = new \Zimbra\Admin\Struct\Names('name');
        $this->assertSame('name', $names->name());

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
        $offset = new \Zimbra\Admin\Struct\Offset(100);
        $this->assertSame(100, $offset->offset());

        $offset->offset(10);
        $this->assertSame(10, $offset->offset());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<offset offset="10" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $offset);

        $array = array(
            'offset' => array(
                'offset' => 10,
            ),
        );
        $this->assertEquals($array, $offset->toArray());
    }

    public function testPackageSelector()
    {
        $package = new \Zimbra\Admin\Struct\PackageSelector('name');
        $this->assertSame('name', $package->name());

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
        $policy = new \Zimbra\Admin\Struct\Policy(Type::SYSTEM(), 'id', 'name', 'lifetime');
        $this->assertSame('system', $policy->type()->value());
        $this->assertSame('id', $policy->id());
        $this->assertSame('name', $policy->name());
        $this->assertSame('lifetime', $policy->lifetime());

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
                '_jsns' => 'urn:zimbraMail',
                'type' => 'user',
                'id' => 'id',
                'name' => 'name',
                'lifetime' => 'lifetime',
            ),
        );
        $this->assertEquals($array, $policy->toArray());
    }

    public function testPolicyHolder()
    {
        $policy = new \Zimbra\Admin\Struct\Policy(Type::SYSTEM(), 'id', 'name', 'lifetime');
        $holder = new \Zimbra\Admin\Struct\PolicyHolder($policy);
        $this->assertSame($policy, $holder->policy());
        $holder->policy($policy);
        $this->assertSame($policy, $holder->policy());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<holder>'
                .'<policy xmlns="urn:zimbraMail" type="system" id="id" name="name" lifetime="lifetime" />'
            .'</holder>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $holder);

        $array = array(
            'holder' => array(
                'policy' => array(
                    '_jsns' => 'urn:zimbraMail',
                    'type' => 'system',
                    'id' => 'id',
                    'name' => 'name',
                    'lifetime' => 'lifetime',
                ),
            ),
        );
        $this->assertEquals($array, $holder->toArray());
    }

    public function testPrincipalSelector()
    {
        $pri = new \Zimbra\Admin\Struct\PrincipalSelector(PrincipalBy::DN(), 'principal');
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

    public function testQueueQueryField()
    {
        $match1 = new \Zimbra\Admin\Struct\ValueAttrib('value1');
        $match2 = new \Zimbra\Admin\Struct\ValueAttrib('value2');

        $field = new \Zimbra\Admin\Struct\QueueQueryField('name', array($match1));
        $this->assertSame('name', $field->name());
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
        $match = new \Zimbra\Admin\Struct\ValueAttrib('value');
        $field = new \Zimbra\Admin\Struct\QueueQueryField('name', array($match));

        $query = new \Zimbra\Admin\Struct\QueueQuery(array($field), 10, 10);
        $this->assertSame(10, $query->limit());
        $this->assertSame(10, $query->offset());
        $this->assertSame(array($field), $query->field()->all());

        $query->limit(100)
              ->offset(100)
              ->addField($field);
        $this->assertSame(100, $query->limit());
        $this->assertSame(100, $query->offset());
        $this->assertSame(array($field, $field), $query->field()->all());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<query limit="100" offset="100">'
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
                'offset' => 100,
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

    public function testReindexMailboxInfo()
    {
        $mbox = new \Zimbra\Admin\Struct\ReindexMailboxInfo('id', 'contact, , appointment,xyz', 'ids');
        $this->assertSame('id', $mbox->id());
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

    public function testRightModifierInfo()
    {
        $right = new \Zimbra\Admin\Struct\RightModifierInfo('value', false, true, true, false);
        $this->assertSame('value', $right->value());
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
            .'<right deny="true" canDelegate="false" disinheritSubGroups="false" subDomain="true">value</right>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $right);

        $array = array(
            'right' => array(
                'deny' => true,
                'canDelegate' => false,
                'disinheritSubGroups' => false,
                'subDomain' => true,
                '_' => 'value',
            ),
        );
        $this->assertEquals($array, $right->toArray());
    }

    public function testServerMailQueueQuery()
    {
        $attr = new \Zimbra\Admin\Struct\ValueAttrib('value');
        $field = new \Zimbra\Admin\Struct\QueueQueryField('name', array($attr));
        $query = new \Zimbra\Admin\Struct\QueueQuery(array($field), 100, 100);
        $queue = new \Zimbra\Admin\Struct\MailQueueQuery($query, 'name', true, 100);

        $server = new \Zimbra\Admin\Struct\ServerMailQueueQuery($queue, 'name');
        $this->assertSame('name', $server->name());
        $this->assertSame($queue, $server->queue());

        $server->name('name')
               ->queue($queue);
        $this->assertSame('name', $server->name());
        $this->assertSame($queue, $server->queue());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<server name="name">'
                .'<queue name="name" scan="true" wait="100">'
                    .'<query limit="100" offset="100">'
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
                    'scan' => true,
                    'wait' => 100,
                    'query' => array(
                        'limit' => 100,
                        'offset' => 100,
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
        $server = new \Zimbra\Admin\Struct\ServerSelector(ServerBy::ID(), 'server');
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
        $attr = new \Zimbra\Admin\Struct\ValueAttrib('value');
        $field = new \Zimbra\Admin\Struct\QueueQueryField('name', array($attr));
        $query = new \Zimbra\Admin\Struct\QueueQuery(array($field), 100, 10);

        $action = new \Zimbra\Admin\Struct\MailQueueAction($query, QueueAction::HOLD(), QueueActionBy::QUERY());
        $queue = new \Zimbra\Admin\Struct\MailQueueWithAction($action, 'name');

        $server = new \Zimbra\Admin\Struct\ServerWithQueueAction($queue, 'name');
        $this->assertSame('name', $server->name());
        $this->assertSame($queue, $server->queue());

        $server->name('name')
               ->queue($queue);
        $this->assertSame('name', $server->name());
        $this->assertSame($queue, $server->queue());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<server name="name">'
                .'<queue name="name">'
                    .'<action op="hold" by="query">'
                        .'<query limit="100" offset="10">'
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
                            'offset' => 10,
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

    public function testSimpleElement()
    {
        $el = new \Zimbra\Admin\Struct\SimpleElement;

        $xml = '<?xml version="1.0"?>'."\n"
            .'<any />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $el);

        $array = array(
            'any' => array(),
        );
        $this->assertEquals($array, $el->toArray());
    }

    public function testStat()
    {
        $stat = new \Zimbra\Admin\Struct\Stat('name', 'description');
        $this->assertSame('name', $stat->name());
        $this->assertSame('description', $stat->description());

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

    public function testStatsSpec()
    {
        $stat = new \Zimbra\Struct\NamedElement('name');
        $values = new \Zimbra\Admin\Struct\StatsValueWrapper(array($stat));

        $stats = new \Zimbra\Admin\Struct\StatsSpec($values, 'n', 'l');
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

    public function testStatsValueWrapper()
    {
        $stat1 = new \Zimbra\Struct\NamedElement('name1');
        $stat2 = new \Zimbra\Struct\NamedElement('name2');

        $wrapper = new \Zimbra\Admin\Struct\StatsValueWrapper(array($stat1));
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

    public function testSyncGalAccountDataSourceSpec()
    {
        $ds = new \Zimbra\Admin\Struct\SyncGalAccountDataSourceSpec(DataSourceBy::ID(), 'v', false, true);
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
            .'<datasource by="name" fullSync="true" reset="false">value</datasource>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $ds);

        $array = array(
            'datasource' => array(
                'by' => 'name',
                'fullSync' => true,
                'reset' => false,
                '_' => 'value',
            ),
        );
        $this->assertEquals($array, $ds->toArray());
    }

    public function testSyncGalAccountSpec()
    {
        $ds1 = new \Zimbra\Admin\Struct\SyncGalAccountDataSourceSpec(DataSourceBy::ID(), 'value1', true, false);
        $ds2 = new \Zimbra\Admin\Struct\SyncGalAccountDataSourceSpec(DataSourceBy::NAME(), 'value2', false, true);

        $sync = new \Zimbra\Admin\Struct\SyncGalAccountSpec('id', array($ds1));
        $this->assertSame('id', $sync->id());
        $this->assertSame(array($ds1), $sync->dataSource()->all());

        $sync->id('id')
             ->addDataSource($ds2);
        $this->assertSame('id', $sync->id());
        $this->assertSame(array($ds1, $ds2), $sync->dataSource()->all());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<account id="id">'
                .'<datasource by="id" fullSync="true" reset="false">value1</datasource>'
                .'<datasource by="name" fullSync="false" reset="true">value2</datasource>'
            .'</account>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $sync);

        $array = array(
            'account' => array(
                'id' => 'id',
                'datasource' => array(
                    array(
                        'by' => 'id',
                        'fullSync' => true,
                        'reset' => false,
                        '_' => 'value1',
                    ),
                    array(
                        'by' => 'name',
                        'fullSync' => false,
                        'reset' => true,
                        '_' => 'value2',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $sync->toArray());
    }

    public function testTargetWithType()
    {
        $target = new \Zimbra\Admin\Struct\TargetWithType('t', 'v');
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
        $attr = new \Zimbra\Admin\Struct\TimeAttr('time');
        $this->assertSame('time', $attr->time());

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

    public function testTzFixupRuleMatchDate()
    {
        $date = new \Zimbra\Admin\Struct\TzFixupRuleMatchDate(12, 30);
        $this->assertSame(12, $date->mon());
        $this->assertSame(30, $date->mday());

        $date->mon(10)
             ->mday(10);
        $this->assertSame(10, $date->mon());
        $this->assertSame(10, $date->mday());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<date mon="10" mday="10" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $date);

        $array = array(
            'date' => array(
                'mon' => 10,
                'mday' => 10,
            ),
        );
        $this->assertEquals($array, $date->toArray());
    }

    public function testTzFixupRuleMatchDates()
    {
        $standard = new \Zimbra\Admin\Struct\TzFixupRuleMatchDate(10, 10);
        $daylight = new \Zimbra\Admin\Struct\TzFixupRuleMatchDate(12, 12);

        $dates = new \Zimbra\Admin\Struct\TzFixupRuleMatchDates($standard, $daylight, 100, 100);
        $this->assertSame($standard, $dates->standard());
        $this->assertSame($daylight, $dates->daylight());
        $this->assertSame(100, $dates->stdoff());
        $this->assertSame(100, $dates->dayoff());

        $dates->standard($standard)
              ->daylight($daylight)
              ->stdoff(10)
              ->dayoff(10);
        $this->assertSame($standard, $dates->standard());
        $this->assertSame($daylight, $dates->daylight());
        $this->assertSame(10, $dates->stdoff());
        $this->assertSame(10, $dates->dayoff());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<dates stdoff="10" dayoff="10">'
                .'<standard mon="10" mday="10" />'
                .'<daylight mon="12" mday="12" />'
            .'</dates>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $dates);

        $array = array(
            'dates' => array(
                'stdoff' => 10,
                'dayoff' => 10,
                'standard' => array(
                    'mon' => 10,
                    'mday' => 10,
                ),
                'daylight' => array(
                    'mon' => 12,
                    'mday' => 12,
                ),
            ),
        );
        $this->assertEquals($array, $dates->toArray());
    }

    public function testTzFixupRuleMatchRule()
    {
        $rule = new \Zimbra\Admin\Struct\TzFixupRuleMatchRule(2, 3, 4);
        $this->assertSame(2, $rule->mon());
        $this->assertSame(3, $rule->week());
        $this->assertSame(4, $rule->wkday());

        $rule->mon(10)
             ->week(4)
             ->wkday(6);
        $this->assertSame(10, $rule->mon());
        $this->assertSame(4, $rule->week());
        $this->assertSame(6, $rule->wkday());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<rule mon="10" week="4" wkday="6" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $rule);

        $array = array(
            'rule' => array(
                'mon' => 10,
                'week' => 4,
                'wkday' => 6,
            ),
        );
        $this->assertEquals($array, $rule->toArray());
    }

    public function testTzFixupRuleMatchRules()
    {
        $standard = new \Zimbra\Admin\Struct\TzFixupRuleMatchRule(10, 2, 3);
        $daylight = new \Zimbra\Admin\Struct\TzFixupRuleMatchRule(3, 2, 4);

        $rules = new \Zimbra\Admin\Struct\TzFixupRuleMatchRules($standard, $daylight, 100, 100);
        $this->assertSame($standard, $rules->standard());
        $this->assertSame($daylight, $rules->daylight());
        $this->assertSame(100, $rules->stdoff());
        $this->assertSame(100, $rules->dayoff());

        $rules->standard($standard)
              ->daylight($daylight)
              ->stdoff(10)
              ->dayoff(10);
        $this->assertSame($standard, $rules->standard());
        $this->assertSame($daylight, $rules->daylight());
        $this->assertSame(10, $rules->stdoff());
        $this->assertSame(10, $rules->dayoff());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<rules stdoff="10" dayoff="10">'
                .'<standard mon="10" week="2" wkday="3" />'
                .'<daylight mon="3" week="2" wkday="4" />'
            .'</rules>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $rules);

        $array = array(
            'rules' => array(
                'stdoff' => 10,
                'dayoff' => 10,
                'standard' => array(
                    'mon' => 10,
                    'week' => 2,
                    'wkday' => 3,
                ),
                'daylight' => array(
                    'mon' => 3,
                    'week' => 2,
                    'wkday' => 4,
                ),
            ),
        );
        $this->assertEquals($array, $rules->toArray());
    }

    public function testTzFixupRuleMatch()
    {
        $any = new \Zimbra\Admin\Struct\SimpleElement;
        $tzid = new \Zimbra\Struct\Id('id');
        $nonDst = new \Zimbra\Admin\Struct\Offset(100);
        $standard = new \Zimbra\Admin\Struct\TzFixupRuleMatchRule(12, 2, 3);
        $daylight = new \Zimbra\Admin\Struct\TzFixupRuleMatchRule(3, 2, 4);
        $rules = new \Zimbra\Admin\Struct\TzFixupRuleMatchRules($standard, $daylight, 10, 10);
        $standard = new \Zimbra\Admin\Struct\TzFixupRuleMatchDate(10, 10);
        $daylight = new \Zimbra\Admin\Struct\TzFixupRuleMatchDate(12, 12);
        $dates = new \Zimbra\Admin\Struct\TzFixupRuleMatchDates($standard, $daylight, 10, 10);

        $match = new \Zimbra\Admin\Struct\TzFixupRuleMatch($any, $tzid, $nonDst, $rules, $dates);
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
                .'<rules stdoff="10" dayoff="10">'
                    .'<standard mon="12" week="2" wkday="3" />'
                    .'<daylight mon="3" week="2" wkday="4" />'
                .'</rules>'
                .'<dates stdoff="10" dayoff="10">'
                    .'<standard mon="10" mday="10" />'
                    .'<daylight mon="12" mday="12" />'
                .'</dates>'
            .'</match>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $match);

        $array = array(
            'match' => array(
                'any' => array(),
                'tzid' => array('id' => 'id'),
                'nonDst' => array('offset' => 100),
                'rules' => array(
                    'stdoff' => 10,
                    'dayoff' => 10,
                    'standard' => array(
                        'mon' => 12,
                        'week' => 2,
                        'wkday' => 3,
                    ),
                    'daylight' => array(
                        'mon' => 3,
                        'week' => 2,
                        'wkday' => 4,
                    ),
                ),
                'dates' => array(
                    'stdoff' => 10,
                    'dayoff' => 10,
                    'standard' => array(
                        'mon' => 10,
                        'mday' => 10,
                    ),
                    'daylight' => array(
                        'mon' => 12,
                        'mday' => 12,
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $match->toArray());
    }

    public function testTzFixupRule()
    {
        $any = new \Zimbra\Admin\Struct\SimpleElement;
        $tzid = new \Zimbra\Struct\Id('id');
        $nonDst = new \Zimbra\Admin\Struct\Offset(100);
        $standard = new \Zimbra\Admin\Struct\TzFixupRuleMatchRule(12, 2, 3);
        $daylight = new \Zimbra\Admin\Struct\TzFixupRuleMatchRule(3, 2, 4);
        $rules = new \Zimbra\Admin\Struct\TzFixupRuleMatchRules($standard, $daylight, 10, 10);
        $standard = new \Zimbra\Admin\Struct\TzFixupRuleMatchDate(10, 10);
        $daylight = new \Zimbra\Admin\Struct\TzFixupRuleMatchDate(12, 12);
        $dates = new \Zimbra\Admin\Struct\TzFixupRuleMatchDates($standard, $daylight, 10, 10);
        $match = new \Zimbra\Admin\Struct\TzFixupRuleMatch($any, $tzid, $nonDst, $rules, $dates);

        $wellKnownTz = new \Zimbra\Struct\Id('id');
        $standard = new \Zimbra\Struct\TzOnsetInfo(12, 2, 3, 4);
        $daylight = new \Zimbra\Struct\TzOnsetInfo(4, 3, 2, 10);
        $tz = new \Zimbra\Admin\Struct\CalTZInfo('id', 10, 10, $standard, $daylight, 'stdname', 'dayname');
        $replace = new \Zimbra\Admin\Struct\TzReplaceInfo($wellKnownTz, $tz);
        
        $touch = new \Zimbra\Admin\Struct\SimpleElement;
        $fixupRule = new \Zimbra\Admin\Struct\TzFixupRule($match, $touch, $replace);
        $this->assertSame($match, $fixupRule->match());
        $this->assertSame($touch, $fixupRule->touch());
        $this->assertSame($replace, $fixupRule->replace());

        $fixupRule->match($match)
                  ->touch($touch)
                  ->replace($replace);
        $this->assertSame($match, $fixupRule->match());
        $this->assertSame($touch, $fixupRule->touch());
        $this->assertSame($replace, $fixupRule->replace());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<fixupRule>'
                .'<match>'
                    .'<any />'
                    .'<tzid id="id" />'
                    .'<nonDst offset="100" />'
                    .'<rules stdoff="10" dayoff="10">'
                        .'<standard mon="12" week="2" wkday="3" />'
                        .'<daylight mon="3" week="2" wkday="4" />'
                    .'</rules>'
                    .'<dates stdoff="10" dayoff="10">'
                        .'<standard mon="10" mday="10" />'
                        .'<daylight mon="12" mday="12" />'
                    .'</dates>'
                .'</match>'
                .'<touch />'
                .'<replace>'
                    .'<wellKnownTz id="id" />'
                    .'<tz id="id" stdoff="10" dayoff="10" stdname="stdname" dayname="dayname">'
                        .'<standard mon="12" hour="2" min="3" sec="4" />'
                        .'<daylight mon="4" hour="3" min="2" sec="10" />'
                    .'</tz>'
                .'</replace>'
            .'</fixupRule>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $fixupRule);

        $array = array(
            'fixupRule' => array(
                'match' => array(
                    'any' => array(),
                    'tzid' => array('id' => 'id'),
                    'nonDst' => array('offset' => 100),
                    'rules' => array(
                        'stdoff' => 10,
                        'dayoff' => 10,
                        'standard' => array(
                            'mon' => 12,
                            'week' => 2,
                            'wkday' => 3,
                        ),
                        'daylight' => array(
                            'mon' => 3,
                            'week' => 2,
                            'wkday' => 4,
                        ),
                    ),
                    'dates' => array(
                        'stdoff' => 10,
                        'dayoff' => 10,
                        'standard' => array(
                            'mon' => 10,
                            'mday' => 10,
                        ),
                        'daylight' => array(
                            'mon' => 12,
                            'mday' => 12,
                        ),
                    ),
                ),
                'touch' => array(),
                'replace' => array(
                    'wellKnownTz' => array('id' => 'id'),
                    'tz' => array(
                        'id' => 'id',
                        'stdoff' => 10,
                        'dayoff' => 10,
                        'stdname' => 'stdname',
                        'dayname' => 'dayname',
                        'standard' => array(
                            'mon' => 12,
                            'hour' => 2,
                            'min' => 3,
                            'sec' => 4,
                        ),
                        'daylight' => array(
                            'mon' => 4,
                            'hour' => 3,
                            'min' => 2,
                            'sec' => 10,
                        ),
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $fixupRule->toArray());
    }

    public function testTzFixup()
    {
        $any = new \Zimbra\Admin\Struct\SimpleElement;
        $tzid = new \Zimbra\Struct\Id('id');
        $nonDst = new \Zimbra\Admin\Struct\Offset(100);
        $standard = new \Zimbra\Admin\Struct\TzFixupRuleMatchRule(12, 2, 3);
        $daylight = new \Zimbra\Admin\Struct\TzFixupRuleMatchRule(3, 2, 4);
        $rules = new \Zimbra\Admin\Struct\TzFixupRuleMatchRules($standard, $daylight, 10, 10);
        $standard = new \Zimbra\Admin\Struct\TzFixupRuleMatchDate(10, 10);
        $daylight = new \Zimbra\Admin\Struct\TzFixupRuleMatchDate(12, 12);
        $dates = new \Zimbra\Admin\Struct\TzFixupRuleMatchDates($standard, $daylight, 10, 10);
        $match = new \Zimbra\Admin\Struct\TzFixupRuleMatch($any, $tzid, $nonDst, $rules, $dates);

        $wellKnownTz = new \Zimbra\Struct\Id('id');
        $standard = new \Zimbra\Struct\TzOnsetInfo(12, 2, 3, 4);
        $daylight = new \Zimbra\Struct\TzOnsetInfo(4, 3, 2, 10);
        $tz = new \Zimbra\Admin\Struct\CalTzInfo('id', 10, 10, $standard, $daylight, 'stdname', 'dayname');
        $replace = new \Zimbra\Admin\Struct\TzReplaceInfo($wellKnownTz, $tz);
        
        $touch = new \Zimbra\Admin\Struct\SimpleElement;
        $fixupRule = new \Zimbra\Admin\Struct\TzFixupRule($match, $touch, $replace);

        $tzfixup = new \Zimbra\Admin\Struct\TzFixup(array($fixupRule));
        $this->assertSame(array($fixupRule), $tzfixup->fixupRule()->all());
        $tzfixup->addFixupRule($fixupRule);
        $this->assertSame(array($fixupRule, $fixupRule), $tzfixup->fixupRule()->all());
        $tzfixup->fixupRule()->remove(1);


        $xml = '<?xml version="1.0"?>'."\n"
            .'<tzfixup>'
                .'<fixupRule>'
                    .'<match>'
                        .'<any />'
                        .'<tzid id="id" />'
                        .'<nonDst offset="100" />'
                        .'<rules stdoff="10" dayoff="10">'
                            .'<standard mon="12" week="2" wkday="3" />'
                            .'<daylight mon="3" week="2" wkday="4" />'
                        .'</rules>'
                        .'<dates stdoff="10" dayoff="10">'
                            .'<standard mon="10" mday="10" />'
                            .'<daylight mon="12" mday="12" />'
                        .'</dates>'
                    .'</match>'
                    .'<touch />'
                    .'<replace>'
                        .'<wellKnownTz id="id" />'
                        .'<tz id="id" stdoff="10" dayoff="10" stdname="stdname" dayname="dayname">'
                            .'<standard mon="12" hour="2" min="3" sec="4" />'
                            .'<daylight mon="4" hour="3" min="2" sec="10" />'
                        .'</tz>'
                    .'</replace>'
                .'</fixupRule>'
            .'</tzfixup>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $tzfixup);

        $array = array(
            'tzfixup' => array(
                'fixupRule' => array(
                    array(
                        'match' => array(
                            'any' => array(),
                            'tzid' => array('id' => 'id'),
                            'nonDst' => array('offset' => 100),
                            'rules' => array(
                                'stdoff' => 10,
                                'dayoff' => 10,
                                'standard' => array(
                                    'mon' => 12,
                                    'week' => 2,
                                    'wkday' => 3,
                                ),
                                'daylight' => array(
                                    'mon' => 3,
                                    'week' => 2,
                                    'wkday' => 4,
                                ),
                            ),
                            'dates' => array(
                                'stdoff' => 10,
                                'dayoff' => 10,
                                'standard' => array(
                                    'mon' => 10,
                                    'mday' => 10,
                                ),
                                'daylight' => array(
                                    'mon' => 12,
                                    'mday' => 12,
                                ),
                            ),
                        ),
                        'touch' => array(),
                        'replace' => array(
                            'wellKnownTz' => array('id' => 'id'),
                            'tz' => array(
                                'id' => 'id',
                                'stdoff' => 10,
                                'dayoff' => 10,
                                'stdname' => 'stdname',
                                'dayname' => 'dayname',
                                'standard' => array(
                                    'mon' => 12,
                                    'hour' => 2,
                                    'min' => 3,
                                    'sec' => 4,
                                ),
                                'daylight' => array(
                                    'mon' => 4,
                                    'hour' => 3,
                                    'min' => 2,
                                    'sec' => 10,
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $tzfixup->toArray());
    }

    public function testTzReplaceInfo()
    {
        $wellKnownTz = new \Zimbra\Struct\Id('id');
        $standard = new \Zimbra\Struct\TzOnsetInfo(12, 2, 3, 4);
        $daylight = new \Zimbra\Struct\TzOnsetInfo(4, 3, 2, 10);
        $tz = new \Zimbra\Admin\Struct\CalTzInfo('id', 10, 10, $standard, $daylight, 'stdname', 'dayname');

        $replace = new \Zimbra\Admin\Struct\TzReplaceInfo($wellKnownTz, $tz);
        $this->assertSame($wellKnownTz, $replace->wellKnownTz());
        $this->assertSame($tz, $replace->tz());

        $replace->wellKnownTz($wellKnownTz)
                ->tz($tz);
        $this->assertSame($wellKnownTz, $replace->wellKnownTz());
        $this->assertSame($tz, $replace->tz());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<replace>'
                .'<wellKnownTz id="id" />'
                .'<tz id="id" stdoff="10" dayoff="10" stdname="stdname" dayname="dayname">'
                    .'<standard mon="12" hour="2" min="3" sec="4" />'
                    .'<daylight mon="4" hour="3" min="2" sec="10" />'
                .'</tz>'
            .'</replace>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $replace);

        $array = array(
            'replace' => array(
                'wellKnownTz' => array('id' => 'id'),
                'tz' => array(
                    'id' => 'id',
                    'stdoff' => 10,
                    'dayoff' => 10,
                    'stdname' => 'stdname',
                    'dayname' => 'dayname',
                    'standard' => array(
                        'mon' => 12,
                        'hour' => 2,
                        'min' => 3,
                        'sec' => 4,
                    ),
                    'daylight' => array(
                        'mon' => 4,
                        'hour' => 3,
                        'min' => 2,
                        'sec' => 10,
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $replace->toArray());
    }

    public function testUcServiceSelector()
    {
        $ucs = new \Zimbra\Admin\Struct\UcServiceSelector(UcServiceBy::ID(), 'uc');
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

    public function testValueAttrib()
    {
        $attr = new \Zimbra\Admin\Struct\ValueAttrib('value');
        $this->assertSame('value', $attr->value());

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

    public function testVolumeInfo()
    {
        $volume = new \Zimbra\Admin\Struct\VolumeInfo(10, 2, 3, 4, 5, 6, 7, 'n', 'r', false, true);
        $this->assertSame(10, $volume->id());
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
               ->type(10)
               ->compressionThreshold(5)
               ->mgbits(4)
               ->mbits(3)
               ->fgbits(2)
               ->fbits(10)
               ->name('name')
               ->rootpath('rootpath')
               ->compressBlobs(true)
               ->isCurrent(false);
        $this->assertSame(7, $volume->id());
        $this->assertSame(10, $volume->type());
        $this->assertSame(5, $volume->compressionThreshold());
        $this->assertSame(4, $volume->mgbits());
        $this->assertSame(3, $volume->mbits());
        $this->assertSame(2, $volume->fgbits());
        $this->assertSame(10, $volume->fbits());
        $this->assertSame('name', $volume->name());
        $this->assertSame('rootpath', $volume->rootpath());
        $this->assertTrue($volume->compressBlobs());
        $this->assertFalse($volume->isCurrent());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<volume '
                .'id="7" '
                .'type="10" '
                .'compressionThreshold="5" '
                .'mgbits="4" '
                .'mbits="3" '
                .'fgbits="2" '
                .'fbits="10" '
                .'name="name" '
                .'rootpath="rootpath" '
                .'compressBlobs="true" '
                .'isCurrent="false" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $volume);

        $array = array(
            'volume' => array(
                'id' => 7,
                'type' => 10,
                'compressionThreshold' => 5,
                'mgbits' => 4,
                'mbits' => 3,
                'fgbits' => 2,
                'fbits' => 10,
                'name' => 'name',
                'rootpath' => 'rootpath',
                'compressBlobs' => true,
                'isCurrent' => false,
            ),
        );
        $this->assertEquals($array, $volume->toArray());
    }

    public function testWaitSetAddSpec()
    {
        $waitSet = new \Zimbra\Admin\Struct\WaitSetAddSpec('name', 'id', 'token', array(InterestType::FOLDERS()));
        $this->assertSame('name', $waitSet->name());
        $this->assertSame('id', $waitSet->id());
        $this->assertSame('token', $waitSet->token());
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

    public function testWaitSetSpec()
    {
        $a = new \Zimbra\Admin\Struct\WaitSetAddSpec('name', 'id', 'token', array(InterestType::FOLDERS(), InterestType::MESSAGES()));
        $add = new \Zimbra\Admin\Struct\WaitSetSpec(array($a));
        $this->assertSame(array($a), $add->a()->all());
        $add->addWaitSet($a);
        $this->assertSame(array($a, $a), $add->a()->all());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<add>'
                .'<a name="name" id="id" token="token" types="f,m" />'
                .'<a name="name" id="id" token="token" types="f,m" />'
            .'</add>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $add);

        $array = array(
            'add' => array(
                'a' => array(
                    array(
                        'name' => 'name',
                        'id' => 'id',
                        'token' => 'token',
                        'types' => 'f,m',
                    ),
                    array(
                        'name' => 'name',
                        'id' => 'id',
                        'token' => 'token',
                        'types' => 'f,m',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $add->toArray());
    }

    public function testWaitSetId()
    {
        $a = new \Zimbra\Struct\Id('id');
        $remove = new \Zimbra\Admin\Struct\WaitSetId(array($a));
        $this->assertSame(array($a), $remove->a()->all());
        $remove->addId($a);
        $this->assertSame(array($a, $a), $remove->a()->all());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<remove>'
                .'<a id="id" />'
                .'<a id="id" />'
            .'</remove>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $remove);

        $array = array(
            'remove' => array(
                'a' => array(
                    array(
                        'id' => 'id',
                    ),
                    array(
                        'id' => 'id',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $remove->toArray());
    }

    public function testXmppComponentSelector()
    {
        $xmpp = new \Zimbra\Admin\Struct\XmppComponentSelector(XmppBy::ID(), 'xmpp');
        $this->assertTrue($xmpp->by()->is('id'));
        $this->assertSame('xmpp', $xmpp->value());

        $xmpp->by(XmppBy::NAME())
               ->value('value');
        $this->assertTrue($xmpp->by()->is('name'));
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
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');
        $domain = new \Zimbra\Admin\Struct\DomainSelector(DomainBy::NAME(), 'domain');
        $server = new \Zimbra\Admin\Struct\ServerSelector(ServerBy::NAME(), 'server');

        $xmpp = new \Zimbra\Admin\Struct\XmppComponentSpec('name', $domain, $server);
        $this->assertSame('name', $xmpp->name());
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
        $acl = new \Zimbra\Admin\Struct\ZimletAcl('cos', AclType::DENY());
        $this->assertSame('cos', $acl->cos());
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
        $acl = new \Zimbra\Admin\Struct\ZimletAcl('cos', AclType::DENY());
        $status = new \Zimbra\Admin\Struct\ValueAttrib('disabled');
        $priority = new \Zimbra\Admin\Struct\IntegerValueAttrib(10);

        $zimlet = new \Zimbra\Admin\Struct\ZimletAclStatusPri('name', $acl, $status, $priority);
        $this->assertSame('name', $zimlet->name());
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
                .'<priority value="10" />'
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
                    'value' => 10,
                ),
            ),
        );
        $this->assertEquals($array, $zimlet->toArray());
    }
}
