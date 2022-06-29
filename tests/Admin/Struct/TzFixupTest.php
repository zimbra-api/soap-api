<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\TzFixup;
use Zimbra\Admin\Struct\CalTZInfo;
use Zimbra\Admin\Struct\Offset;
use Zimbra\Admin\Struct\SimpleElement;
use Zimbra\Admin\Struct\TzFixupRule;
use Zimbra\Admin\Struct\TzFixupRuleMatch;
use Zimbra\Admin\Struct\TzFixupRuleMatchRule;
use Zimbra\Admin\Struct\TzFixupRuleMatchRules;
use Zimbra\Admin\Struct\TzFixupRuleMatchDate;
use Zimbra\Admin\Struct\TzFixupRuleMatchDates;
use Zimbra\Admin\Struct\TzReplaceInfo;
use Zimbra\Common\Struct\Id;
use Zimbra\Common\Struct\TzOnsetInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for TzFixup.
 */
class TzFixupTest extends ZimbraTestCase
{
    public function testTzFixup()
    {
        $id = $this->faker->uuid;
        $offset = mt_rand(0, 100);
        $any = new SimpleElement;
        $tzid = new Id($id);
        $nonDst = new Offset($offset);

        $rule_mon = mt_rand(1, 12);
        $rule_week = mt_rand(1, 4);
        $rule_wkday = mt_rand(1, 7);
        $rule_stdoff = mt_rand(1, 100);
        $rule_dayoff = mt_rand(1, 100);
        $rule_standard = new TzFixupRuleMatchRule($rule_mon, $rule_week, $rule_wkday);
        $rule_daylight = new TzFixupRuleMatchRule($rule_mon, $rule_week, $rule_wkday);
        $rules = new TzFixupRuleMatchRules($rule_standard, $rule_daylight, $rule_stdoff, $rule_dayoff);

        $date_mon = mt_rand(1, 12);
        $date_mday = mt_rand(1, 31);
        $date_stdoff = mt_rand(1, 100);
        $date_dayoff = mt_rand(1, 100);
        $date_standard = new TzFixupRuleMatchDate($date_mon, $date_mday);
        $date_daylight = new TzFixupRuleMatchDate($date_mon, $date_mday);
        $dates = new TzFixupRuleMatchDates($date_standard, $date_daylight, $date_stdoff, $date_dayoff);

        $match = new TzFixupRuleMatch($any, $tzid, $nonDst, $rules, $dates);

        $mon = mt_rand(1, 12);
        $hour = mt_rand(0, 23);
        $min = mt_rand(0, 59);
        $sec = mt_rand(0, 59);
        $wellKnownTz = new Id($id);
        $standard = new TzOnsetInfo($mon, $hour, $min, $sec);
        $daylight = new TzOnsetInfo($mon, $hour, $min, $sec);

        $stdname = $this->faker->word;
        $dayname = $this->faker->word;
        $stdoff = mt_rand(0, 100);
        $dayoff = mt_rand(0, 100);
        $tz = new CalTZInfo($id, $stdoff, $dayoff, $daylight, $standard, $stdname, $dayname);
        $replace = new TzReplaceInfo($wellKnownTz, $tz);
        
        $touch = new SimpleElement;
        $fixupRule = new TzFixupRule($match, $touch, $replace);

        $tzfixup = new StubTzFixup([$fixupRule]);
        $this->assertSame([$fixupRule], $tzfixup->getFixupRules());
        $tzfixup->addFixupRule($fixupRule);
        $this->assertSame([$fixupRule, $fixupRule], $tzfixup->getFixupRules());
        $tzfixup->setFixupRules([$fixupRule]);

        $xml = <<<EOT
<?xml version="1.0"?>
<result xmlns:urn="urn:zimbraAdmin">
    <urn:fixupRule>
        <urn:match>
            <urn:any />
            <urn:tzid id="$id" />
            <urn:nonDst offset="$offset" />
            <urn:rules stdoff="$rule_stdoff" dayoff="$rule_dayoff">
                <urn:standard mon="$rule_mon" week="$rule_week" wkday="$rule_wkday" />
                <urn:daylight mon="$rule_mon" week="$rule_week" wkday="$rule_wkday" />
            </urn:rules>
            <urn:dates stdoff="$date_stdoff" dayoff="$date_dayoff">
                <urn:standard mon="$date_mon" mday="$date_mday" />
                <urn:daylight mon="$date_mon" mday="$date_mday" />
            </urn:dates>
        </urn:match>
        <urn:touch />
        <urn:replace>
            <urn:wellKnownTz id="$id" />
            <urn:tz id="$id" stdoff="$stdoff" dayoff="$dayoff" stdname="$stdname" dayname="$dayname">
                <urn:standard mon="$mon" hour="$hour" min="$min" sec="$sec" />
                <urn:daylight mon="$mon" hour="$hour" min="$min" sec="$sec" />
            </urn:tz>
        </urn:replace>
    </urn:fixupRule>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($tzfixup, 'xml'));
        $this->assertEquals($tzfixup, $this->serializer->deserialize($xml, StubTzFixup::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraAdmin", prefix="urn")
 */
class StubTzFixup extends TzFixup
{
}
