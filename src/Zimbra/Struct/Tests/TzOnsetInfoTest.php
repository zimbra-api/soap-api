<?php

namespace Zimbra\Struct\Tests;

use Zimbra\Enum\AccountBy;
use Zimbra\Struct\TzOnsetInfo;

/**
 * Testcase class for TzOnsetInfo.
 */
class TzOnsetInfoTest extends ZimbraStructTestCase
{
    public function testTzOnsetInfo()
    {
        $mon = mt_rand(1, 12);
        $hour = mt_rand(0, 23);
        $min = mt_rand(0, 59);
        $sec = mt_rand(0, 59);
        $mday = mt_rand(1, 31);
        $week = mt_rand(1, 4);
        $wkday = mt_rand(1, 7);

        $tzo = new TzOnsetInfo($mon, $hour, $min, $sec, $mday, $week, $wkday);
        $this->assertSame($mon, $tzo->getMonth());
        $this->assertSame($hour, $tzo->getHour());
        $this->assertSame($min, $tzo->getMinute());
        $this->assertSame($sec, $tzo->getSecond());
        $this->assertSame($mday, $tzo->getDayOfMonth());
        $this->assertSame($week, $tzo->getWeek());
        $this->assertSame($wkday, $tzo->getDayOfWeek());

        $tzo->setMonth($mon)
            ->setHour($hour)
            ->setMinute($min)
            ->setSecond($sec)
            ->setDayOfMonth($mday)
            ->setWeek($week)
            ->setDayOfWeek($wkday);
        $this->assertSame($mon, $tzo->getMonth());
        $this->assertSame($hour, $tzo->getHour());
        $this->assertSame($min, $tzo->getMinute());
        $this->assertSame($sec, $tzo->getSecond());
        $this->assertSame($mday, $tzo->getDayOfMonth());
        $this->assertSame($week, $tzo->getWeek());
        $this->assertSame($wkday, $tzo->getDayOfWeek());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<info mon="' . $mon . '" hour="' . $hour . '" min="' . $min . '" sec="' . $sec . '" mday="' . $mday . '" week="' . $week . '" wkday="' . $wkday . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $tzo);
        $array = [
            'info' => [
                'mon' => $mon,
                'hour' => $hour,
                'min' => $min,
                'sec' => $sec,
                'mday' => $mday,
                'week' => $week,
                'wkday' => $wkday,
            ],
        ];
        $this->assertEquals($array, $tzo->toArray());
    }
}
