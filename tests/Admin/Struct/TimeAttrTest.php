<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\TimeAttr;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for TimeAttr.
 */
class TimeAttrTest extends ZimbraTestCase
{
    public function testTimeAttr()
    {
        $time = $this->faker->iso8601;
        $attr = new TimeAttr($time);
        $this->assertSame($time, $attr->getTime());

        $attr = new TimeAttr();
        $attr->setTime($time);
        $this->assertSame($time, $attr->getTime());

        $xml = <<<EOT
<?xml version="1.0"?>
<result time="$time" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($attr, 'xml'));
        $this->assertEquals($attr, $this->serializer->deserialize($xml, TimeAttr::class, 'xml'));
    }
}
