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

        $cond = new EntrySearchFilterSingleCond($attr, CondOp::EQ(), $value, true);
        $singleCond = new EntrySearchFilterSingleCond($attr, CondOp::GE(), $value, false);
        $multiConds = new EntrySearchFilterMultiCond(false, true, [$singleCond]);

        $conds = new EntrySearchFilterMultiCond(false, true, [$cond, $multiConds]);

        $this->assertFalse($conds->getNot());
        $this->assertTrue($conds->getOr());
        $this->assertSame([$cond, $multiConds], $conds->getConditions()->all());

        $conds->setNot(true)
              ->setOr(false)
              ->addCondition($singleCond);
    
        $this->assertTrue($conds->getNot());
        $this->assertFalse($conds->getOr());
        $this->assertSame([$cond, $multiConds, $singleCond], $conds->getConditions()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<conds not="true" or="false">'
                . '<conds not="false" or="true">'
                    . '<cond attr="' . $attr . '" op="' . CondOp::GE() . '" value="' . $value . '" not="false" />'
                . '</conds>'
                . '<cond attr="' . $attr . '" op="' . CondOp::EQ() . '" value="' . $value . '" not="true" />'
                . '<cond attr="' . $attr . '" op="' . CondOp::GE() . '" value="' . $value . '" not="false" />'
            . '</conds>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $conds);

        $array = [
            'conds' => [
                'not' => true,
                'or' => false,
                'conds' => [
                    [
                        'not' => false,
                        'or' => true,
                        'cond' => [
                            [
                                'attr' => $attr,
                                'op' => CondOp::GE()->value(),
                                'value' => $value,
                                'not' => false,
                            ],
                        ],                    
                    ],
                ],
                'cond' => [
                    [
                        'attr' => $attr,
                        'op' => CondOp::EQ()->value(),
                        'value' => $value,
                        'not' => true,
                    ],
                    [
                        'attr' => $attr,
                        'op' => CondOp::GE()->value(),
                        'value' => $value,
                        'not' => false,
                    ],
                ],                    
            ],
        ];
        $this->assertEquals($array, $conds->toArray());
    }
}
