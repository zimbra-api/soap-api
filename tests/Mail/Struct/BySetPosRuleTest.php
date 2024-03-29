<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\BySetPosRule;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for BySetPosRule.
 */
class BySetPosRuleTest extends ZimbraTestCase
{
    public function testBySetPosRule()
    {
        $list = implode(',', [
            $this->faker->unique()->numberBetween(1, 366),
            '+' . $this->faker->unique()->numberBetween(1, 366),
            '-' . $this->faker->unique()->numberBetween(1, 366),
        ]);

        $rule = new BySetPosRule($list);
        $this->assertSame($list, $rule->getList());

        $rule = new BySetPosRule('');
        $rule->setList($list);
        $this->assertSame($list, $rule->getList());

        $xml = <<<EOT
<?xml version="1.0"?>
<result poslist="$list" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($rule, 'xml'));
        $this->assertEquals($rule, $this->serializer->deserialize($xml, BySetPosRule::class, 'xml'));
    }
}
