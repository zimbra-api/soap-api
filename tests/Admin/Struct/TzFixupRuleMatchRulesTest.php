<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\TzFixupRuleMatchRules;
use Zimbra\Admin\Struct\TzFixupRuleMatchRule;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for TzFixupRuleMatchRules.
 */
class TzFixupRuleMatchRulesTest extends ZimbraTestCase
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
        $rules = new StubTzFixupRuleMatchRules($standard, $daylight, $stdoff, $dayoff);
        $this->assertSame($standard, $rules->getStandard());
        $this->assertSame($daylight, $rules->getDaylight());
        $this->assertSame($stdoff, $rules->getStdOffset());
        $this->assertSame($dayoff, $rules->getDstOffset());

        $rules = new StubTzFixupRuleMatchRules(
            new TzFixupRuleMatchRule(),
            new TzFixupRuleMatchRule()
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
<result stdoff="$stdoff" dayoff="$dayoff" xmlns:urn="urn:zimbraAdmin">
    <urn:standard mon="$std_mon" week="$std_week" wkday="$std_wkday" />
    <urn:daylight mon="$day_mon" week="$day_week" wkday="$day_wkday" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($rules, 'xml'));
        $this->assertEquals($rules, $this->serializer->deserialize($xml, StubTzFixupRuleMatchRules::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraAdmin', prefix: 'urn')]
class StubTzFixupRuleMatchRules extends TzFixupRuleMatchRules
{
}
