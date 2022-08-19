<?php declare(strict_types=1);

namespace Zimbra\Account\Struct\Tests;

use Zimbra\Common\Enum\ConditionOperator as CondOp;
use Zimbra\Account\Struct\EntrySearchFilterSingleCond;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for EntrySearchFilterSingleCond.
 */
class EntrySearchFilterSingleCondTest extends ZimbraTestCase
{
    public function testEntrySearchFilterSingleCond()
    {
        $attr = $this->faker->word;
        $value = $this->faker->word;

        $cond = new EntrySearchFilterSingleCond($attr, CondOp::GREATER_EQUAL(), $value, FALSE);
        $this->assertSame($attr, $cond->getAttr());
        $this->assertEquals(CondOp::GREATER_EQUAL(), $cond->getOp());
        $this->assertSame($value, $cond->getValue());
        $this->assertFalse($cond->isNot());

        $cond = new EntrySearchFilterSingleCond();
        $cond->setAttr($attr)
             ->setOp(CondOp::EQUAL())
             ->setValue($value)
             ->setNot(TRUE);
        $this->assertSame($attr, $cond->getAttr());
        $this->assertEquals(CondOp::EQUAL(), $cond->getOp());
        $this->assertSame($value, $cond->getValue());
        $this->assertTrue($cond->isNot());

        $op = CondOp::EQUAL()->getValue();
        $xml = <<<EOT
<?xml version="1.0"?>
<result attr="$attr" op="$op" value="$value" not="true" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($cond, 'xml'));
        $this->assertEquals($cond, $this->serializer->deserialize($xml, EntrySearchFilterSingleCond::class, 'xml'));
    }
}
