<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\TimeAttr;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for TimeAttr.
 */
class TimeAttrTest extends ZimbraStructTestCase
{
    public function testTimeAttr()
    {
        $time = $this->faker->iso8601;
        $attr = new TimeAttr($time);
        $this->assertSame($time, $attr->getTime());

        $attr = new TimeAttr('');
        $attr->setTime($time);
        $this->assertSame($time, $attr->getTime());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<attr time="' . $time . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($attr, 'xml'));

        $attr = $this->serializer->deserialize($xml, 'Zimbra\Admin\Struct\TimeAttr', 'xml');
        $this->assertSame($time, $attr->getTime());
    }
}
