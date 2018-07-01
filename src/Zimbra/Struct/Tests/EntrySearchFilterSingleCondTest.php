<?php

namespace Zimbra\Struct\Tests;

use Zimbra\Enum\ConditionOperator as CondOp;
use Zimbra\Struct\EntrySearchFilterSingleCond;

/**
 * Testcase class for EntrySearchFilterSingleCond.
 */
class EntrySearchFilterSingleCondTest extends ZimbraStructTestCase
{
    public function testEntrySearchFilterSingleCond()
    {
        $attr = $this->faker->word;
        $value = $this->faker->word;

        $cond = new EntrySearchFilterSingleCond($attr, CondOp::GE()->value(), $value, false);
        $this->assertSame($attr, $cond->getAttr());
        $this->assertSame(CondOp::GE()->value(), $cond->getOp());
        $this->assertSame($value, $cond->getValue());
        $this->assertFalse($cond->getNot());

        $cond = new EntrySearchFilterSingleCond('', CondOp::GE()->value(), '', false);
        $cond->setAttr($attr)
             ->setOp(CondOp::EQ()->value())
             ->setValue($value)
             ->setNot(true);
        $this->assertSame($attr, $cond->getAttr());
        $this->assertSame(CondOp::EQ()->value(), $cond->getOp());
        $this->assertSame($value, $cond->getValue());
        $this->assertTrue($cond->getNot());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<cond attr="' . $attr . '" op="' . CondOp::EQ() . '" value="' . $value . '" not="true" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($cond, 'xml'));

        $cond = $this->serializer->deserialize($xml, 'Zimbra\Struct\EntrySearchFilterSingleCond', 'xml');
        $this->assertSame($attr, $cond->getAttr());
        $this->assertSame(CondOp::EQ()->value(), $cond->getOp());
        $this->assertSame($value, $cond->getValue());
        $this->assertTrue($cond->getNot());
    }
}
