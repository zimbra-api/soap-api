<?php declare(strict_types=1);

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
        $this->assertEquals($attr, $this->serializer->deserialize($xml, IntIdAttr::class, 'xml'));

        $json = json_encode([
            'id' => $value,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($attr, 'json'));
        $this->assertEquals($attr, $this->serializer->deserialize($json, IntIdAttr::class, 'json'));
    }
}
