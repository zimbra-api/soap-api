<?php

namespace Zimbra\Struct\Tests;

use Zimbra\Enum\ConditionOperator as CondOp;
use Zimbra\Struct\EntrySearchFilterSingleCond;
use Zimbra\Struct\EntrySearchFilterMultiCond;

/**
 * Testcase class for EntrySearchFilterMultiCond.
 */
class EntrySearchFilterMultiCondTest extends ZimbraStructTestCase
{
    public function testEntrySearchFilterMultiCond()
    {
        $attr = $this->faker->word;
        $value = $this->faker->word;

        $cond = new EntrySearchFilterSingleCond($attr, CondOp::EQ()->value(), $value, true);
        $singleCond = new EntrySearchFilterSingleCond($attr, CondOp::GE()->value(), $value, false);
        $multiConds = new EntrySearchFilterMultiCond(false, true, [$singleCond]);

        $conds = new EntrySearchFilterMultiCond(false, true, [$cond, $multiConds]);

        $this->assertFalse($conds->getNot());
        $this->assertTrue($conds->getOr());
        $this->assertSame([$cond, $multiConds], $conds->getConditions());

        $conds = new EntrySearchFilterMultiCond(false, true);
        $conds->setNot(true)
              ->setOr(false)
              ->setConditions([$cond, $multiConds])
              ->addCondition($singleCond);
    
        $this->assertTrue($conds->getNot());
        $this->assertFalse($conds->getOr());
        $this->assertSame([$cond, $multiConds, $singleCond], $conds->getConditions());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<conds not="true" or="false">'
                . '<conds not="false" or="true">'
                    . '<cond attr="' . $attr . '" op="' . CondOp::GE() . '" value="' . $value . '" not="false" />'
                . '</conds>'
                . '<cond attr="' . $attr . '" op="' . CondOp::EQ() . '" value="' . $value . '" not="true" />'
                . '<cond attr="' . $attr . '" op="' . CondOp::GE() . '" value="' . $value . '" not="false" />'
            . '</conds>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($conds, 'xml'));

        $conds = $this->serializer->deserialize($xml, 'Zimbra\Struct\EntrySearchFilterMultiCond', 'xml');
        $this->assertTrue($conds->getNot());
        $this->assertFalse($conds->getOr());

        $multiConds = $conds->getMultiCond();
        foreach ($multiConds as $key => $multiCond) {
            $this->assertFalse($multiCond->getNot());
            $this->assertTrue($multiCond->getOr());
            $singleConds = $multiCond->getSingleCond();
            foreach ($singleConds as $singleCond) {
                $this->assertSame($attr, $singleCond->getAttr());
                $this->assertSame(CondOp::GE()->value(), $singleCond->getOp());
                $this->assertSame($value, $singleCond->getValue());
                $this->assertFalse($singleCond->getNot());
            }
        }
        $singleConds = $conds->getSingleCond();
        foreach ($singleConds as $key => $singleCond) {
            $this->assertSame($attr, $singleCond->getAttr());
            $this->assertSame($value, $singleCond->getValue());
            if ($key === 0) {
                $this->assertTrue($singleCond->getNot());
                $this->assertSame(CondOp::EQ()->value(), $singleCond->getOp());
            }
            elseif($key === 1) {
                $this->assertFalse($singleCond->getNot());
                $this->assertSame(CondOp::GE()->value(), $singleCond->getOp());
            }
        }
    }
}
