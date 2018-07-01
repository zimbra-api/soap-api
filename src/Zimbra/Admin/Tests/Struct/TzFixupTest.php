<?php

namespace Zimbra\Admin\Tests\Struct;

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
use Zimbra\Struct\Id;
use Zimbra\Struct\TzOnsetInfo;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for TzFixup.
 */
class TzFixupTest extends ZimbraStructTestCase
{
    public function testTzFixup()
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
        $this->assertSame([$fixupRule], $tzfixup->getFixupRules());
        $tzfixup->addFixupRule($fixupRule);
        $this->assertSame([$fixupRule, $fixupRule], $tzfixup->getFixupRules());
        $tzfixup->setFixupRules([$fixupRule]);

        $xml = '<?xml version="1.0"?>' . "\n"
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
            . '</tzfixup>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($tzfixup, 'xml'));

        $tzfixup = $this->serializer->deserialize($xml, 'Zimbra\Admin\Struct\TzFixup', 'xml');
        $fixupRule = $tzfixup->getFixupRules()[0];
        $touch = $fixupRule->getTouch();
        $this->assertTrue($touch instanceof SimpleElement);

        $match = $fixupRule->getMatch();
        $any = $match->getAny();
        $tzid = $match->getTzid();
        $nonDst = $match->getNonDst();
        $this->assertTrue($any instanceof SimpleElement);
        $this->assertSame($id, $tzid->getId());
        $this->assertSame($offset, $nonDst->getOffset());

        $rules = $match->getRules();
        $standard = $rules->getStandard();
        $daylight = $rules->getDaylight();
        $this->assertSame($rule_stdoff, $rules->getStdOffset());
        $this->assertSame($rule_dayoff, $rules->getDstOffset());
        $this->assertSame($rule_mon, $standard->getMonth());
        $this->assertSame($rule_week, $standard->getWeek());
        $this->assertSame($rule_wkday, $standard->getWeekDay());
        $this->assertSame($rule_mon, $daylight->getMonth());
        $this->assertSame($rule_week, $daylight->getWeek());
        $this->assertSame($rule_wkday, $daylight->getWeekDay());

        $dates = $match->getDates();
        $standard = $dates->getStandard();
        $daylight = $dates->getDaylight();
        $this->assertSame($date_stdoff, $dates->getStdOffset());
        $this->assertSame($date_dayoff, $dates->getDstOffset());
        $this->assertSame($date_mon, $standard->getMonth());
        $this->assertSame($date_mday, $standard->getMonthDay());
        $this->assertSame($date_mon, $daylight->getMonth());
        $this->assertSame($date_mday, $daylight->getMonthDay());

        $replace = $fixupRule->getReplace();
        $wellKnownTz = $replace->getWellKnownTz();
        $tz = $replace->getCalTz();
        $standard = $tz->getStandardTzOnset();
        $daylight = $tz->getDaylightTzOnset();

        $this->assertSame($id, $wellKnownTz->getId());
        $this->assertSame($id, $tz->getId());
        $this->assertSame($stdoff, $tz->getTzStdOffset());
        $this->assertSame($dayoff, $tz->getTzDayOffset());
        $this->assertSame($stdname, $tz->getStandardTZName());
        $this->assertSame($dayname, $tz->getDaylightTZName());

        $this->assertSame($mon, $standard->getMonth());
        $this->assertSame($hour, $standard->getHour());
        $this->assertSame($min, $standard->getMinute());
        $this->assertSame($sec, $standard->getSecond());

        $this->assertSame($mon, $daylight->getMonth());
        $this->assertSame($hour, $daylight->getHour());
        $this->assertSame($min, $daylight->getMinute());
        $this->assertSame($sec, $daylight->getSecond());
    }
}
