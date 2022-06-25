<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\ByMonthDayRule;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ByMonthDayRule.
 */
class ByMonthDayRuleTest extends ZimbraTestCase
{
    public function testByMonthDayRule()
    {
        $list = implode(',', [
            $this->faker->unique()->numberBetween(1, 31),
            '+' . $this->faker->unique()->numberBetween(1, 31),
            '-' . $this->faker->unique()->numberBetween(1, 31),
        ]);

        $rule = new ByMonthDayRule($list);
        $this->assertSame($list, $rule->getList());

        $rule = new ByMonthDayRule('');
        $rule->setList($list);
        $this->assertSame($list, $rule->getList());

        $xml = <<<EOT
<?xml version="1.0"?>
<result modaylist="$list" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($rule, 'xml'));
        $this->assertEquals($rule, $this->serializer->deserialize($xml, ByMonthDayRule::class, 'xml'));
    }
}
