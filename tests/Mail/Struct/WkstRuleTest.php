<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Common\Enum\WeekDay;
use Zimbra\Mail\Struct\WkstRule;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for WkstRule.
 */
class WkstRuleTest extends ZimbraTestCase
{
    public function testWkstRule()
    {
        $day = WeekDay::SUNDAY();

        $wkst = new WkstRule($day);
        $this->assertSame($day, $wkst->getDay());

        $wkst = new WkstRule(WeekDay::SUNDAY());
        $wkst->setDay($day);
        $this->assertSame($day, $wkst->getDay());

        $xml = <<<EOT
<?xml version="1.0"?>
<result day="SU" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($wkst, 'xml'));
        $this->assertEquals($wkst, $this->serializer->deserialize($xml, WkstRule::class, 'xml'));
    }
}
