<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\BySecondRule;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for BySecondRule.
 */
class BySecondRuleTest extends ZimbraStructTestCase
{
    public function testBySecondRule()
    {
        $list = implode(',', [
            $this->faker->unique()->numberBetween(0, 59),
            $this->faker->unique()->numberBetween(0, 59),
        ]);

        $rule = new BySecondRule($list);
        $this->assertSame($list, $rule->getList());

        $rule = new BySecondRule('');
        $rule->setList($list);
        $this->assertSame($list, $rule->getList());

        $xml = <<<EOT
<?xml version="1.0"?>
<bysecond seclist="$list" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($rule, 'xml'));
        $this->assertEquals($rule, $this->serializer->deserialize($xml, BySecondRule::class, 'xml'));

        $json = json_encode([
            'seclist' => $list,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($rule, 'json'));
        $this->assertEquals($rule, $this->serializer->deserialize($json, BySecondRule::class, 'json'));
    }
}
