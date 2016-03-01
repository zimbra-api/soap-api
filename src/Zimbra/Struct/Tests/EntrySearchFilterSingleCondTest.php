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

        $cond = new EntrySearchFilterSingleCond($attr, CondOp::GE(), $value, false);
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

        $array = [
            'cond' => [
                'attr' => $attr,
                'op' => CondOp::EQ()->value(),
                'value' => $value,
                'not' => true,
            ],
        ];
        $this->assertEquals($array, $cond->toArray());
    }
}
