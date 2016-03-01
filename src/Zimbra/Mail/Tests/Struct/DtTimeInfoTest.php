<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\DtTimeInfo;

/**
 * Testcase class for DtTimeInfo.
 */
class DtTimeInfoTest extends ZimbraMailTestCase
{
    public function testDtTimeInfo()
    {
        $date = $this->faker->iso8601;
        $tz = $this->faker->word;
        $utc = mt_rand(0, 24);

        $dt = new DtTimeInfo(
            $date, $tz, $utc
        );
        $this->assertSame($date, $dt->getDateTime());
        $this->assertSame($tz, $dt->getTimezone());
        $this->assertSame($utc, $dt->getUtcTime());

        $dt->setDateTime($date)
           ->setTimezone($tz)
           ->setUtcTime($utc);
        $this->assertSame($date, $dt->getDateTime());
        $this->assertSame($tz, $dt->getTimezone());
        $this->assertSame($utc, $dt->getUtcTime());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<dt d="' . $date . '" tz="' . $tz . '" u="' . $utc . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $dt);

        $array = array(
            'dt' => array(
                'd' => $date,
                'tz' => $tz,
                'u' => $utc,
            ),
        );
        $this->assertEquals($array, $dt->toArray());
    }
}
