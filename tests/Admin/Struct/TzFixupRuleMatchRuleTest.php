<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\TzFixupRuleMatchRule;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for TzFixupRuleMatchRule.
 */
class TzFixupRuleMatchRuleTest extends ZimbraTestCase
{
    public function testTzFixupRuleMatchRule()
    {
        $mon = mt_rand(1, 12);
        $week = mt_rand(1, 4);
        $wkday = mt_rand(1, 7);

        $rule = new TzFixupRuleMatchRule($mon, $week, $wkday);
        $this->assertSame($mon, $rule->getMonth());
        $this->assertSame($week, $rule->getWeek());
        $this->assertSame($wkday, $rule->getWeekDay());

        $rule = new TzFixupRuleMatchRule();
        $rule->setMonth($mon)
             ->setWeek($week)
             ->setWeekDay($wkday);
        $this->assertSame($mon, $rule->getMonth());
        $this->assertSame($week, $rule->getWeek());
        $this->assertSame($wkday, $rule->getWeekDay());

        $xml = <<<EOT
<?xml version="1.0"?>
<result mon="$mon" week="$week" wkday="$wkday" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($rule, 'xml'));
        $this->assertEquals($rule, $this->serializer->deserialize($xml, TzFixupRuleMatchRule::class, 'xml'));
    }
}
