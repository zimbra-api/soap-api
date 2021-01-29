<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\IntegerValueAttrib;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for IntegerValueAttrib.
 */
class IntegerValueAttribTest extends ZimbraTestCase
{
    public function testIntegerValueAttrib()
    {
        $value = mt_rand(0, 100);
        $attr = new IntegerValueAttrib($value);
        $this->assertSame($value, $attr->getValue());

        $attr = new IntegerValueAttrib();
        $attr->setValue($value);
        $this->assertSame($value, $attr->getValue());

        $xml = <<<EOT
<?xml version="1.0"?>
<a value="$value" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($attr, 'xml'));
        $this->assertEquals($attr, $this->serializer->deserialize($xml, IntegerValueAttrib::class, 'xml'));

        $json = json_encode([
            'value' => $value,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($attr, 'json'));
        $this->assertEquals($attr, $this->serializer->deserialize($json, IntegerValueAttrib::class, 'json'));
    }
}
