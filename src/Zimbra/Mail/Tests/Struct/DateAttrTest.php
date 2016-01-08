<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\DateAttr;

/**
 * Testcase class for DateAttr.
 */
class DateAttrTest extends ZimbraMailTestCase
{
    public function testDateAttr()
    {
        $date = $this->faker->iso8601;

        $attr = new DateAttr($date);
        $this->assertSame($date, $attr->getDate());
        $attr->setDate($date);
        $this->assertSame($date, $attr->getDate());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<date d="' . $date . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $attr);

        $array = array(
            'date' => array(
                'd' => $date,
            ),
        );
        $this->assertEquals($array, $attr->toArray());
    }
}
