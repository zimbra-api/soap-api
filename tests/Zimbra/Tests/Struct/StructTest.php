<?php

namespace Zimbra\Tests\Struct;

use Zimbra\Tests\ZimbraTestCase;
use Zimbra\Enum\AccountBy;
use Zimbra\Enum\ConditionOperator as CondOp;
use Zimbra\Enum\InterestType;

/**
 * Testcase class for soap struct.
 */
class StructTest extends ZimbraTestCase
{
    public function testAccountSelector()
    {
        $value = md5(self::randomString());
        $acc = new \Zimbra\Struct\AccountSelector(AccountBy::ID(), $value);
        $this->assertTrue($acc->getBy()->is('id'));
        $this->assertSame($value, $acc->getValue());

        $acc->setBy(AccountBy::ADMIN_NAME());
        $this->assertTrue($acc->getBy()->is('adminName'));

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<account by="' . AccountBy::ADMIN_NAME()->value() . '">' . $value . '</account>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $acc);

        $array = array(
            'account' => array(
                'by' => AccountBy::ADMIN_NAME()->value(),
                '_content' => $value,
            ),
        );
        $this->assertEquals($array, $acc->toArray());
    }

    public function testAttributeName()
    {
        $name = self::randomName();
        $a = new \Zimbra\Struct\AttributeName($name);
        $this->assertSame($name, $a->getName());

        $name = self::randomName();
        $a->setName($name);
        $this->assertSame($name, $a->getName());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<a n="' . $name . '" />';
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
        $value = md5(self::randomString());
        $name = self::randomName();

        $base = $this->getMockForAbstractClass('Zimbra\Struct\Base');
        $base->setValue($value);
        $this->assertSame($value, $base->getValue());
		$className = $base->className();

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<' . $className . '>' . $value . '</' . $className . '>';
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

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<' . $className . ' ' . $name . '="' . $value . '">'
                . '<child>' . $value . '</child>'
            . '</' . $className . '>';
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
        $id = md5(self::randomString());
        $sortVal = md5(self::randomString());
        $endSortVal = md5(self::randomString());

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

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<cursor id="' . $id . '" sortVal="' . $sortVal . '" endSortVal="' . $endSortVal . '" includeOffset="true" />';
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

    public function testEntrySearchFilterSingleCond()
    {
        $attr = self::randomName();
        $value = md5(self::randomString());

        $cond = new \Zimbra\Struct\EntrySearchFilterSingleCond($attr, CondOp::GE(), $value, false);
        $this->assertSame($attr, $cond->getAttr());
        $this->assertTrue($cond->getOp()->is('ge'));
        $this->assertSame($value, $cond->getValue());
        $this->assertFalse($cond->getNot());

        $cond->setAttr($attr)
             ->setOp(CondOp::EQ())
             ->setValue($value)
             ->setNot(true);
        $this->assertSame($attr, $cond->getAttr());
        $this->assertTrue($cond->getOp()->is('eq'));
        $this->assertSame($value, $cond->getValue());
        $this->assertTrue($cond->getNot());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<cond attr="' . $attr . '" op="' . CondOp::EQ() . '" value="' . $value . '" not="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $cond);

        $array = array(
            'cond' => array(
                'attr' => $attr,
                'op' => CondOp::EQ()->value(),
                'value' => $value,
                'not' => true,
            ),
        );
        $this->assertEquals($array, $cond->toArray());
    }

    public function testEntrySearchFilterMultiCond()
    {
        $attr = self::randomName();
        $value = md5(self::randomString());

        $cond = new \Zimbra\Struct\EntrySearchFilterSingleCond($attr, CondOp::EQ(), $value, true);
        $singleCond = new \Zimbra\Struct\EntrySearchFilterSingleCond($attr, CondOp::GE(), $value, false);
        $multiConds = new \Zimbra\Struct\EntrySearchFilterMultiCond(false, true, array($singleCond));

        $conds = new \Zimbra\Struct\EntrySearchFilterMultiCond(false, true, array($cond, $multiConds));

        $this->assertFalse($conds->getNot());
        $this->assertTrue($conds->getOr());
        $this->assertSame(array($cond, $multiConds), $conds->getConditions()->all());

        $conds->setNot(true)
              ->setOr(false)
              ->addCondition($singleCond);
    
        $this->assertTrue($conds->getNot());
        $this->assertFalse($conds->getOr());
        $this->assertSame(array($cond, $multiConds, $singleCond), $conds->getConditions()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<conds not="true" or="false">'
                . '<conds not="false" or="true">'
                    . '<cond attr="' . $attr . '" op="' . CondOp::GE() . '" value="' . $value . '" not="false" />'
                . '</conds>'
                . '<cond attr="' . $attr . '" op="' . CondOp::EQ() . '" value="' . $value . '" not="true" />'
                . '<cond attr="' . $attr . '" op="' . CondOp::GE() . '" value="' . $value . '" not="false" />'
            . '</conds>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $conds);

        $array = array(
            'conds' => array(
                'not' => true,
                'or' => false,
                'conds' => array(
                    array(
                        'not' => false,
                        'or' => true,
                        'cond' => array(
                            array(
                                'attr' => $attr,
                                'op' => CondOp::GE()->value(),
                                'value' => $value,
                                'not' => false,
                            ),
                        ),                    
                    ),
                ),
                'cond' => array(
                    array(
                        'attr' => $attr,
                        'op' => CondOp::EQ()->value(),
                        'value' => $value,
                        'not' => true,
                    ),
                    array(
                        'attr' => $attr,
                        'op' => CondOp::GE()->value(),
                        'value' => $value,
                        'not' => false,
                    ),
                ),                    
            ),
        );
        $this->assertEquals($array, $conds->toArray());
    }

    public function testEntrySearchFilterInfo()
    {
        $attr = self::randomName();
        $value = md5(self::randomString());

        $cond = new \Zimbra\Struct\EntrySearchFilterSingleCond($attr, CondOp::EQ(), $value, true);
        $singleCond = new \Zimbra\Struct\EntrySearchFilterSingleCond($attr, CondOp::GE(), $value, false);
        $multiConds = new \Zimbra\Struct\EntrySearchFilterMultiCond(false, true, array($singleCond));
        $conds = new \Zimbra\Struct\EntrySearchFilterMultiCond(true, false, array($cond, $multiConds));

        $filter = new \Zimbra\Struct\EntrySearchFilterInfo($conds);
        $this->assertSame($conds, $filter->getCondition());
        $filter->setCondition($conds);
        $this->assertSame($conds, $filter->getCondition());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<searchFilter>'
                . '<conds not="true" or="false">'
                    . '<conds not="false" or="true">'
                        . '<cond attr="' . $attr . '" op="' . CondOp::GE() . '" value="' . $value . '" not="false" />'
                    . '</conds>'
                    . '<cond attr="' . $attr . '" op="' . CondOp::EQ() . '" value="' . $value . '" not="true" />'
                . '</conds>'
            . '</searchFilter>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $filter);

        $array = array(
            'searchFilter' => array(
                'conds' => array(
                    'not' => true,
                    'or' => false,
                    'conds' => array(
                        array(
                            'not' => false,
                            'or' => true,
                            'cond' => array(
                                array(
                                    'attr' => $attr,
                                    'op' => CondOp::GE()->value(),
                                    'value' => $value,
                                    'not' => false,
                                ),
                            ),
                        ),
                    ),
                    'cond' => array(
                        array(
                            'attr' => $attr,
                            'op' => CondOp::EQ()->value(),
                            'value' => $value,
                            'not' => true,
                        ),
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $filter->toArray());

        $filter = new \Zimbra\Struct\EntrySearchFilterInfo($cond);
        $this->assertSame($cond, $filter->getCondition());
        $filter->setCondition($cond);
        $this->assertSame($cond, $filter->getCondition());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<searchFilter>'
                . '<cond attr="' . $attr . '" op="' . CondOp::EQ() . '" value="' . $value . '" not="true" />'
            . '</searchFilter>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $filter);

        $array = array(
            'searchFilter' => array(
                'cond' => array(
                    'attr' => $attr,
                    'op' => CondOp::EQ()->value(),
                    'value' => $value,
                    'not' => true,
                ),
            ),
        );
        $this->assertEquals($array, $filter->toArray());
    }

    public function testGranteeChooser()
    {
        $type = md5(self::randomString());
        $id = md5(self::randomString());
        $name = md5(self::randomString());

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

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<grantee type="' . $type . '" id="' . $id . '" name="' . $name . '" />';
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
        $value = md5(self::randomString());

        $id = new \Zimbra\Struct\Id($value);
        $this->assertSame($value, $id->getId());

        $id->setId($value);
        $this->assertSame($value, $id->getId());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<id id="' . $value . '" />';
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
        $key = self::randomName();
        $value = md5(self::randomString());

        $kpv = new \Zimbra\Struct\KeyValuePair($key, $value);
        $this->assertSame($key, $kpv->getKey());
        $this->assertSame($value, $kpv->getValue());

        $kpv->setKey($key);
        $this->assertSame($key, $kpv->getKey());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<a n="' . $key . '">' . $value . '</a>';
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
        $name = self::randomName();
        $named = new \Zimbra\Struct\NamedElement($name);
        $this->assertSame($name, $named->getName());

        $named->setName($name);
        $this->assertSame($name, $named->getName());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<named name="' . $name . '" />';
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
        $name = self::randomName();
        $value = md5(self::randomString());

        $named = new \Zimbra\Struct\NamedValue($name, $value);
        $this->assertSame($name, $named->getName());
        $this->assertSame($value, $named->getValue());

        $named->setName($name);
        $this->assertSame($name, $named->getName());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<named name="' . $name . '">' . $value . '</named>';
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
        $value = self::randomName();

        $op = new \Zimbra\Struct\OpValue('-', $value);
        $this->assertSame('-', $op->getOp());
        $this->assertSame($value, $op->getValue());

        $op->setOp('+');
        $this->assertSame('+', $op->getOp());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<addr op="+">' . $value . '</addr>';
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

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<info mon="' . $mon . '" hour="' . $hour . '" min="' . $min . '" sec="' . $sec . '" mday="' . $mday . '" week="' . $week . '" wkday="' . $wkday . '" />';
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

    public function testWaitSetAddSpec()
    {
        $name = self::randomName();
        $id = self::randomName();
        $token = self::randomName();

        $waitSet = new \Zimbra\Struct\WaitSetAddSpec($name, $id, $token, array(InterestType::FOLDERS()));
        $this->assertSame($name, $waitSet->getName());
        $this->assertSame($id, $waitSet->getId());
        $this->assertSame($token, $waitSet->getToken());
        $this->assertSame('f', $waitSet->getInterests());

        $waitSet->setName($name)
                ->setId($id)
                ->setToken($token)
                ->addInterest(InterestType::MESSAGES())
                ->addInterest(InterestType::CONTACTS());
        $this->assertSame($name, $waitSet->getName());
        $this->assertSame($id, $waitSet->getId());
        $this->assertSame($token, $waitSet->getToken());
        $this->assertSame('f,m,c', $waitSet->getInterests());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<a name="' . $name . '" id="' . $id . '" token="' . $token . '" types="f,m,c" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $waitSet);

        $array = array(
            'a' => array(
                'name' => $name,
                'id' => $id,
                'token' => $token,
                'types' => 'f,m,c',
            ),
        );
        $this->assertEquals($array, $waitSet->toArray());
    }

    public function testWaitSetSpec()
    {
        $name = self::randomName();
        $id = self::randomName();
        $token = self::randomName();
        $a = new \Zimbra\Struct\WaitSetAddSpec($name, $id, $token, array(InterestType::FOLDERS(), InterestType::MESSAGES()));
        $add = new \Zimbra\Struct\WaitSetSpec(array($a));
        $this->assertSame(array($a), $add->getAccounts()->all());
        $add->addAccount($a);
        $this->assertSame(array($a, $a), $add->getAccounts()->all());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<add>'
                .'<a name="' . $name . '" id="' . $id . '" token="' . $token . '" types="f,m" />'
                .'<a name="' . $name . '" id="' . $id . '" token="' . $token . '" types="f,m" />'
            .'</add>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $add);

        $array = array(
            'add' => array(
                'a' => array(
                    array(
                        'name' => $name,
                        'id' => $id,
                        'token' => $token,
                        'types' => 'f,m',
                    ),
                    array(
                        'name' => $name,
                        'id' => $id,
                        'token' => $token,
                        'types' => 'f,m',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $add->toArray());
    }

    public function testWaitSetId()
    {
        $id = self::randomName();
        $a = new \Zimbra\Struct\Id($id);
        $remove = new \Zimbra\Struct\WaitSetId(array($a));
        $this->assertSame(array($a), $remove->getIds()->all());
        $remove->addId($a);
        $this->assertSame(array($a, $a), $remove->getIds()->all());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<remove>'
                .'<a id="' . $id . '" />'
                .'<a id="' . $id . '" />'
            .'</remove>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $remove);

        $array = array(
            'remove' => array(
                'a' => array(
                    array(
                        'id' => $id,
                    ),
                    array(
                        'id' => $id,
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $remove->toArray());
    }
}
