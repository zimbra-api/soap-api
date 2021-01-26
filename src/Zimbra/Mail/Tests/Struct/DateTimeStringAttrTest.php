<?php declare(strict_types=1);

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Struct\DateTimeStringAttr;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for DateTimeStringAttr.
 */
class DateTimeStringAttrTest extends ZimbraStructTestCase
{
    public function testDateTimeStringAttr()
    {
        $date = $this->faker->date;

        $attr = new DateTimeStringAttr($date);
        $this->assertSame($date, $attr->getDateTime());

        $attr = new DateTimeStringAttr('');
        $attr->setDateTime($date);
        $this->assertSame($date, $attr->getDateTime());

        $xml = <<<EOT
<?xml version="1.0"?>
<attr d="$date" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($attr, 'xml'));
        $this->assertEquals($attr, $this->serializer->deserialize($xml, DateTimeStringAttr::class, 'xml'));

        $json = json_encode([
            'd' => $date,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($attr, 'json'));
        $this->assertEquals($attr, $this->serializer->deserialize($json, DateTimeStringAttr::class, 'json'));
    }
}
