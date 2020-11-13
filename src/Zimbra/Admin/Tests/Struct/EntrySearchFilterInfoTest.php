<?php declare(strict_types=1);

namespace Zimbra\Admin\Struct\Tests;

use Zimbra\Admin\Struct\{EntrySearchFilterInfo, EntrySearchFilterMultiCond, EntrySearchFilterSingleCond};
use Zimbra\Enum\ConditionOperator as CondOp;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

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

        $filter = $this->serializer->deserialize($xml, EntrySearchFilterInfo::class, 'xml');
        $this->assertEquals($conds, $filter->getConditions());

        $json = json_encode([
            'conds' => [
                'not' => TRUE,
                'or' => FALSE,
                'conds' => [
                    [
                        'not' => FALSE,
                        'or' => TRUE,
                        'cond' => [
                            [
                                'attr' => $attr,
                                'op' => (string) CondOp::GE(),
                                'value' => $value,
                                'not' => FALSE,
                            ],
                        ],
                    ],
                ],
                'cond' => [
                    [
                        'attr' => $attr,
                        'op' => (string) CondOp::EQ(),
                        'value' => $value,
                        'not' => TRUE,
                    ],
                ],
            ]
        ]);
        $this->assertSame($json, $this->serializer->serialize($filter, 'json'));
        $filter = $this->serializer->deserialize($json, EntrySearchFilterInfo::class, 'json');
        $this->assertEquals($conds, $filter->getConditions());

        $filter = new EntrySearchFilterInfo($cond);
        $this->assertSame($cond, $filter->getCondition());
        $filter->setCondition($cond);
        $this->assertSame($cond, $filter->getCondition());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<searchFilter>'
                . '<cond attr="' . $attr . '" op="' . CondOp::EQ() . '" value="' . $value . '" not="true" />'
            . '</searchFilter>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($filter, 'xml'));
        $this->assertEquals($filter, $this->serializer->deserialize($xml, EntrySearchFilterInfo::class, 'xml'));

        $json = json_encode([
            'cond' => [
                'attr' => $attr,
                'op' => (string) CondOp::EQ(),
                'value' => $value,
                'not' => TRUE,
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($filter, 'json'));
        $this->assertEquals($filter, $this->serializer->deserialize($json, EntrySearchFilterInfo::class, 'json'));
    }
}
