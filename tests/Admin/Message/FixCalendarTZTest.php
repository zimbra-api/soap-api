<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\FixCalendarTZBody;
use Zimbra\Admin\Message\FixCalendarTZEnvelope;
use Zimbra\Admin\Message\FixCalendarTZRequest;
use Zimbra\Admin\Message\FixCalendarTZResponse;
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
use Zimbra\Common\Struct\NamedElement;
use Zimbra\Common\Struct\TzOnsetInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for FixCalendarTZ.
 */
class FixCalendarTZTest extends ZimbraTestCase
{
    public function testFixCalendarTZ()
    {
        $name = $this->faker->word;
        $after = time();
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

        $tzfixup = new TzFixup([$fixupRule]);
        $account = new NamedElement($name);

        $request = new FixCalendarTZRequest(FALSE, $after, [$account], $tzfixup);
        $this->assertFalse($request->getSync());
        $this->assertSame($after, $request->getAfter());
        $this->assertSame([$account], $request->getAccounts());
        $this->assertSame($tzfixup, $request->getTzFixup());

        $request = new FixCalendarTZRequest();
        $request->setSync(TRUE)
            ->setAfter($after)
            ->setAccounts([$account])
            ->addAccount($account)
            ->setTzFixup($tzfixup);
        $this->assertTrue($request->getSync());
        $this->assertSame($after, $request->getAfter());
        $this->assertSame([$account, $account], $request->getAccounts());
        $this->assertSame($tzfixup, $request->getTzFixup());
        $request = new FixCalendarTZRequest(TRUE, $after, [$account], $tzfixup);

        $response = new FixCalendarTZResponse();

        $body = new FixCalendarTZBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new FixCalendarTZBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new FixCalendarTZEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new FixCalendarTZEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:FixCalendarTZRequest sync="true" after="$after">
            <urn:account name="$name" />
            <urn:tzfixup>
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
        </urn:tzfixup>
        </urn:FixCalendarTZRequest>
        <urn:FixCalendarTZResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, FixCalendarTZEnvelope::class, 'xml'));
    }
}
