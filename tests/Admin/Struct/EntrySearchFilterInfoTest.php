<?php declare(strict_types=1);

namespace Zimbra\Admin\Struct\Tests;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\{EntrySearchFilterInfo, EntrySearchFilterMultiCond, EntrySearchFilterSingleCond};
use Zimbra\Common\Enum\ConditionOperator as CondOp;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for EntrySearchFilterInfo.
 */
class EntrySearchFilterInfoTest extends ZimbraTestCase
{
    public function testEntrySearchFilterInfo()
    {
        $attr = $this->faker->word;
        $value = $this->faker->word;

        $cond = new EntrySearchFilterSingleCond($attr, CondOp::EQUAL(), $value, TRUE);
        $singleCond = new EntrySearchFilterSingleCond($attr, CondOp::GREATER_EQUAL(), $value, FALSE);
        $multiConds = new EntrySearchFilterMultiCond(FALSE, TRUE, [$singleCond]);
        $conds = new EntrySearchFilterMultiCond(TRUE, FALSE, [$cond, $multiConds]);

        $filter = new StubEntrySearchFilterInfo($conds);
        $this->assertSame($conds, $filter->getConditions());
        $filter->setConditions($conds);
        $this->assertSame($conds, $filter->getConditions());

        $xml = <<<EOT
<?xml version="1.0"?>
<result xmlns:urn="urn:zimbraAdmin">
    <urn:conds not="true" or="false">
        <urn:conds not="false" or="true">
            <urn:cond attr="$attr" op="ge" value="$value" not="false" />
        </urn:conds>
        <urn:cond attr="$attr" op="eq" value="$value" not="true" />
    </urn:conds>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($filter, 'xml'));

        $filter = $this->serializer->deserialize($xml, StubEntrySearchFilterInfo::class, 'xml');
        $this->assertEquals($conds, $filter->getConditions());

        $filter = new StubEntrySearchFilterInfo($cond);
        $this->assertSame($cond, $filter->getCondition());
        $filter->setCondition($cond);
        $this->assertSame($cond, $filter->getCondition());

        $xml = <<<EOT
<?xml version="1.0"?>
<result xmlns:urn="urn:zimbraAdmin">
    <urn:cond attr="$attr" op="eq" value="$value" not="true" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($filter, 'xml'));
        $this->assertEquals($filter, $this->serializer->deserialize($xml, StubEntrySearchFilterInfo::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraAdmin", prefix="urn")
 */
#[XmlNamespace(uri: 'urn:zimbraAdmin', prefix: "urn")]
class StubEntrySearchFilterInfo extends EntrySearchFilterInfo
{
}
