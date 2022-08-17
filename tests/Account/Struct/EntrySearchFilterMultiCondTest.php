<?php declare(strict_types=1);

namespace Zimbra\Account\Struct\Tests;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Common\Enum\ConditionOperator as CondOp;
use Zimbra\Account\Struct\{EntrySearchFilterSingleCond, EntrySearchFilterMultiCond};
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for EntrySearchFilterMultiCond.
 */
class EntrySearchFilterMultiCondTest extends ZimbraTestCase
{
    public function testEntrySearchFilterMultiCond()
    {
        $attr = $this->faker->word;
        $value = $this->faker->word;

        $cond = new EntrySearchFilterSingleCond($attr, CondOp::EQ(), $value, TRUE);
        $singleCond = new EntrySearchFilterSingleCond($attr, CondOp::GE(), $value, FALSE);
        $multiConds = new EntrySearchFilterMultiCond(FALSE, TRUE, [$singleCond]);

        $conds = new MockEntrySearchFilterMultiCond(FALSE, TRUE, [$cond, $multiConds]);

        $this->assertFALSE($conds->isNot());
        $this->assertTRUE($conds->isOr());
        $this->assertSame([$cond, $multiConds], $conds->getConditions());
        $this->assertSame([$multiConds], $conds->getCompoundConditions());
        $this->assertSame([$cond], $conds->getSingleConditions());

        $conds = new MockEntrySearchFilterMultiCond();
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
<result not="true" or="false" xmlns:urn="urn:zimbraAccount">
    <urn:conds not="false" or="true">
        <urn:cond attr="$attr" op="$ge" value="$value" not="false" />
    </urn:conds>
    <urn:cond attr="$attr" op="$eq" value="$value" not="true" />
    <urn:cond attr="$attr" op="$ge" value="$value" not="false" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($conds, 'xml'));

        $multiCond = $this->serializer->deserialize($xml, MockEntrySearchFilterMultiCond::class, 'xml');
        $this->assertTRUE($multiCond->isNot());
        $this->assertFALSE($multiCond->isOr());
        $this->assertEquals([$cond, $singleCond, $multiConds], $multiCond->getConditions());
        $this->assertEquals([$multiConds], $multiCond->getCompoundConditions());
        $this->assertEquals([$cond, $singleCond], $multiCond->getSingleConditions());
    }
}

#[XmlNamespace(uri: 'urn:zimbraAccount', prefix: 'urn')]
class MockEntrySearchFilterMultiCond extends EntrySearchFilterMultiCond
{
}
