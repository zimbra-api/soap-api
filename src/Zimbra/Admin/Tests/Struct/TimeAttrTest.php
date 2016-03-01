<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\TimeAttr;

/**
 * Testcase class for TimeAttr.
 */
class TimeAttrTest extends ZimbraAdminTestCase
{
    public function testTimeAttr()
    {
        $time = $this->faker->iso8601;
        $attr = new TimeAttr($time);
        $this->assertSame($time, $attr->getTime());

        $attr->setTime($time);
        $this->assertSame($time, $attr->getTime());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<attr time="' . $time . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $attr);

        $array = [
            'attr' => [
                'time' => $time,
            ],
        ];
        $this->assertEquals($array, $attr->toArray());
    }
}
