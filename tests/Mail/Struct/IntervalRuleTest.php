<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\IntervalRule;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for IntervalRule.
 */
class IntervalRuleTest extends ZimbraStructTestCase
{
    public function testIntervalRule()
    {
        $ival = mt_rand(1, 100);

        $rule = new IntervalRule($ival);
        $this->assertSame($ival, $rule->getIval());

        $rule = new IntervalRule(0);
        $rule->setIval($ival);
        $this->assertSame($ival, $rule->getIval());

        $xml = <<<EOT
<?xml version="1.0"?>
<interval ival="$ival" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($rule, 'xml'));
        $this->assertEquals($rule, $this->serializer->deserialize($xml, IntervalRule::class, 'xml'));

        $json = json_encode([
            'ival' => $ival,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($rule, 'json'));
        $this->assertEquals($rule, $this->serializer->deserialize($json, IntervalRule::class, 'json'));
    }
}
