<?php declare(strict_types=1);

namespace Zimbra\Admin\Struct\Tests;

use Zimbra\Common\SerializerFactory;
use Zimbra\Admin\SerializerHandler;

use Zimbra\Admin\Struct\{EntrySearchFilterInfo, EntrySearchFilterMultiCond, EntrySearchFilterSingleCond};
use Zimbra\Common\Enum\ConditionOperator as CondOp;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for EntrySearchFilterInfo.
 */
class EntrySearchFilterInfoTest extends ZimbraTestCase
{
    protected function setUp(): void
    {
        SerializerFactory::addSerializerHandler(new SerializerHandler);
        parent::setUp();
    }

    public function testEntrySearchFilterInfo()
    {
        $attr = $this->faker->word;
        $value = $this->faker->word;

        $cond = new EntrySearchFilterSingleCond($attr, CondOp::EQ(), $value, TRUE);
        $singleCond = new EntrySearchFilterSingleCond($attr, CondOp::GE(), $value, FALSE);
        $multiConds = new EntrySearchFilterMultiCond(FALSE, TRUE, [$singleCond]);
        $conds = new EntrySearchFilterMultiCond(TRUE, FALSE, [$cond, $multiConds]);

        $filter = new EntrySearchFilterInfo($conds);
        $this->assertSame($conds, $filter->getConditions());
        $filter->setCondition($conds);
        $this->assertSame($conds, $filter->getConditions());

        $xml = <<<EOT
<?xml version="1.0"?>
<result>
    <conds not="true" or="false">
        <conds not="false" or="true">
            <cond attr="$attr" op="ge" value="$value" not="false" />
        </conds>
        <cond attr="$attr" op="eq" value="$value" not="true" />
    </conds>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($filter, 'xml'));

        $filter = $this->serializer->deserialize($xml, EntrySearchFilterInfo::class, 'xml');
        $this->assertEquals($conds, $filter->getConditions());

        $filter = new EntrySearchFilterInfo($cond);
        $this->assertSame($cond, $filter->getCondition());
        $filter->setCondition($cond);
        $this->assertSame($cond, $filter->getCondition());

        $xml = <<<EOT
<?xml version="1.0"?>
<result>
    <cond attr="$attr" op="eq" value="$value" not="true" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($filter, 'xml'));
        $this->assertEquals($filter, $this->serializer->deserialize($xml, EntrySearchFilterInfo::class, 'xml'));
    }
}
