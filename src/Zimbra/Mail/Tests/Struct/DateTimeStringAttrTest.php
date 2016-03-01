<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\DateTimeStringAttr;

/**
 * Testcase class for DateTimeStringAttr.
 */
class DateTimeStringAttrTest extends ZimbraMailTestCase
{
    public function testDateTimeStringAttr()
    {
        $date = $this->faker->iso8601;

        $until = new DateTimeStringAttr($date);
        $this->assertSame($date, $until->getDateTime());
        $until->setDateTime($date);
        $this->assertSame($date, $until->getDateTime());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<until d="' . $date . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $until);

        $array = array(
            'until' => array(
                'd' => $date,
            ),
        );
        $this->assertEquals($array, $until->toArray());
    }
}
