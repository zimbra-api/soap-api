<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\TzFixupRuleMatchRule;

/**
 * Testcase class for TzFixupRuleMatchRule.
 */
class TzFixupRuleMatchRuleTest extends ZimbraAdminTestCase
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

        $rule->setMonth($mon)
             ->setWeek($week)
             ->setWeekDay($wkday);
        $this->assertSame($mon, $rule->getMonth());
        $this->assertSame($week, $rule->getWeek());
        $this->assertSame($wkday, $rule->getWeekDay());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<rule mon="' . $mon . '" week="' . $week . '" wkday="' . $wkday . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $rule);

        $array = [
            'rule' => [
                'mon' => $mon,
                'week' => $week,
                'wkday' => $wkday,
            ],
        ];
        $this->assertEquals($array, $rule->toArray());
    }
}
