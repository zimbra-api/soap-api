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

        $cond = new EntrySearchFilterSingleCond($attr, CondOp::EQ(), $value, true);
        $singleCond = new EntrySearchFilterSingleCond($attr, CondOp::GE(), $value, false);
        $multiConds = new EntrySearchFilterMultiCond(false, true, [$singleCond]);
        $conds = new EntrySearchFilterMultiCond(true, false, [$cond, $multiConds]);

        $filter = new EntrySearchFilterInfo($conds);
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

        $array = [
            'searchFilter' => [
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
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $filter->toArray());

        $filter = new EntrySearchFilterInfo($cond);
        $this->assertSame($cond, $filter->getCondition());
        $filter->setCondition($cond);
        $this->assertSame($cond, $filter->getCondition());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<searchFilter>'
                . '<cond attr="' . $attr . '" op="' . CondOp::EQ() . '" value="' . $value . '" not="true" />'
            . '</searchFilter>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $filter);

        $array = [
            'searchFilter' => [
                'cond' => [
                    'attr' => $attr,
                    'op' => CondOp::EQ()->value(),
                    'value' => $value,
                    'not' => true,
                ],
            ],
        ];
        $this->assertEquals($array, $filter->toArray());
    }
}
