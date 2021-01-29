<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\ByWeekNoRule;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ByWeekNoRule.
 */
class ByWeekNoRuleTest extends ZimbraTestCase
{
    public function testByWeekNoRule()
    {
        $list = implode(',', [
            $this->faker->unique()->numberBetween(1, 53),
            '+' . $this->faker->unique()->numberBetween(1, 53),
            '-' . $this->faker->unique()->numberBetween(1, 53),
        ]);

        $rule = new ByWeekNoRule($list);
        $this->assertSame($list, $rule->getList());

        $rule = new ByWeekNoRule('');
        $rule->setList($list);
        $this->assertSame($list, $rule->getList());

        $xml = <<<EOT
<?xml version="1.0"?>
<byweekno wklist="$list" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($rule, 'xml'));
        $this->assertEquals($rule, $this->serializer->deserialize($xml, ByWeekNoRule::class, 'xml'));

        $json = json_encode([
            'wklist' => $list,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($rule, 'json'));
        $this->assertEquals($rule, $this->serializer->deserialize($json, ByWeekNoRule::class, 'json'));
    }
}
