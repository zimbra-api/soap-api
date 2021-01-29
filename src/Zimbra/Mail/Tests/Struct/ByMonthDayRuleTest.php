<?php declare(strict_types=1);

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Struct\ByMonthDayRule;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ByMonthDayRule.
 */
class ByMonthDayRuleTest extends ZimbraStructTestCase
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
<bymonthday modaylist="$list" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($rule, 'xml'));
        $this->assertEquals($rule, $this->serializer->deserialize($xml, ByMonthDayRule::class, 'xml'));

        $json = json_encode([
            'modaylist' => $list,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($rule, 'json'));
        $this->assertEquals($rule, $this->serializer->deserialize($json, ByMonthDayRule::class, 'json'));
    }
}
