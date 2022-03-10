<?php declare(strict_types=1);

namespace Zimbra\Tests\Struct;

use Zimbra\Struct\AttributeName;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AttributeName.
 */
class AttributeNameTest extends ZimbraTestCase
{
    public function testAttributeName()
    {
        $name = $this->faker->word;
        $attr = new AttributeName($name);
        $this->assertSame($name, $attr->getName());

        $attr = new AttributeName('');
        $attr->setName($name);
        $this->assertSame($name, $attr->getName());

        $xml = <<<EOT
<?xml version="1.0"?>
<result n="$name" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($attr, 'xml'));
        $this->assertEquals($attr, $this->serializer->deserialize($xml, AttributeName::class, 'xml'));

        $json = json_encode([
            'n' => $name,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($attr, 'json'));
        $this->assertEquals($attr, $this->serializer->deserialize($json, AttributeName::class, 'json'));
    }
}
