<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\IntIdAttr;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for IntIdAttr.
 */
class IntIdAttrTest extends ZimbraTestCase
{
    public function testIntIdAttr()
    {
        $value = mt_rand(0, 100);
        $attr = new IntIdAttr($value);
        $this->assertSame($value, $attr->getId());

        $attr = new IntIdAttr();
        $attr->setId($value);
        $this->assertSame($value, $attr->getId());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$value" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($attr, 'xml'));
        $this->assertEquals($attr, $this->serializer->deserialize($xml, IntIdAttr::class, 'xml'));
    }
}
