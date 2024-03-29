<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\BySecondRule;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for BySecondRule.
 */
class BySecondRuleTest extends ZimbraTestCase
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
<result seclist="$list" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($rule, 'xml'));
        $this->assertEquals($rule, $this->serializer->deserialize($xml, BySecondRule::class, 'xml'));
    }
}
