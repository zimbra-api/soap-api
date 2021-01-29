<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Enum\WeekDay;
use Zimbra\Mail\Struct\WkstRule;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for WkstRule.
 */
class WkstRuleTest extends ZimbraStructTestCase
{
    public function testWkstRule()
    {
        $day = WeekDay::SU();

        $wkst = new WkstRule($day);
        $this->assertSame($day, $wkst->getDay());

        $wkst = new WkstRule(WeekDay::SU());
        $wkst->setDay($day);
        $this->assertSame($day, $wkst->getDay());

        $xml = <<<EOT
<?xml version="1.0"?>
<wkst day="SU" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($wkst, 'xml'));
        $this->assertEquals($wkst, $this->serializer->deserialize($xml, WkstRule::class, 'xml'));

        $json = json_encode([
            'day' => 'SU',
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($wkst, 'json'));
        $this->assertEquals($wkst, $this->serializer->deserialize($json, WkstRule::class, 'json'));
    }
}
