<?php

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

        $attr = $this->serializer->deserialize($xml, 'Zimbra\Admin\Struct\ValueAttrib', 'xml');
        $this->assertSame($value, $attr->getValue());
    }
}
