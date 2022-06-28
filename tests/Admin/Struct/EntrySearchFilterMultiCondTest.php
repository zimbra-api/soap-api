<?php declare(strict_types=1);

namespace Zimbra\Admin\Struct\Tests;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Common\SerializerFactory;
use Zimbra\Admin\SerializerHandler;

use Zimbra\Common\Enum\ConditionOperator as CondOp;
use Zimbra\Admin\Struct\{EntrySearchFilterSingleCond, EntrySearchFilterMultiCond};
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for EntrySearchFilterMultiCond.
 */
class EntrySearchFilterMultiCondTest extends ZimbraTestCase
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

        $conds = new StubEntrySearchFilterMultiCond(FALSE, TRUE, [$cond, $multiConds]);

        $this->assertFALSE($conds->isNot());
        $this->assertTRUE($conds->isOr());
        $this->assertSame([$cond, $multiConds], $conds->getConditions());
        $this->assertSame([$multiConds], $conds->getCompoundConditions());
        $this->assertSame([$cond], $conds->getSingleConditions());

        $conds = new StubEntrySearchFilterMultiCond();
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
<result not="true" or="false" xmlns:urn="urn:zimbraAdmin">
    <urn:conds not="false" or="true">
        <urn:cond attr="$attr" op="$ge" value="$value" not="false" />
    </urn:conds>
    <urn:cond attr="$attr" op="$eq" value="$value" not="true" />
    <urn:cond attr="$attr" op="$ge" value="$value" not="false" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($conds, 'xml'));

        $multiCond = $this->serializer->deserialize($xml, StubEntrySearchFilterMultiCond::class, 'xml');
        $this->assertTRUE($multiCond->isNot());
        $this->assertFALSE($multiCond->isOr());
        $this->assertEquals([$cond, $singleCond, $multiConds], $multiCond->getConditions());
        $this->assertEquals([$multiConds], $multiCond->getCompoundConditions());
        $this->assertEquals([$cond, $singleCond], $multiCond->getSingleConditions());
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraAdmin", prefix="urn")
 */
class StubEntrySearchFilterMultiCond extends EntrySearchFilterMultiCond
{
}
