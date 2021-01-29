<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\ByMonthRule;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for ByMonthRule.
 */
class ByMonthRuleTest extends ZimbraStructTestCase
{
    public function testByMonthRule()
    {
        $list = implode(',', [
            $this->faker->unique()->numberBetween(1, 12),
            $this->faker->unique()->numberBetween(1, 12),
        ]);

        $rule = new ByMonthRule($list);
        $this->assertSame($list, $rule->getList());

        $rule = new ByMonthRule('');
        $rule->setList($list);
        $this->assertSame($list, $rule->getList());

        $xml = <<<EOT
<?xml version="1.0"?>
<bymonth molist="$list" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($rule, 'xml'));
        $this->assertEquals($rule, $this->serializer->deserialize($xml, ByMonthRule::class, 'xml'));

        $json = json_encode([
            'molist' => $list,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($rule, 'json'));
        $this->assertEquals($rule, $this->serializer->deserialize($json, ByMonthRule::class, 'json'));
    }
}
