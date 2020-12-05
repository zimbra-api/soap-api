<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Account\Struct\Attr;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for Attr.
 */
class AttrTest extends ZimbraStructTestCase
{
    public function testAttr()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;

        $attr = new Attr($name, $value, false);
        $this->assertSame($name, $attr->getName());
        $this->assertSame($value, $attr->getValue());
        $this->assertFalse($attr->getPermDenied());

        $attr = new Attr('');
        $attr->setName($name)
             ->setValue($value)
             ->setPermDenied(true);
        $this->assertSame($name, $attr->getName());
        $this->assertSame($value, $attr->getValue());
        $this->assertTrue($attr->getPermDenied());

        $xml = <<<EOT
<?xml version="1.0"?>
<attr name="$name" pd="true">$value</attr>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($attr, 'xml'));
        $this->assertEquals($attr, $this->serializer->deserialize($xml, Attr::class, 'xml'));

        $json = json_encode([
            'name' => $name,
            '_content' => $value,
            'pd' => TRUE,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($attr, 'json'));
        $this->assertEquals($attr, $this->serializer->deserialize($json, Attr::class, 'json'));
    }
}
