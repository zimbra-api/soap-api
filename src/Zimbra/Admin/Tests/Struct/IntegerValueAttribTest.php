<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\IntegerValueAttrib;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for IntegerValueAttrib.
 */
class IntegerValueAttribTest extends ZimbraStructTestCase
{
    public function testIntegerValueAttrib()
    {
        $value = mt_rand(0, 100);
        $attr = new IntegerValueAttrib($value);
        $this->assertSame($value, $attr->getValue());

        $attr = new IntegerValueAttrib();
        $attr->setValue($value);
        $this->assertSame($value, $attr->getValue());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<a value="' . $value . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($attr, 'xml'));

        $attr = $this->serializer->deserialize($xml, 'Zimbra\Admin\Struct\IntegerValueAttrib', 'xml');
        $this->assertSame($value, $attr->getValue());
    }
}
