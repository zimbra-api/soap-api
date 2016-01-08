<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Enum\WeekDay;
use Zimbra\Mail\Struct\ByDayRule;
use Zimbra\Mail\Struct\WkDay;

/**
 * Testcase class for ByDayRule.
 */
class ByDayRuleTest extends ZimbraMailTestCase
{
    public function testByDayRule()
    {
        $ordwk1 = mt_rand(1, 53);
        $ordwk2 = mt_rand(-53, -1);

        $wkday1 = new WkDay(WeekDay::SU(), $ordwk1);
        $wkday2 = new WkDay(WeekDay::MO(), $ordwk2);

        $byday = new ByDayRule([$wkday1]);
        $this->assertSame([$wkday1], $byday->getDays()->all());
        $byday->addDay($wkday2);
        $this->assertSame([$wkday1, $wkday2], $byday->getDays()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<byday>'
                .'<wkday day="' . WeekDay::SU() . '" ordwk="' . $ordwk1 . '" />'
                .'<wkday day="' . WeekDay::MO() . '" ordwk="' . $ordwk2 . '" />'
            .'</byday>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $byday);

        $array = array(
            'byday' => array(
                'wkday' => array(
                    array(
                        'day' => WeekDay::SU()->value(),
                        'ordwk' => $ordwk1,
                    ),
                    array(
                        'day' => WeekDay::MO()->value(),
                        'ordwk' => $ordwk2,
                    ),
                )
            ),
        );
        $this->assertEquals($array, $byday->toArray());
    }
}
