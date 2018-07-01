<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\IntIdAttr;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for IntIdAttr.
 */
class IntIdAttrTest extends ZimbraStructTestCase
{
    public function testIntIdAttr()
    {
        $value = mt_rand(0, 100);
        $attr = new IntIdAttr($value);
        $this->assertSame($value, $attr->getId());

        $attr = new IntIdAttr(0);
        $attr->setId($value);
        $this->assertSame($value, $attr->getId());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<attr id="' . $value . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($attr, 'xml'));

        $attr = $this->serializer->deserialize($xml, 'Zimbra\Admin\Struct\IntIdAttr', 'xml');
        $this->assertSame($value, $attr->getId());
    }
}
