<?php declare(strict_types=1);

namespace Zimbra\Admin\Struct\Tests;

use Zimbra\Enum\ConditionOperator as CondOp;
use Zimbra\Admin\Struct\EntrySearchFilterSingleCond;
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

        $cond = new EntrySearchFilterSingleCond($attr, CondOp::GE(), $value, FALSE);
        $this->assertSame($attr, $cond->getAttr());
        $this->assertEquals(CondOp::GE(), $cond->getOp());
        $this->assertSame($value, $cond->getValue());
        $this->assertFalse($cond->isNot());

        $cond = new EntrySearchFilterSingleCond('', CondOp::GE(), '', FALSE);
        $cond->setAttr($attr)
             ->setOp(CondOp::EQ())
             ->setValue($value)
             ->setNot(TRUE);
        $this->assertSame($attr, $cond->getAttr());
        $this->assertEquals(CondOp::EQ(), $cond->getOp());
        $this->assertSame($value, $cond->getValue());
        $this->assertTrue($cond->isNot());

        $op = CondOp::EQ()->getValue();
        $xml = <<<EOT
<?xml version="1.0"?>
<cond attr="$attr" op="$op" value="$value" not="true" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($cond, 'xml'));
        $this->assertEquals($cond, $this->serializer->deserialize($xml, EntrySearchFilterSingleCond::class, 'xml'));

        $json = json_encode([
            'attr' => $attr,
            'op' => $op,
            'value' => $value,
            'not' => TRUE,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($cond, 'json'));
        $this->assertEquals($cond, $this->serializer->deserialize($json, EntrySearchFilterSingleCond::class, 'json'));
    }
}
