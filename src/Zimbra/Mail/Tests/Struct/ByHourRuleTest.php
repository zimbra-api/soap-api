<?php declare(strict_types=1);

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Struct\ByHourRule;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ByHourRule.
 */
class ByHourRuleTest extends ZimbraStructTestCase
{
    public function testByHourRule()
    {
        $list = implode(',', [
            mt_rand(0, 23),
            mt_rand(0, 23),
        ]);

        $rule = new ByHourRule($list);
        $this->assertSame($list, $rule->getList());

        $rule = new ByHourRule('');
        $rule->setList($list);
        $this->assertSame($list, $rule->getList());

        $xml = <<<EOT
<?xml version="1.0"?>
<byhour hrlist="$list" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($rule, 'xml'));
        $this->assertEquals($rule, $this->serializer->deserialize($xml, ByHourRule::class, 'xml'));

        $json = json_encode([
            'hrlist' => $list,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($rule, 'json'));
        $this->assertEquals($rule, $this->serializer->deserialize($json, ByHourRule::class, 'json'));
    }
}
