<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use Zimbra\Account\Struct\Attr;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for Attr.
 */
class AttrTest extends ZimbraTestCase
{
    public function testAttr()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;

        $attr = new Attr($name, $value, FALSE);
        $this->assertSame($name, $attr->getName());
        $this->assertSame($value, $attr->getValue());
        $this->assertFalse($attr->getPermDenied());

        $attr = new Attr();
        $attr->setName($name)
             ->setValue($value)
             ->setPermDenied(TRUE);
        $this->assertSame($name, $attr->getName());
        $this->assertSame($value, $attr->getValue());
        $this->assertTrue($attr->getPermDenied());

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" pd="true">$value</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($attr, 'xml'));
        $this->assertEquals($attr, $this->serializer->deserialize($xml, Attr::class, 'xml'));
    }
}
