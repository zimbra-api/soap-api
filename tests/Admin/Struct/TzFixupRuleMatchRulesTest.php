<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\TzFixupRuleMatchRules;
use Zimbra\Admin\Struct\TzFixupRuleMatchRule;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for TzFixupRuleMatchRules.
 */
class TzFixupRuleMatchRulesTest extends ZimbraStructTestCase
{
    public function testTzFixupRuleMatchRules()
    {
        $std_mon = mt_rand(1, 12);
        $std_week = mt_rand(1, 4);
        $std_wkday = mt_rand(1, 7);
        $standard = new TzFixupRuleMatchRule($std_mon, $std_week, $std_wkday);

        $day_mon = mt_rand(1, 12);
        $day_week = mt_rand(1, 4);
        $day_wkday = mt_rand(1, 7);
        $daylight = new TzFixupRuleMatchRule($day_mon, $day_week, $day_wkday);

        $stdoff = mt_rand(1, 100);
        $dayoff = mt_rand(1, 100);
        $rules = new TzFixupRuleMatchRules($standard, $daylight, $stdoff, $dayoff);
        $this->assertSame($standard, $rules->getStandard());
        $this->assertSame($daylight, $rules->getDaylight());
        $this->assertSame($stdoff, $rules->getStdOffset());
        $this->assertSame($dayoff, $rules->getDstOffset());

        $rules = new TzFixupRuleMatchRules(
            new TzFixupRuleMatchRule(0, 0, 0),
            new TzFixupRuleMatchRule(0, 0, 0),
            0,
            0
        );
        $rules->setStandard($standard)
              ->setDaylight($daylight)
              ->setStdOffset($stdoff)
              ->setDstOffset($dayoff);
        $this->assertSame($standard, $rules->getStandard());
        $this->assertSame($daylight, $rules->getDaylight());
        $this->assertSame($stdoff, $rules->getStdOffset());
        $this->assertSame($dayoff, $rules->getDstOffset());

        $xml = <<<EOT
<?xml version="1.0"?>
<rules stdoff="$stdoff" dayoff="$dayoff">
    <standard mon="$std_mon" week="$std_week" wkday="$std_wkday" />
    <daylight mon="$day_mon" week="$day_week" wkday="$day_wkday" />
</rules>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($rules, 'xml'));
        $this->assertEquals($rules, $this->serializer->deserialize($xml, TzFixupRuleMatchRules::class, 'xml'));

        $json = json_encode([
            'standard' => [
                'mon' => $std_mon,
                'week' => $std_week,
                'wkday' => $std_wkday,
            ],
            'daylight' => [
                'mon' => $day_mon,
                'week' => $day_week,
                'wkday' => $day_wkday,
            ],
            'stdoff' => $stdoff,
            'dayoff' => $dayoff,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($rules, 'json'));
        $this->assertEquals($rules, $this->serializer->deserialize($json, TzFixupRuleMatchRules::class, 'json'));
    }
}
