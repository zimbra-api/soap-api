<?php declare(strict_types=1);

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Struct\ByMinuteRule;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ByMinuteRule.
 */
class ByMinuteRuleTest extends ZimbraStructTestCase
{
    public function testByMinuteRule()
    {
        $list = implode(',', [
            mt_rand(0, 59),
            mt_rand(0, 59),
        ]);

        $rule = new ByMinuteRule($list);
        $this->assertSame($list, $rule->getList());

        $rule = new ByMinuteRule('');
        $rule->setList($list);
        $this->assertSame($list, $rule->getList());

        $xml = <<<EOT
<?xml version="1.0"?>
<byminute minlist="$list" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($rule, 'xml'));
        $this->assertEquals($rule, $this->serializer->deserialize($xml, ByMinuteRule::class, 'xml'));

        $json = json_encode([
            'minlist' => $list,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($rule, 'json'));
        $this->assertEquals($rule, $this->serializer->deserialize($json, ByMinuteRule::class, 'json'));
    }
}
