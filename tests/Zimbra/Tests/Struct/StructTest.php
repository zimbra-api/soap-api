<?php

namespace Zimbra\Tests\Struct;

use Zimbra\Tests\ZimbraTestCase;

use Zimbra\Enum\AccountBy;

/**
 * Testcase class for soap struct.
 */
class StructTest extends ZimbraTestCase
{
    public function testAccountSelector()
    {
        $acc = new \Zimbra\Struct\AccountSelector(AccountBy::ID(), 'value');
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

    public function testAttributeName()
    {
        $a = new \Zimbra\Struct\AttributeName('attribute-name');
        $this->assertSame('attribute-name', $a->n());

        $a->n('attribute-name');
        $this->assertSame('attribute-name', $a->n());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<a n="attribute-name" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $a);

        $array = array(
            'a' => array(
                'n' => 'attribute-name',
            ),
        );
        $this->assertEquals($array, $a->toArray());
    }

    public function testBase()
    {
        $base = $this->getMockForAbstractClass('Zimbra\Struct\Base');
        $base->value('value');
        $this->assertSame('value', $base->value());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<name>value</name>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $base);

        $array = array(
            'name' => array(
                '_' => 'value',
            ),
        );
        $this->assertEquals($array, $base->toArray());

        $base = $this->getMockForAbstractClass('Zimbra\Struct\Base');
        $base->property('name', 'value');
        $this->assertSame('value', $base->property('name'));

        $child = $this->getMockForAbstractClass('Zimbra\Struct\Base');
        $child->value('value');

        $base->child('child', $child);
        $this->assertSame($child, $base->child('child'));

        $xml = '<?xml version="1.0"?>'."\n"
            .'<name name="value">'
                .'<child>value</child>'
            .'</name>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $base);

        $array = array(
            'name' => array(
                'name' => 'value',
                'child' => array(
                    '_' => 'value',
                ),
            ),
        );
        $this->assertEquals($array, $base->toArray());
    }

    public function testCursorInfo()
    {
        $cursor = new \Zimbra\Struct\CursorInfo('id','sortVal', 'endSortVal', false);
        $this->assertSame('id', $cursor->id());
        $this->assertSame('sortVal', $cursor->sortVal());
        $this->assertSame('endSortVal', $cursor->endSortVal());
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
            .'<cursor id="id" sortVal="sortVal" endSortVal="endSortVal" includeOffset="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $cursor);

        $array = array(
            'cursor' => array(
                'id' => 'id',
                'sortVal' => 'sortVal',
                'endSortVal' => 'endSortVal',
                'includeOffset' => true,
            ),
        );
        $this->assertEquals($array, $cursor->toArray());
    }

    public function testGranteeChooser()
    {
        $grantee = new \Zimbra\Struct\GranteeChooser('type', 'id', 'name');
        $this->assertSame('type', $grantee->type());
        $this->assertSame('id', $grantee->id());
        $this->assertSame('name', $grantee->name());

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

    public function testId()
    {
        $id = new \Zimbra\Struct\Id('id');
        $this->assertSame('id', $id->id());

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

    public function testKeyValuePair()
    {
        $kpv = new \Zimbra\Struct\KeyValuePair('key', 'value');
        $this->assertSame('key', $kpv->key());
        $this->assertSame('value', $kpv->value());

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

    public function testNamedElement()
    {
        $named = new \Zimbra\Struct\NamedElement('n');
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
        $named = new \Zimbra\Struct\NamedValue('n');
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

    public function testOpValue()
    {
        $op = new \Zimbra\Struct\OpValue('-', 'value');
        $this->assertSame('-', $op->op());
        $this->assertSame('value', $op->value());

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

    public function testTzOnsetInfo()
    {
        $tzo = new \Zimbra\Struct\TzOnsetInfo(4, 3, 2, 1, 7, -1, 5);
        $this->assertSame(4, $tzo->mon());
        $this->assertSame(3, $tzo->hour());
        $this->assertSame(2, $tzo->min());
        $this->assertSame(1, $tzo->sec());
        $this->assertSame(7, $tzo->mday());
        $this->assertSame(-1, $tzo->week());
        $this->assertSame(5, $tzo->wkday());

        $tzo->mon(10)
            ->hour(2)
            ->min(3)
            ->sec(4)
            ->mday(5)
            ->week(6)
            ->wkday(7);
        $this->assertSame(10, $tzo->mon());
        $this->assertSame(2, $tzo->hour());
        $this->assertSame(3, $tzo->min());
        $this->assertSame(4, $tzo->sec());
        $this->assertSame(5, $tzo->mday());
        $this->assertSame(-1, $tzo->week());
        $this->assertSame(7, $tzo->wkday());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<info mon="10" hour="2" min="3" sec="4" mday="5" week="-1" wkday="7" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $tzo);
        $array = array(
            'info' => array(
                'mon' => 10,
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
}
