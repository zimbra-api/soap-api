<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\TzFixupRuleMatchRule;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for TzFixupRuleMatchRule.
 */
class TzFixupRuleMatchRuleTest extends ZimbraStructTestCase
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

        $rule = new TzFixupRuleMatchRule(0, 0, 0);
        $rule->setMonth($mon)
             ->setWeek($week)
             ->setWeekDay($wkday);
        $this->assertSame($mon, $rule->getMonth());
        $this->assertSame($week, $rule->getWeek());
        $this->assertSame($wkday, $rule->getWeekDay());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<rule mon="' . $mon . '" week="' . $week . '" wkday="' . $wkday . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($rule, 'xml'));
        $this->assertEquals($rule, $this->serializer->deserialize($xml, TzFixupRuleMatchRule::class, 'xml'));

        $json = json_encode([
            'mon' => $mon,
            'week' => $week,
            'wkday' => $wkday,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($rule, 'json'));
        $this->assertEquals($rule, $this->serializer->deserialize($json, TzFixupRuleMatchRule::class, 'json'));
    }
}
