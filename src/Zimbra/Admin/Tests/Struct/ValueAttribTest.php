<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\ValueAttrib;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ValueAttrib.
 */
class ValueAttribTest extends ZimbraStructTestCase
{
    public function testValueAttrib()
    {
        $value = $this->faker->word;
        $attr = new ValueAttrib($value);
        $this->assertSame($value, $attr->getValue());

        $attr = new ValueAttrib('');
        $attr->setValue($value);
        $this->assertSame($value, $attr->getValue());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<a value="' . $value  .'" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($attr, 'xml'));
        $this->assertEquals($attr, $this->serializer->deserialize($xml, ValueAttrib::class, 'xml'));

        $json = json_encode([
            'value' => $value,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($attr, 'json'));
        $this->assertEquals($attr, $this->serializer->deserialize($json, ValueAttrib::class, 'json'));
    }
}
