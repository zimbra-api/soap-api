<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Enum\WeekDay;
use Zimbra\Mail\Struct\WkDay;

/**
 * Testcase class for WkDay.
 */
class WkDayTest extends ZimbraMailTestCase
{
    public function testWkDay()
    {
        $ordwk = mt_rand(1, 10);
        $wkday = new WkDay(WeekDay::SU(), $ordwk);
        $this->assertSame('SU', (string) $wkday->getDay());
        $this->assertSame($ordwk, $wkday->getOrdWk());

        $wkday = new WkDay(WeekDay::MO());
        $wkday->setDay(WeekDay::SU())
              ->setOrdWk($ordwk);
        $this->assertSame('SU', (string) $wkday->getDay());
        $this->assertSame($ordwk, $wkday->getOrdWk());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<wkday day="' . WeekDay::SU() . '" ordwk="' . $ordwk . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $wkday);

        $array = array(
            'wkday' => array(
                'day' => WeekDay::SU()->value(),
                'ordwk' => $ordwk,
            ),
        );
        $this->assertEquals($array, $wkday->toArray());
    }
}
