<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\DateAttr;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for DateAttr.
 */
class DateAttrTest extends ZimbraTestCase
{
    public function testDateAttr()
    {
        $date = $this->faker->date;

        $attr = new DateAttr($date);
        $this->assertSame($date, $attr->getDate());

        $attr = new DateAttr('');
        $attr->setdate($date);
        $this->assertSame($date, $attr->getDate());

        $xml = <<<EOT
<?xml version="1.0"?>
<result d="$date" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($attr, 'xml'));
        $this->assertEquals($attr, $this->serializer->deserialize($xml, DateAttr::class, 'xml'));

        $json = json_encode([
            'd' => $date,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($attr, 'json'));
        $this->assertEquals($attr, $this->serializer->deserialize($json, DateAttr::class, 'json'));
    }
}
