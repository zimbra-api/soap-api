<?php

namespace Zimbra\Struct\Tests;

use Zimbra\Enum\ConditionOperator as CondOp;
use Zimbra\Struct\EntrySearchFilterSingleCond;
use Zimbra\Struct\EntrySearchFilterMultiCond;
use Zimbra\Struct\EntrySearchFilterInfo;

/**
 * Testcase class for EntrySearchFilterInfo.
 */
class EntrySearchFilterInfoTest extends ZimbraStructTestCase
{
    public function testEntrySearchFilterInfo()
    {
        $attr = $this->faker->word;
        $value = $this->faker->word;

        $cond = new EntrySearchFilterSingleCond($attr, CondOp::EQ()->value(), $value, true);
        $singleCond = new EntrySearchFilterSingleCond($attr, CondOp::GE()->value(), $value, false);
        $multiConds = new EntrySearchFilterMultiCond(false, true, [$singleCond]);
        $conds = new EntrySearchFilterMultiCond(true, false, [$cond, $multiConds]);

        $filter = new EntrySearchFilterInfo($conds);
        $this->assertSame($conds, $filter->getConditions());
        $filter->setCondition($conds);
        $this->assertSame($conds, $filter->getConditions());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<searchFilter>'
                . '<conds not="true" or="false">'
                    . '<conds not="false" or="true">'
                        . '<cond attr="' . $attr . '" op="' . CondOp::GE() . '" value="' . $value . '" not="false" />'
                    . '</conds>'
                    . '<cond attr="' . $attr . '" op="' . CondOp::EQ() . '" value="' . $value . '" not="true" />'
                . '</conds>'
            . '</searchFilter>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($filter, 'xml'));

        $filter = $this->serializer->deserialize($xml, 'Zimbra\Struct\EntrySearchFilterInfo', 'xml');
        $conds = $filter->getConditions();
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

        $filter = new EntrySearchFilterInfo($cond);
        $this->assertSame($cond, $filter->getCondition());
        $filter->setCondition($cond);
        $this->assertSame($cond, $filter->getCondition());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<searchFilter>'
                . '<cond attr="' . $attr . '" op="' . CondOp::EQ() . '" value="' . $value . '" not="true" />'
            . '</searchFilter>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($filter, 'xml'));

        $filter = $this->serializer->deserialize($xml, 'Zimbra\Struct\EntrySearchFilterInfo', 'xml');
        $cond = $filter->getCondition();
        $this->assertSame($attr, $cond->getAttr());
        $this->assertSame(CondOp::EQ()->value(), $cond->getOp());
        $this->assertSame($value, $cond->getValue());
        $this->assertTrue($cond->getNot());
    }
}
