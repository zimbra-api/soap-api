<?php

namespace Zimbra\Tests\Struct;

use Zimbra\Tests\ZimbraTestCase;

use Zimbra\Enum\AccountBy;

/**
 * Testcase class for soap struct.
 */
class StructTest extends ZimbraTestCase
{
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
        $this->invokeMethod($base, 'property', array('name', 'value'));
        $this->assertSame('value', $this->invokeMethod($base, 'property', array('name')));

        $child = $this->getMockForAbstractClass('Zimbra\Struct\Base');
        $child->value('value');

        $this->invokeMethod($base, 'child', array('child', $child));
        $this->assertSame($child, $this->invokeMethod($base, 'child', array('child')));

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
}