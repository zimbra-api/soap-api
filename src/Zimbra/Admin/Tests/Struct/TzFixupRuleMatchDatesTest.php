<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\TzFixupRuleMatchDates;
use Zimbra\Admin\Struct\TzFixupRuleMatchDate;

/**
 * Testcase class for TzFixupRuleMatchDates.
 */
class TzFixupRuleMatchDatesTest extends ZimbraAdminTestCase
{
    public function testTzFixupRuleMatchDates()
    {
        $std_mon = mt_rand(1, 12);
        $std_mday = mt_rand(1, 31);
        $standard = new TzFixupRuleMatchDate($std_mon, $std_mday);

        $day_mon = mt_rand(1, 12);
        $day_mday = mt_rand(1, 31);
        $daylight = new TzFixupRuleMatchDate($day_mon, $day_mday);

        $stdoff = mt_rand(1, 100);
        $dayoff = mt_rand(1, 100);
        $dates = new TzFixupRuleMatchDates($standard, $daylight, $stdoff, $dayoff);
        $this->assertSame($standard, $dates->getStandard());
        $this->assertSame($daylight, $dates->getDaylight());
        $this->assertSame($stdoff, $dates->getStdOffset());
        $this->assertSame($dayoff, $dates->getDstOffset());

        $dates->setStandard($standard)
              ->setDaylight($daylight)
              ->setStdOffset($stdoff)
              ->setDstOffset($dayoff);
        $this->assertSame($standard, $dates->getStandard());
        $this->assertSame($daylight, $dates->getDaylight());
        $this->assertSame($stdoff, $dates->getStdOffset());
        $this->assertSame($dayoff, $dates->getDstOffset());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<dates stdoff="' . $stdoff . '" dayoff="' . $dayoff . '">'
                . '<standard mon="' . $std_mon . '" mday="' . $std_mday . '" />'
                . '<daylight mon="' . $day_mon . '" mday="' . $day_mday . '" />'
            . '</dates>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $dates);

        $array = [
            'dates' => [
                'stdoff' => $stdoff,
                'dayoff' => $dayoff,
                'standard' => [
                    'mon' => $std_mon,
                    'mday' => $std_mday,
                ],
                'daylight' => [
                    'mon' => $day_mon,
                    'mday' => $day_mday,
                ],
            ],
        ];
        $this->assertEquals($array, $dates->toArray());
    }
}
