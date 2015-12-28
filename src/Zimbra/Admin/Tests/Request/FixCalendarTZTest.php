<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\FixCalendarTZ;
use Zimbra\Admin\Struct\CalTZInfo;
use Zimbra\Admin\Struct\Offset;
use Zimbra\Admin\Struct\SimpleElement;
use Zimbra\Admin\Struct\TzFixupRuleMatchRule;
use Zimbra\Admin\Struct\TzFixupRuleMatchRules;
use Zimbra\Admin\Struct\TzFixupRuleMatchDate;
use Zimbra\Admin\Struct\TzFixupRuleMatchDates;
use Zimbra\Admin\Struct\TzFixupRuleMatch;
use Zimbra\Admin\Struct\TzReplaceInfo;
use Zimbra\Admin\Struct\TzFixupRule;
use Zimbra\Admin\Struct\TzFixup;
use Zimbra\Struct\Id;
use Zimbra\Struct\NamedElement;
use Zimbra\Struct\TzOnsetInfo;

/**
 * Testcase class for FixCalendarTZ.
 */
class FixCalendarTZTest extends ZimbraAdminApiTestCase
{
    public function testFixCalendarTZRequest()
    {
        $after = mt_rand(0, 1000);
        $name = $this->faker->word;
        $id = $this->faker->word;
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

        $req = new FixCalendarTZ([$account], $tzfixup, false, $after);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame([$account], $req->getAccounts()->all());
        $this->assertSame($tzfixup, $req->getTzFixup());
        $this->assertFalse($req->getSync());
        $this->assertSame($after, $req->getAfter());

        $req->setSync(true)
            ->setAfter($after)
            ->addAccount($account)
            ->setTzFixup($tzfixup);
        $this->assertSame([$account, $account], $req->getAccounts()->all());
        $this->assertSame($tzfixup, $req->getTzFixup());
        $this->assertTrue($req->getSync());
        $this->assertSame($after, $req->getAfter());
        $req->getAccounts()->remove(1);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<FixCalendarTZRequest sync="true" after="' . $after . '">'
                . '<tzfixup>'
                    . '<fixupRule>'
                        . '<match>'
                            . '<any />'
                            . '<tzid id="' . $id . '" />'
                            . '<nonDst offset="' . $offset . '" />'
                            . '<rules stdoff="' . $rule_stdoff . '" dayoff="' . $rule_dayoff . '">'
                                . '<standard mon="' . $rule_mon . '" week="' . $rule_week . '" wkday="' . $rule_wkday . '" />'
                                . '<daylight mon="' . $rule_mon . '" week="' . $rule_week . '" wkday="' . $rule_wkday . '" />'
                            . '</rules>'
                            . '<dates stdoff="' . $date_stdoff . '" dayoff="' . $date_dayoff . '">'
                                . '<standard mon="' . $date_mon . '" mday="' . $date_mday . '" />'
                                . '<daylight mon="' . $date_mon . '" mday="' . $date_mday . '" />'
                            . '</dates>'
                        . '</match>'
                        . '<touch />'
                        . '<replace>'
                            . '<wellKnownTz id="' . $id . '" />'
                            . '<tz id="' . $id . '" stdoff="' . $stdoff . '" dayoff="' . $dayoff . '" stdname="' . $stdname . '" dayname="' . $dayname . '">'
                                . '<standard mon="' . $mon . '" hour="' . $hour . '" min="' . $min . '" sec="' . $sec . '" />'
                                . '<daylight mon="' . $mon . '" hour="' . $hour . '" min="' . $min . '" sec="' . $sec . '" />'
                            . '</tz>'
                        . '</replace>'
                    . '</fixupRule>'
                . '</tzfixup>'
                . '<account name="' . $name . '" />'
            . '</FixCalendarTZRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'FixCalendarTZRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'sync' => true,
                'after' => $after,
                'account' => [
                    [
                        'name' => $name,
                    ],
                ],
                'tzfixup' => [
                    'fixupRule' => [
                        [
                            'match' => [
                                'any' => [],
                                'tzid' => [
                                    'id' => $id,
                                ],
                                'nonDst' => [
                                    'offset' => $offset,
                                ],
                                'rules' => [
                                    'stdoff' => $rule_stdoff,
                                    'dayoff' => $rule_dayoff,
                                    'standard' => [
                                        'mon' => $rule_mon,
                                        'week' => $rule_week,
                                        'wkday' => $rule_wkday,
                                    ],
                                    'daylight' => [
                                        'mon' => $rule_mon,
                                        'week' => $rule_week,
                                        'wkday' => $rule_wkday,
                                    ],
                                ],
                                'dates' => [
                                    'stdoff' => $date_stdoff,
                                    'dayoff' => $date_dayoff,
                                    'standard' => [
                                        'mon' => $date_mon,
                                        'mday' => $date_mday,
                                    ],
                                    'daylight' => [
                                        'mon' => $date_mon,
                                        'mday' => $date_mday,
                                    ],
                                ],
                            ],
                            'touch' => [],
                            'replace' => [
                                'wellKnownTz' => [
                                    'id' => $id,
                                ],
                                'tz' => [
                                    'id' => $id,
                                    'stdoff' => $stdoff,
                                    'dayoff' => $dayoff,
                                    'stdname' => $stdname,
                                    'dayname' => $dayname,
                                    'standard' => [
                                        'mon' => $mon,
                                        'hour' => $hour,
                                        'min' => $min,
                                        'sec' => $sec,
                                    ],
                                    'daylight' => [
                                        'mon' => $mon,
                                        'hour' => $hour,
                                        'min' => $min,
                                        'sec' => $sec,
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testFixCalendarTZApi()
    {
        $after = mt_rand(0, 1000);
        $name = $this->faker->word;
        $id = $this->faker->word;
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

        $this->api->fixCalendarTZ(
            [$account], $tzfixup, true, $after
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:FixCalendarTZRequest sync="true" after="' . $after . '">'
                        . '<urn1:tzfixup>'
                            . '<urn1:fixupRule>'
                                . '<urn1:match>'
                                    . '<urn1:any />'
                                    . '<urn1:tzid id="' . $id . '" />'
                                    . '<urn1:nonDst offset="' . $offset . '" />'
                                    . '<urn1:rules stdoff="' . $rule_stdoff . '" dayoff="' . $rule_dayoff . '">'
                                        . '<urn1:standard mon="' . $rule_mon . '" week="' . $rule_week . '" wkday="' . $rule_wkday . '" />'
                                        . '<urn1:daylight mon="' . $rule_mon . '" week="' . $rule_week . '" wkday="' . $rule_wkday . '" />'
                                    . '</urn1:rules>'
                                    . '<urn1:dates stdoff="' . $date_stdoff . '" dayoff="' . $date_dayoff . '">'
                                        . '<urn1:standard mon="' . $date_mon . '" mday="' . $date_mday . '" />'
                                        . '<urn1:daylight mon="' . $date_mon . '" mday="' . $date_mday . '" />'
                                    . '</urn1:dates>'
                                . '</urn1:match>'
                                . '<urn1:touch />'
                                . '<urn1:replace>'
                                    . '<urn1:wellKnownTz id="' . $id . '" />'
                                    . '<urn1:tz id="' . $id . '" stdoff="' . $stdoff . '" dayoff="' . $dayoff . '" stdname="' . $stdname . '" dayname="' . $dayname . '">'
                                        . '<urn1:standard mon="' . $mon . '" hour="' . $hour . '" min="' . $min . '" sec="' . $sec . '" />'
                                        . '<urn1:daylight mon="' . $mon . '" hour="' . $hour . '" min="' . $min . '" sec="' . $sec . '" />'
                                    . '</urn1:tz>'
                                . '</urn1:replace>'
                            . '</urn1:fixupRule>'
                        . '</urn1:tzfixup>'
                        . '<urn1:account name="' . $name . '" />'
                    . '</urn1:FixCalendarTZRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
