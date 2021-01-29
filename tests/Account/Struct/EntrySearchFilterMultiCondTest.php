<?php declare(strict_types=1);

namespace Zimbra\Account\Struct\Tests;

use Zimbra\Common\SerializerFactory;
use Zimbra\Account\SerializerHandler;

use Zimbra\Enum\ConditionOperator as CondOp;
use Zimbra\Account\Struct\{EntrySearchFilterSingleCond, EntrySearchFilterMultiCond};
use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for EntrySearchFilterMultiCond.
 */
class EntrySearchFilterMultiCondTest extends ZimbraStructTestCase
{
    protected function setUp(): void
    {
        SerializerFactory::addSerializerHandler(new SerializerHandler);
        parent::setUp();
    }

    public function testEntrySearchFilterMultiCond()
    {
        $attr = $this->faker->word;
        $value = $this->faker->word;

        $cond = new EntrySearchFilterSingleCond($attr, CondOp::EQ(), $value, TRUE);
        $singleCond = new EntrySearchFilterSingleCond($attr, CondOp::GE(), $value, FALSE);
        $multiConds = new EntrySearchFilterMultiCond(FALSE, TRUE, [$singleCond]);

        $conds = new EntrySearchFilterMultiCond(FALSE, TRUE, [$cond, $multiConds]);

        $this->assertFALSE($conds->isNot());
        $this->assertTRUE($conds->isOr());
        $this->assertSame([$cond, $multiConds], $conds->getConditions());
        $this->assertSame([$multiConds], $conds->getCompoundConditions());
        $this->assertSame([$cond], $conds->getSingleConditions());

        $conds = new EntrySearchFilterMultiCond();
        $conds->setNot(TRUE)
              ->setOr(FALSE)
              ->setConditions([$cond, $multiConds])
              ->addCondition($singleCond);
    
        $this->assertTRUE($conds->isNot());
        $this->assertFALSE($conds->isOr());
        $this->assertSame([$cond, $singleCond, $multiConds], $conds->getConditions());
        $this->assertSame([$multiConds], $conds->getCompoundConditions());
        $this->assertSame([$cond, $singleCond], $conds->getSingleConditions());

        $ge = CondOp::GE()->getValue();
        $eq = CondOp::EQ()->getValue();
        $xml = <<<EOT
<?xml version="1.0"?>
<conds not="true" or="false">
    <conds not="false" or="true">
        <cond attr="$attr" op="$ge" value="$value" not="false" />
    </conds>
    <cond attr="$attr" op="$eq" value="$value" not="true" />
    <cond attr="$attr" op="$ge" value="$value" not="false" />
</conds>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($conds, 'xml'));

        $multiCond = $this->serializer->deserialize($xml, EntrySearchFilterMultiCond::class, 'xml');
        $this->assertTRUE($multiCond->isNot());
        $this->assertFALSE($multiCond->isOr());
        $this->assertEquals([$cond, $singleCond, $multiConds], $multiCond->getConditions());
        $this->assertEquals([$multiConds], $multiCond->getCompoundConditions());
        $this->assertEquals([$cond, $singleCond], $multiCond->getSingleConditions());

        $json = json_encode([
            'not' => TRUE,
            'or' => FALSE,
            'conds' => [
                [
                    'not' => FALSE,
                    'or' => TRUE,
                    'cond' => [
                        [
                            'attr' => $attr,
                            'op' => $ge,
                            'value' => $value,
                            'not' => FALSE,
                        ],
                    ],
                ],
            ],
            'cond' => [
                [
                    'attr' => $attr,
                    'op' => $eq,
                    'value' => $value,
                    'not' => TRUE,
                ],
                [
                    'attr' => $attr,
                    'op' => $ge,
                    'value' => $value,
                    'not' => FALSE,
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($conds, 'json'));
        $multiCond = $this->serializer->deserialize($json, EntrySearchFilterMultiCond::class, 'json');
        $this->assertTRUE($multiCond->isNot());
        $this->assertFALSE($multiCond->isOr());
        $this->assertEquals([$cond, $singleCond, $multiConds], $multiCond->getConditions());
        $this->assertEquals([$multiConds], $multiCond->getCompoundConditions());
        $this->assertEquals([$cond, $singleCond], $multiCond->getSingleConditions());
    }
}
