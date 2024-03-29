<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\CosInfoAttr;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CosInfoAttr.
 */
class CosInfoAttrTest extends ZimbraTestCase
{
    public function testCosInfoAttr()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;

        $attr = new CosInfoAttr($key, $value, FALSE, FALSE);
        $this->assertFalse($attr->getCosAttr());
        $this->assertFalse($attr->getPermDenied());

        $attr = new CosInfoAttr($key, $value);
        $attr->setCosAttr(TRUE)
           ->setPermDenied(TRUE);
        $this->assertTrue($attr->getCosAttr());
        $this->assertTrue($attr->getPermDenied());

        $xml = <<<EOT
<?xml version="1.0"?>
<result n="$key" c="true" pd="true">$value</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($attr, 'xml'));
        $this->assertEquals($attr, $this->serializer->deserialize($xml, CosInfoAttr::class, 'xml'));
    }
}
