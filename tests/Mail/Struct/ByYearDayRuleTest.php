<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\ByYearDayRule;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ByYearDayRule.
 */
class ByYearDayRuleTest extends ZimbraTestCase
{
    public function testByYearDayRule()
    {
        $list = implode(',', [
            $this->faker->unique()->numberBetween(1, 366),
            '+' . $this->faker->unique()->numberBetween(1, 366),
            '-' . $this->faker->unique()->numberBetween(1, 366),
        ]);

        $rule = new ByYearDayRule($list);
        $this->assertSame($list, $rule->getList());

        $rule = new ByYearDayRule('');
        $rule->setList($list);
        $this->assertSame($list, $rule->getList());

        $xml = <<<EOT
<?xml version="1.0"?>
<result yrdaylist="$list" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($rule, 'xml'));
        $this->assertEquals($rule, $this->serializer->deserialize($xml, ByYearDayRule::class, 'xml'));
    }
}
