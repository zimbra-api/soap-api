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
        $value = ZimbraTestCase::randomName();
        $acc = new \Zimbra\Struct\AccountSelector(AccountBy::ID(), $value);
        $this->assertTrue($acc->getBy()->is('id'));
        $this->assertSame($value, $acc->getValue());

        $value = ZimbraTestCase::randomName();
        $acc->setValue($value)
            ->setBy(AccountBy::ADMIN_NAME());
        $this->assertTrue($acc->getBy()->is('adminName'));
        $this->assertSame($value, $acc->getValue());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<account by="adminName">' . $value . '</account>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $acc);

        $array = array(
            'account' => array(
                'by' => 'adminName',
                '_content' => $value,
            ),
        );
        $this->assertEquals($array, $acc->toArray());
    }

    public function testAttributeName()
    {
        $name = ZimbraTestCase::randomName();
        $a = new \Zimbra\Struct\AttributeName($name);
        $this->assertSame($name, $a->getName());

        $name = ZimbraTestCase::randomName();
        $a->setName($name);
        $this->assertSame($name, $a->getName());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<a n="' . $name . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $a);

        $array = array(
            'a' => array(
                'n' => $name,
            ),
        );
        $this->assertEquals($array, $a->toArray());
    }

    public function testBase()
    {
        $value = ZimbraTestCase::randomName();
        $name = ZimbraTestCase::randomName();

        $base = $this->getMockForAbstractClass('Zimbra\Struct\Base');
        $base->setValue($value);
        $this->assertSame($value, $base->getValue());
		$className = $base->className();

        $xml = '<?xml version="1.0"?>'."\n"
            .'<' . $className . '>' . $value . '</' . $className . '>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $base);

        $array = array(
            $className => array(
                '_content' => $value,
            ),
        );
        $this->assertEquals($array, $base->toArray());

        $base = $this->getMockForAbstractClass('Zimbra\Struct\Base');
        $base->setProperty($name, $value);
        $this->assertSame($value, $base->getProperty($name));

        $child = $this->getMockForAbstractClass('Zimbra\Struct\Base');
        $child->setValue($value);

        $base->setChild('child', $child);
        $this->assertSame($child, $base->getChild('child'));

        $xml = '<?xml version="1.0"?>'."\n"
            .'<' . $className . ' ' . $name . '="' . $value . '">'
                .'<child>' . $value . '</child>'
            .'</' . $className . '>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $base);

        $array = array(
            $className => array(
                $name => $value,
                'child' => array(
                    '_content' => $value,
                ),
            ),
        );
        $this->assertEquals($array, $base->toArray());
    }

    public function testCursorInfo()
    {
        $id = ZimbraTestCase::randomName();
        $sortVal = ZimbraTestCase::randomName();
        $endSortVal = ZimbraTestCase::randomName();

        $cursor = new \Zimbra\Struct\CursorInfo($id,$sortVal, $endSortVal, false);
        $this->assertSame($id, $cursor->getId());
        $this->assertSame($sortVal, $cursor->getSortVal());
        $this->assertSame($endSortVal, $cursor->getEndSortVal());
        $this->assertFalse($cursor->getIncludeOffset());

        $cursor->setId($id)
               ->setSortVal($sortVal)
               ->setEndSortVal($endSortVal)
               ->setIncludeOffset(true);
        $this->assertSame($id, $cursor->getId());
        $this->assertSame($sortVal, $cursor->getSortVal());
        $this->assertSame($endSortVal, $cursor->getEndSortVal());
        $this->assertTrue($cursor->getIncludeOffset());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<cursor id="' . $id . '" sortVal="' . $sortVal . '" endSortVal="' . $endSortVal . '" includeOffset="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $cursor);

        $array = array(
            'cursor' => array(
                'id' => $id,
                'sortVal' => $sortVal,
                'endSortVal' => $endSortVal,
                'includeOffset' => true,
            ),
        );
        $this->assertEquals($array, $cursor->toArray());
    }

    public function testGranteeChooser()
    {
        $type = ZimbraTestCase::randomName();
        $id = ZimbraTestCase::randomName();
        $name = ZimbraTestCase::randomName();

        $grantee = new \Zimbra\Struct\GranteeChooser($type, $id, $name);
        $this->assertSame($type, $grantee->getType());
        $this->assertSame($id, $grantee->getId());
        $this->assertSame($name, $grantee->getName());

        $grantee->setType($type)
                ->setId($id)
                ->setName($name);
        $this->assertSame($type, $grantee->getType());
        $this->assertSame($id, $grantee->getId());
        $this->assertSame($name, $grantee->getName());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<grantee type="' . $type . '" id="' . $id . '" name="' . $name . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $grantee);

        $array = array(
            'grantee' => array(
                'type' => $type,
                'id' => $id,
                'name' => $name,
            ),
        );
        $this->assertEquals($array, $grantee->toArray());
    }

    public function testId()
    {
        $value = ZimbraTestCase::randomName();

        $id = new \Zimbra\Struct\Id($value);
        $this->assertSame($value, $id->getId());

        $id->setId($value);
        $this->assertSame($value, $id->getId());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<id id="' . $value . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $id);

        $array = array(
            'id' => array(
                'id' => $value,
            ),
        );
        $this->assertEquals($array, $id->toArray());
    }

    public function testKeyValuePair()
    {
        $key = ZimbraTestCase::randomName();
        $value = ZimbraTestCase::randomName();

        $kpv = new \Zimbra\Struct\KeyValuePair($key, $value);
        $this->assertSame($key, $kpv->getKey());
        $this->assertSame($value, $kpv->getValue());

        $kpv->setKey($key)
            ->setValue($value);
        $this->assertSame($key, $kpv->getKey());
        $this->assertSame($value, $kpv->getValue());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<a n="' . $key . '">' . $value . '</a>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $kpv);

        $array = array(
            'a' => array(
                'n' => $key,
                '_content' => $value,
            ),
        );
        $this->assertEquals($array, $kpv->toArray());
    }

    public function testNamedElement()
    {
        $name = ZimbraTestCase::randomName();
        $named = new \Zimbra\Struct\NamedElement($name);
        $this->assertSame($name, $named->getName());

        $named->setName($name);
        $this->assertSame($name, $named->getName());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<named name="' . $name . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $named);

        $array = array(
            'named' => array(
                'name' => $name,
            ),
        );
        $this->assertEquals($array, $named->toArray());
    }

    public function testNamedValue()
    {
        $name = ZimbraTestCase::randomName();
        $value = ZimbraTestCase::randomName();

        $named = new \Zimbra\Struct\NamedValue($name, $value);
        $this->assertSame($name, $named->getName());
        $this->assertSame($value, $named->getValue());

        $named->setName($name)
              ->setValue($value);
        $this->assertSame($name, $named->getName());
        $this->assertSame($value, $named->getValue());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<named name="' . $name . '">' . $value . '</named>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $named);

        $array = array(
            'named' => array(
                'name' => $name,
                '_content' => $value,
            ),
        );
        $this->assertEquals($array, $named->toArray());
    }

    public function testOpValue()
    {
        $value = ZimbraTestCase::randomName();

        $op = new \Zimbra\Struct\OpValue('-', $value);
        $this->assertSame('-', $op->getOp());
        $this->assertSame($value, $op->getValue());

        $op->setOp('+')
           ->setValue($value);
        $this->assertSame('+', $op->getOp());
        $this->assertSame($value, $op->getValue());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<addr op="+">' . $value . '</addr>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $op);

        $array = array(
            'addr' => array(
                'op' => '+',
                '_content' => $value,
            ),
        );
        $this->assertEquals($array, $op->toArray());
    }

    public function testTzOnsetInfo()
    {
        $mon = mt_rand(1, 12);
        $hour = mt_rand(0, 23);
        $min = mt_rand(0, 59);
        $sec = mt_rand(0, 59);
        $mday = mt_rand(1, 31);
        $week = mt_rand(1, 4);
        $wkday = mt_rand(1, 7);

        $tzo = new \Zimbra\Struct\TzOnsetInfo($mon, $hour, $min, $sec, $mday, $week, $wkday);
        $this->assertSame($mon, $tzo->getMonth());
        $this->assertSame($hour, $tzo->getHour());
        $this->assertSame($min, $tzo->getMinute());
        $this->assertSame($sec, $tzo->getSecond());
        $this->assertSame($mday, $tzo->getDayOfMonth());
        $this->assertSame($week, $tzo->getWeek());
        $this->assertSame($wkday, $tzo->getDayOfWeek());

        $tzo->setMonth($mon)
            ->setHour($hour)
            ->setMinute($min)
            ->setSecond($sec)
            ->setDayOfMonth($mday)
            ->setWeek($week)
            ->setDayOfWeek($wkday);
        $this->assertSame($mon, $tzo->getMonth());
        $this->assertSame($hour, $tzo->getHour());
        $this->assertSame($min, $tzo->getMinute());
        $this->assertSame($sec, $tzo->getSecond());
        $this->assertSame($mday, $tzo->getDayOfMonth());
        $this->assertSame($week, $tzo->getWeek());
        $this->assertSame($wkday, $tzo->getDayOfWeek());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<info mon="' . $mon . '" hour="' . $hour . '" min="' . $min . '" sec="' . $sec . '" mday="' . $mday . '" week="' . $week . '" wkday="' . $wkday . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $tzo);
        $array = array(
            'info' => array(
                'mon' => $mon,
                'hour' => $hour,
                'min' => $min,
                'sec' => $sec,
                'mday' => $mday,
                'week' => $week,
                'wkday' => $wkday,
            ),
        );
        $this->assertEquals($array, $tzo->toArray());
    }
}
