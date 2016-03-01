<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\Offset;
use Zimbra\Admin\Struct\SimpleElement;
use Zimbra\Admin\Struct\TzFixupRuleMatch;
use Zimbra\Admin\Struct\TzFixupRuleMatchRule;
use Zimbra\Admin\Struct\TzFixupRuleMatchRules;
use Zimbra\Admin\Struct\TzFixupRuleMatchDate;
use Zimbra\Admin\Struct\TzFixupRuleMatchDates;
use Zimbra\Struct\Id;

/**
 * Testcase class for TzFixupRuleMatch.
 */
class TzFixupRuleMatchTest extends ZimbraAdminTestCase
{
    public function testTzFixupRuleMatch()
    {
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
        $this->assertSame($any, $match->getAny());
        $this->assertSame($tzid, $match->getTzid());
        $this->assertSame($nonDst, $match->getNonDst());
        $this->assertSame($rules, $match->getRules());
        $this->assertSame($dates, $match->getDates());

        $match->setAny($any)
              ->setTzid($tzid)
              ->setNonDst($nonDst)
              ->setRules($rules)
              ->setDates($dates);
        $this->assertSame($any, $match->getAny());
        $this->assertSame($tzid, $match->getTzid());
        $this->assertSame($nonDst, $match->getNonDst());
        $this->assertSame($rules, $match->getRules());
        $this->assertSame($dates, $match->getDates());

        $xml = '<?xml version="1.0"?>' . "\n"
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
            . '</match>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $match);

        $array = [
            'match' => [
                'any' => [],
                'tzid' => [
                    'id' => $id
                ],
                'nonDst' => [
                    'offset' => $offset
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
        ];
        $this->assertEquals($array, $match->toArray());
    }
}
