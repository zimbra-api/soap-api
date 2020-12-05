<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\CosInfoAttr;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CosInfoAttr.
 */
class CosInfoAttrTest extends ZimbraStructTestCase
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
<a n="$key" c="true" pd="true">$value</a>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($attr, 'xml'));
        $this->assertEquals($attr, $this->serializer->deserialize($xml, CosInfoAttr::class, 'xml'));

        $json = json_encode([
            'n' => $key,
            '_content' => $value,
            'c' => TRUE,
            'pd' => TRUE,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($attr, 'json'));
        $this->assertEquals($attr, $this->serializer->deserialize($json, CosInfoAttr::class, 'json'));
    }
}
