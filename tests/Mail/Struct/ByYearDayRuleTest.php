<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\ByYearDayRule;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for ByYearDayRule.
 */
class ByYearDayRuleTest extends ZimbraStructTestCase
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
<byyearday yrdaylist="$list" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($rule, 'xml'));
        $this->assertEquals($rule, $this->serializer->deserialize($xml, ByYearDayRule::class, 'xml'));

        $json = json_encode([
            'yrdaylist' => $list,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($rule, 'json'));
        $this->assertEquals($rule, $this->serializer->deserialize($json, ByYearDayRule::class, 'json'));
    }
}
